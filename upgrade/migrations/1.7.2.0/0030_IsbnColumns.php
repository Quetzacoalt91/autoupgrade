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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_2_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class IsbnColumns extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_product` CHANGE `isbn` `isbn` VARCHAR(32) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_order_detail` CHANGE `product_isbn` `product_isbn` VARCHAR(32) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_product_attribute` CHANGE `isbn` `isbn` VARCHAR(32) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock` CHANGE `isbn` `isbn` VARCHAR(32) NULL DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_supply_order_detail` CHANGE `isbn` `isbn` VARCHAR(32) NULL DEFAULT NULL');
    }
}
