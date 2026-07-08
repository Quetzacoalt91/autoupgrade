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

class Utf8mb4ColumnFixes extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_gender_lang` CHANGE `name` `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `employee_lastname` `employee_lastname` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock_mvt` CHANGE `employee_firstname` `employee_firstname` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL');
        $this->addSql('ALTER TABLE `PREFIX_timezone` CHANGE `name` `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group` CHANGE `group_type` `group_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_search_word` CHANGE `word` `word` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_meta` CHANGE `page` `page` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL');
        $this->addSql('/* php:execute_sql_if_table_exists(\'statssearch\', \'ALTER TABLE `PREFIX_statssearch` CHANGE `keywords` `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;\'); */
ALTER TABLE `PREFIX_stock` CHANGE `reference` `reference` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock` CHANGE `ean13` `ean13` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock` CHANGE `isbn` `isbn` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL');
        $this->addSql('ALTER TABLE `PREFIX_stock` CHANGE `upc` `upc` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_lang` CHANGE `name` `name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_connections` CHANGE `http_referer` `http_referer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL');
        $this->addSql('ALTER TABLE `PREFIX_product_download` CHANGE `display_filename` `display_filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL');
    }
}
