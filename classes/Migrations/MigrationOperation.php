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

namespace PrestaShop\Module\AutoUpgrade\Migrations;

use InvalidArgumentException;

/**
 * Smallest unit of work of a migration: a single SQL query or a single PHP function call.
 *
 * Operations are serialized in the update backlog (one file on disk) so an update can be
 * resumed after any of them, hence the toArray() / fromArray() round-trip.
 */
class MigrationOperation
{
    const TYPE_SQL = 'sql';
    const TYPE_PHP_FUNCTION = 'php';

    /** @var string */
    private $version;

    /** @var self::TYPE_* */
    private $type;

    /**
     * SQL query, containing placeholders (PREFIX_, ENGINE_TYPE, DB_NAME). Only set for SQL operations.
     *
     * @var string|null
     */
    private $query;

    /**
     * Name of a function defined in upgrade/php/<name>.php. Only set for PHP operations.
     *
     * @var string|null
     */
    private $functionName;

    /**
     * @var mixed[]
     */
    private $parameters;

    /**
     * @param self::TYPE_* $type
     * @param mixed[] $parameters
     */
    private function __construct(string $version, string $type, ?string $query, ?string $functionName, array $parameters)
    {
        $this->version = $version;
        $this->type = $type;
        $this->query = $query;
        $this->functionName = $functionName;
        $this->parameters = $parameters;
    }

    public static function sql(string $version, string $query): self
    {
        return new self($version, self::TYPE_SQL, $query, null, []);
    }

    /**
     * @param mixed[] $parameters
     */
    public static function phpFunction(string $version, string $functionName, array $parameters = []): self
    {
        return new self($version, self::TYPE_PHP_FUNCTION, null, $functionName, $parameters);
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function isPhpFunction(): bool
    {
        return $this->type === self::TYPE_PHP_FUNCTION;
    }

    public function getQuery(): ?string
    {
        return $this->query;
    }

    public function getFunctionName(): ?string
    {
        return $this->functionName;
    }

    /**
     * @return mixed[]
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Human readable form of the operation, for logs.
     */
    public function describe(): string
    {
        if ($this->isPhpFunction()) {
            $parameters = array_map(function ($parameter) {
                return var_export($parameter, true);
            }, $this->parameters);

            return $this->functionName . '(' . implode(', ', $parameters) . ')';
        }

        return (string) $this->query;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        if ($this->isPhpFunction()) {
            return [
                'version' => $this->version,
                'type' => $this->type,
                'function' => $this->functionName,
                'parameters' => $this->parameters,
            ];
        }

        return [
            'version' => $this->version,
            'type' => $this->type,
            'query' => $this->query,
        ];
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        if (!isset($data['version'])) {
            throw new InvalidArgumentException('Missing version in migration operation data.');
        }

        // Backlogs saved by previous versions of the module contain raw queries without a type.
        $type = isset($data['type']) ? $data['type'] : self::TYPE_SQL;

        if ($type === self::TYPE_PHP_FUNCTION) {
            if (empty($data['function'])) {
                throw new InvalidArgumentException('Missing function name in migration operation data.');
            }

            return self::phpFunction($data['version'], $data['function'], isset($data['parameters']) ? $data['parameters'] : []);
        }

        if ($type !== self::TYPE_SQL) {
            throw new InvalidArgumentException(sprintf('Unknown migration operation type "%s".', $type));
        }

        if (!isset($data['query'])) {
            throw new InvalidArgumentException('Missing query in migration operation data.');
        }

        return self::sql($data['version'], $data['query']);
    }
}
