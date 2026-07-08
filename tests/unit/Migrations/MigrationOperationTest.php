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

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use PrestaShop\Module\AutoUpgrade\Migrations\MigrationOperation;

class MigrationOperationTest extends TestCase
{
    public function testSqlOperationRoundTrip()
    {
        $operation = MigrationOperation::sql('8.1.0', 'ALTER TABLE `PREFIX_shop` ADD `foo` INT');

        $this->assertFalse($operation->isPhpFunction());
        $this->assertSame('8.1.0', $operation->getVersion());
        $this->assertSame('ALTER TABLE `PREFIX_shop` ADD `foo` INT', $operation->getQuery());

        $restored = MigrationOperation::fromArray($operation->toArray());
        $this->assertSame($operation->toArray(), $restored->toArray());
    }

    public function testPhpFunctionOperationRoundTrip()
    {
        $operation = MigrationOperation::phpFunction('9.0.0', 'add_column', ['cart_rule', 'quantity', 'INT UNSIGNED DEFAULT NULL']);

        $this->assertTrue($operation->isPhpFunction());
        $this->assertSame('9.0.0', $operation->getVersion());
        $this->assertSame('add_column', $operation->getFunctionName());
        $this->assertSame(['cart_rule', 'quantity', 'INT UNSIGNED DEFAULT NULL'], $operation->getParameters());

        $restored = MigrationOperation::fromArray($operation->toArray());
        $this->assertSame($operation->toArray(), $restored->toArray());
    }

    public function testFromArrayAcceptsLegacyBacklogFormat()
    {
        // Backlogs written by module versions predating migration classes
        $operation = MigrationOperation::fromArray([
            'version' => '8.0.0',
            'query' => 'SELECT 1',
        ]);

        $this->assertFalse($operation->isPhpFunction());
        $this->assertSame('8.0.0', $operation->getVersion());
        $this->assertSame('SELECT 1', $operation->getQuery());
    }

    public function testDescribeSqlOperation()
    {
        $operation = MigrationOperation::sql('8.1.0', 'SELECT 1');
        $this->assertSame('SELECT 1', $operation->describe());
    }

    public function testDescribePhpFunctionOperation()
    {
        $operation = MigrationOperation::phpFunction('9.0.0', 'add_column', ['orders', 'note', 'TEXT']);
        $this->assertSame("add_column('orders', 'note', 'TEXT')", $operation->describe());
    }

    public function testFromArrayWithoutVersionIsRefused()
    {
        $this->expectException(InvalidArgumentException::class);
        MigrationOperation::fromArray(['query' => 'SELECT 1']);
    }

    public function testFromArrayWithoutQueryIsRefused()
    {
        $this->expectException(InvalidArgumentException::class);
        MigrationOperation::fromArray(['version' => '8.0.0', 'type' => MigrationOperation::TYPE_SQL]);
    }

    public function testFromArrayWithoutFunctionNameIsRefused()
    {
        $this->expectException(InvalidArgumentException::class);
        MigrationOperation::fromArray(['version' => '8.0.0', 'type' => MigrationOperation::TYPE_PHP_FUNCTION]);
    }

    public function testFromArrayWithUnknownTypeIsRefused()
    {
        $this->expectException(InvalidArgumentException::class);
        MigrationOperation::fromArray(['version' => '8.0.0', 'type' => 'shell', 'query' => 'rm -rf']);
    }
}
