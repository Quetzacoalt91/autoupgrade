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

/**
 * Base class of all migrations stored in upgrade/migrations/<version>/.
 *
 * Implement up() and register the changes to apply with addSql() and addPhpFunction().
 * Operations are run one at a time, in registration order, and the update process can
 * stop and resume between any two of them: each operation must make sense on its own
 * (no SET SESSION carry-over, no temporary state shared between two operations).
 *
 * The version comes from the name of the folder containing the migration file and is
 * provided by the MigrationsRepository.
 */
abstract class AbstractMigration implements MigrationInterface
{
    /** @var string */
    private $version;

    /** @var MigrationOperation[] */
    private $operations = [];

    /** @var bool */
    private $operationsRegistered = false;

    public function __construct(string $version)
    {
        $this->version = $version;
    }

    final public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Register the operations of this migration, by calling addSql() and addPhpFunction().
     */
    abstract protected function up(): void;

    /**
     * {@inheritdoc}
     */
    final public function getOperations(): array
    {
        if (!$this->operationsRegistered) {
            $this->operationsRegistered = true;
            $this->up();
        }

        return $this->operations;
    }

    /**
     * Register a single SQL query.
     *
     * The following placeholders are replaced at execution time:
     * - PREFIX_      => database tables prefix
     * - ENGINE_TYPE  => MySQL engine (e.g. InnoDB)
     * - DB_NAME      => database name
     */
    final protected function addSql(string $query): void
    {
        $this->operations[] = MigrationOperation::sql($this->getVersion(), $query);
    }

    /**
     * Register a call to a function defined in upgrade/php/<functionName>.php.
     *
     * Parameters must be scalar values or arrays of scalar values, as they are
     * serialized in the update backlog.
     *
     * @param mixed[] $parameters
     */
    final protected function addPhpFunction(string $functionName, array $parameters = []): void
    {
        $this->operations[] = MigrationOperation::phpFunction($this->getVersion(), $functionName, $parameters);
    }
}
