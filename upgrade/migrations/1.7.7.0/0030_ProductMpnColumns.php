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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_7_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ProductMpnColumns extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['order_detail', 'product_mpn', 'VARCHAR(40) NULL AFTER `product_upc`']);
        $this->addPhpFunction('add_column', ['supply_order_detail', 'mpn', 'VARCHAR(40) NULL AFTER `upc`']);
        $this->addPhpFunction('add_column', ['stock', 'mpn', 'VARCHAR(40) NULL AFTER `upc`']);
        $this->addPhpFunction('add_column', ['product_attribute', 'mpn', 'VARCHAR(40) NULL AFTER `upc`']);
        $this->addPhpFunction('add_column', ['product', 'mpn', 'VARCHAR(40) NULL AFTER `upc`']);
        $this->addSql('UPDATE `PREFIX_order_detail` SET `product_mpn` = \'\'');
        $this->addSql('UPDATE `PREFIX_supply_order_detail` SET `mpn` = \'\'');
        $this->addSql('UPDATE `PREFIX_stock` SET `mpn` = \'\'');
        $this->addSql('UPDATE `PREFIX_product_attribute` SET `mpn` = \'\'');
        $this->addSql('UPDATE `PREFIX_product` SET `mpn` = \'\'');
    }
}
