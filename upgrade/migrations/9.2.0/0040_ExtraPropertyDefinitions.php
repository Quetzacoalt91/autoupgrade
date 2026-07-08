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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_2_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ExtraPropertyDefinitions extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Create the extra property definition registry table
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/41092
         */
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_extra_property_definition` (
  `id_extra_property_definition` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entity_name` varchar(64) NOT NULL,
  `module_name` varchar(64) DEFAULT NULL,
  `property_name` varchar(64) NOT NULL,
  `type` ENUM (\'int\',\'bool\',\'string\',\'float\',\'date\',\'html\',\'json\',\'choice\') NOT NULL DEFAULT \'string\',
  `scope` ENUM (\'common\',\'lang\',\'shop\') NOT NULL DEFAULT \'common\',
  `sql_index` ENUM (\'none\',\'key\',\'unique\') NOT NULL DEFAULT \'none\',
  `size` smallint(5) unsigned DEFAULT NULL,
  `default_value` varchar(255) DEFAULT NULL,
  `required` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
  `constraints` longtext DEFAULT NULL,
  `display_front` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `associated_apis` text DEFAULT NULL,
  `associated_grids` text DEFAULT NULL,
  `associated_forms` text DEFAULT NULL,
  `form_type` varchar(255) DEFAULT NULL,
  `form_options` text DEFAULT NULL,
  `label_wording` varchar(191) DEFAULT NULL,
  `label_domain` varchar(255) DEFAULT NULL,
  `description_wording` varchar(191) DEFAULT NULL,
  `description_domain` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_extra_property_definition`),
  UNIQUE KEY `extra_property_definition_unique` (`entity_name`, `module_name`, `property_name`),
  KEY `entity_name` (`entity_name`, `scope`),
  KEY `module_name` (`module_name`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addPhpFunction('ps_920_extra_property_definitions_tab');
    }
}
