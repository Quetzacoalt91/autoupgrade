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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_3_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ProductLowStockAndDeliveryTimes extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['product', 'low_stock_threshold', 'INT(10) NULL DEFAULT NULL AFTER `minimal_quantity`']);
        $this->addPhpFunction('add_column', ['product', 'additional_delivery_times', 'tinyint(1) unsigned NOT NULL DEFAULT \'1\' AFTER `out_of_stock`']);
        $this->addPhpFunction('add_column', ['product_lang', 'delivery_in_stock', 'varchar(255) DEFAULT NULL']);
        $this->addPhpFunction('add_column', ['product_lang', 'delivery_out_stock', 'varchar(255) DEFAULT NULL']);
        $this->addPhpFunction('add_column', ['product_shop', 'low_stock_threshold', 'INT(10) NULL DEFAULT NULL AFTER `minimal_quantity`']);
        $this->addPhpFunction('add_column', ['product_attribute', 'low_stock_threshold', 'INT(10) NULL DEFAULT NULL AFTER `minimal_quantity`']);
        $this->addPhpFunction('add_column', ['product_attribute_shop', 'low_stock_threshold', 'INT(10) NULL DEFAULT NULL AFTER `minimal_quantity`']);
        $this->addPhpFunction('add_column', ['product', 'low_stock_alert', 'TINYINT(1) NOT NULL DEFAULT 0 AFTER `low_stock_threshold`']);
        $this->addPhpFunction('add_column', ['product_shop', 'low_stock_alert', 'TINYINT(1) NOT NULL DEFAULT 0 AFTER `low_stock_threshold`']);
        $this->addPhpFunction('add_column', ['product_attribute', 'low_stock_alert', 'TINYINT(1) NOT NULL DEFAULT 0 AFTER `low_stock_threshold`']);
        $this->addPhpFunction('add_column', ['product_attribute_shop', 'low_stock_alert', 'TINYINT(1) NOT NULL DEFAULT 0 AFTER `low_stock_threshold`']);
    }
}
