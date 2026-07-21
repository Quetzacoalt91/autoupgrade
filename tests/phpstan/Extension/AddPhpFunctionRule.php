<?php

/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

namespace PrestaShop\Module\AutoUpgrade\PHPStan\Extension;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\ObjectType;
use PHPStan\Type\VerbosityLevel;

/**
 * Statically validates calls to AbstractMigration::addPhpFunction().
 *
 * A migration registers a PHP operation by naming a function defined in upgrade/php/<name>.php
 * and passing its arguments as an array. Because the function name is a plain string and the
 * arguments are typed as mixed[], PHPStan cannot check either on its own. This rule bridges the
 * gap: it resolves the string to the real function and checks the array against its signature,
 * reporting a missing function, a wrong number of arguments, or an argument type mismatch.
 *
 * @implements Rule<MethodCall>
 */
class AddPhpFunctionRule implements Rule
{
    private const METHOD_NAME = 'addPhpFunction';
    private const MIGRATION_CLASS = 'PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration';

    /** @var ReflectionProvider */
    private $reflectionProvider;

    public function __construct(ReflectionProvider $reflectionProvider)
    {
        $this->reflectionProvider = $reflectionProvider;
    }

    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    /**
     * @return list<RuleError>
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node->name instanceof Identifier || $node->name->toLowerString() !== strtolower(self::METHOD_NAME)) {
            return [];
        }

        // Only handle calls made on an AbstractMigration instance.
        $callerType = $scope->getType($node->var);
        if ((new ObjectType(self::MIGRATION_CLASS))->isSuperTypeOf($callerType)->no()) {
            return [];
        }

        $args = $node->getArgs();
        if (!isset($args[0])) {
            return [];
        }

        // The function name must be a single constant string to be resolved statically.
        $functionNameType = $scope->getType($args[0]->value);
        $constantStrings = $functionNameType->getConstantStrings();
        if (count($constantStrings) !== 1) {
            return [];
        }
        $functionName = $constantStrings[0]->getValue();

        if (!$this->reflectionProvider->hasFunction(new Name($functionName), null)) {
            $suggestion = $this->closestFunctionName($functionName);
            $message = $suggestion !== null
                ? sprintf('Migration function "%s" does not exist. Did you mean "%s"?', $functionName, $suggestion)
                : sprintf('Migration function "%s" does not exist. It should be defined as a function in upgrade/php/%s.php.', $functionName, $functionName);

            return [
                RuleErrorBuilder::message($message)
                    ->identifier('autoupgrade.migrationFunctionNotFound')
                    ->build(),
            ];
        }

        // Without an argument array we have nothing left to check.
        if (!isset($args[1])) {
            return [];
        }

        // The arguments must be a constant array to be matched positionally against the signature.
        $parametersType = $scope->getType($args[1]->value);
        $constantArrays = $parametersType->getConstantArrays();
        if (count($constantArrays) !== 1) {
            return [];
        }
        $constantArray = $constantArrays[0];

        $functionReflection = $this->reflectionProvider->getFunction(new Name($functionName), null);
        $variants = $functionReflection->getVariants();
        $parameters = $variants[0]->getParameters();

        $valueTypes = $constantArray->getValueTypes();
        $providedCount = count($valueTypes);

        $requiredCount = 0;
        $hasVariadic = false;
        foreach ($parameters as $parameter) {
            if ($parameter->isVariadic()) {
                $hasVariadic = true;
            }
            if (!$parameter->isOptional() && !$parameter->isVariadic()) {
                ++$requiredCount;
            }
        }

        $errors = [];

        if ($providedCount < $requiredCount || (!$hasVariadic && $providedCount > count($parameters))) {
            $errors[] = RuleErrorBuilder::message(sprintf(
                'Migration function "%s" is called with %d argument%s, %s required.',
                $functionName,
                $providedCount,
                $providedCount === 1 ? '' : 's',
                $requiredCount === count($parameters)
                    ? sprintf('%d', $requiredCount)
                    : sprintf('%d-%d', $requiredCount, count($parameters))
            ))
                ->identifier('autoupgrade.migrationFunctionArity')
                ->build();
        }

        foreach ($valueTypes as $position => $valueType) {
            $parameter = $this->parameterAtPosition($parameters, $position);
            if ($parameter === null) {
                continue;
            }
            $expectedType = $parameter->getType();
            if ($expectedType->accepts($valueType, true)->no()) {
                $errors[] = RuleErrorBuilder::message(sprintf(
                    'Argument #%d ($%s) of migration function "%s" expects %s, %s given.',
                    $position + 1,
                    $parameter->getName(),
                    $functionName,
                    $expectedType->describe(VerbosityLevel::typeOnly()),
                    $valueType->describe(VerbosityLevel::typeOnly())
                ))
                    ->identifier('autoupgrade.migrationFunctionArgumentType')
                    ->build();
            }
        }

        return $errors;
    }

    /**
     * Returns the name of the existing migration function closest to the given (typo'd) one,
     * or null when nothing is close enough to be a plausible fix.
     */
    private function closestFunctionName(string $functionName): ?string
    {
        $best = null;
        $bestDistance = PHP_INT_MAX;
        foreach ($this->availableFunctionNames() as $candidate) {
            $distance = levenshtein($functionName, $candidate);
            if ($distance < $bestDistance) {
                $bestDistance = $distance;
                $best = $candidate;
            }
        }

        // Only suggest when the names are close: at most a third of the typed length differs.
        if ($best === null || $bestDistance > (int) floor(max(1, strlen($functionName)) / 3) + 1) {
            return null;
        }

        return $best;
    }

    /**
     * @return string[] Base names of the functions defined in upgrade/php/<name>.php
     */
    private function availableFunctionNames(): array
    {
        $directory = __DIR__ . '/../../../upgrade/php';
        $files = glob($directory . '/*.php');
        if ($files === false) {
            return [];
        }

        $names = [];
        foreach ($files as $file) {
            $name = basename($file, '.php');
            if ($name === 'index') {
                continue;
            }
            $names[] = $name;
        }

        return $names;
    }

    /**
     * @param ParameterReflection[] $parameters
     */
    private function parameterAtPosition(array $parameters, int $position): ?ParameterReflection
    {
        if (isset($parameters[$position])) {
            return $parameters[$position];
        }

        // A trailing variadic parameter absorbs every following argument.
        $last = end($parameters);
        if ($last !== false && $last->isVariadic()) {
            return $last;
        }

        return null;
    }
}
