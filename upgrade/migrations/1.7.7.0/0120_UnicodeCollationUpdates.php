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

class UnicodeCollationUpdates extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_translation` CHANGE `key` `key` TEXT NOT NULL COLLATE utf8_bin');
        $this->addSql('ALTER TABLE `PREFIX_admin_filter` CHANGE filter_id filter_id VARCHAR(191) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_admin_filter` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_admin_filter` CHANGE `controller` `controller` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_admin_filter` CHANGE `action`  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_admin_filter` CHANGE `filter` `filter` longtext COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_admin_filter` CHANGE `filter_id` `filter_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_attribute` CHANGE `color` `color` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_lang` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_attribute_lang` CHANGE `name` `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_shop` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group` CHANGE `group_type` `group_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_lang` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_lang` CHANGE `name` `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_lang` CHANGE `public_name` `public_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_shop` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_lang` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_lang` CHANGE `name` `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_lang` CHANGE `iso_code` `iso_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_lang` CHANGE `language_code` `language_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_lang` CHANGE `locale` `locale` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_lang` CHANGE `date_format_lite` `date_format_lite` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_lang` CHANGE `date_format_full` `date_format_full` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_lang_shop` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_shop` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_shop` CHANGE `name` `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_shop` CHANGE `theme_name` `theme_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_shop_group` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_shop_group` CHANGE `name` `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `employee_lastname` `employee_lastname` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `employee_firstname` `employee_firstname` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `module` `module` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab` CHANGE `icon` `icon` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL');
        $this->addSql('ALTER TABLE `PREFIX_tab_lang` COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_tab_lang` CHANGE `name` `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_module_history` CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_translation` CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_translation` CHANGE `translation` `translation` text COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_translation` CHANGE `domain` `domain` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_translation` CHANGE `theme` `theme` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL');
    }
}
