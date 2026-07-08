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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_8_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ProductTypeColumn extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['product', 'product_type', 'ENUM(\'standard\', \'pack\', \'virtual\', \'combinations\', \'\') NOT NULL DEFAULT \'\'']);
        $this->addSql('/* First set all products to standard type, then update them based on cached columns that identify the type */
UPDATE `PREFIX_product` SET `product_type` = "standard"');
        $this->addSql('UPDATE `PREFIX_product` SET `product_type` = "combinations" WHERE `cache_default_attribute` != 0');
        $this->addSql('UPDATE `PREFIX_product` SET `product_type` = "pack" WHERE `cache_is_pack` = 1');
        $this->addSql('UPDATE `PREFIX_product` SET `product_type` = "virtual" WHERE `is_virtual` = 1');
    }
}
