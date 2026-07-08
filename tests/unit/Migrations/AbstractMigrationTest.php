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

namespace unit\Migrations;

use PHPUnit\Framework\TestCase;
use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class AbstractMigrationTest extends TestCase
{
    /**
     * @return AbstractMigration
     */
    private function buildMigration()
    {
        return new class('8.1.0') extends AbstractMigration {
            /** @var int */
            public $upCalls = 0;

            protected function up(): void
            {
                ++$this->upCalls;
                $this->addSql('SELECT 1');
                $this->addPhpFunction('add_column', ['orders', 'note', 'TEXT']);
                $this->addSql('SELECT 2');
            }
        };
    }

    public function testOperationsAreReturnedInRegistrationOrder()
    {
        $operations = $this->buildMigration()->getOperations();

        $this->assertCount(3, $operations);
        $this->assertSame('SELECT 1', $operations[0]->getQuery());
        $this->assertSame('add_column', $operations[1]->getFunctionName());
        $this->assertSame('SELECT 2', $operations[2]->getQuery());
    }

    public function testOperationsCarryTheMigrationVersion()
    {
        $migration = $this->buildMigration();
        $this->assertSame('8.1.0', $migration->getVersion());

        foreach ($migration->getOperations() as $operation) {
            $this->assertSame('8.1.0', $operation->getVersion());
        }
    }

    public function testUpIsOnlyCalledOnce()
    {
        $migration = $this->buildMigration();

        $migration->getOperations();
        $operations = $migration->getOperations();

        $this->assertSame(1, $migration->upCalls);
        $this->assertCount(3, $operations);
    }
}
