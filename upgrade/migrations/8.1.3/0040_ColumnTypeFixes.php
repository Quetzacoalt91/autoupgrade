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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_1_3;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ColumnTypeFixes extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_smarty_lazy_cache` CHANGE `cache_id` `cache_id` VARCHAR(191) NOT NULL DEFAULT \'\'');
        $this->addSql('ALTER TABLE `PREFIX_log` CHANGE `id_shop` `id_shop` INT(10) unsigned DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_log` CHANGE `id_shop_group` `id_shop_group` INT(10) unsigned DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_log` CHANGE `id_lang` `id_lang` INT(10) unsigned DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_product_attribute_lang` CHANGE `available_now` `available_now` VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_product_attribute_lang` CHANGE `available_later` `available_later` VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_order_cart_rule` CHANGE `deleted` `deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\'');
        $this->addSql('ALTER TABLE `PREFIX_product_group_reduction_cache` CHANGE `reduction` `reduction` DECIMAL(5, 4) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `physical_quantity` `physical_quantity` INT(10) UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_group_reduction` CHANGE `reduction` `reduction` DECIMAL(5, 4) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_order_payment` CHANGE `amount` `amount` DECIMAL(20, 6) NOT NULL');
    }
}
