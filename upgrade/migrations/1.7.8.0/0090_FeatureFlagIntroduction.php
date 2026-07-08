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

class FeatureFlagIntroduction extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('ps_1780_add_feature_flag_tab');
        $this->addSql('/* this table should be created by Doctrine but we need to perform INSERT and the 1.7.8.0.sql script is called
before Doctrine schema update */
/* consequently we create the table manually */
CREATE TABLE IF NOT EXISTS `PREFIX_feature_flag` (
  `id_feature_flag` INT(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` TINYINT(1) NOT NULL DEFAULT \'0\',
  `label_wording` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'\',
  `label_domain` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'\',
  `description_wording` VARCHAR(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'\',
  `description_domain` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'\',
  PRIMARY KEY (`id_feature_flag`),
  UNIQUE KEY `UNIQ_91700F175E237E06` (`name`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `state`, `label_wording`, `label_domain`, `description_wording`, `description_domain`)
VALUES
	(\'product_page_v2\', 0, \'Experimental product page\', \'Admin.Advparameters.Feature\', \'This page benefits from increased performance and includes new features such as a new combination management system. Please note this is a work in progress and some features are not available yet.\', \'Admin.Advparameters.Help\')');
    }
}
