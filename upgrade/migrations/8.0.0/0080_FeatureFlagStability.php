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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_0_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class FeatureFlagStability extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['feature_flag', 'stability', 'VARCHAR(64) DEFAULT \'beta\' NOT NULL']);
        $this->addSql('UPDATE `PREFIX_feature_flag` SET `state` = \'0\', `stability` = \'beta\', `label_wording` = \'New product page - Single store\', `description_wording` = \'This page benefits from increased performance and includes new features such as a new combination management system.\' WHERE `name` = \'product_page_V2\'');
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `state`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `stability`)
VALUES (\'product_page_v2_multi_shop\', \'0\', \'New product page - Multi store\', \'Admin.Advparameters.Feature\', \'Access the new product page, even in a multistore context. This is a work in progress and some features are not available.\', \'Admin.Advparameters.Help\', \'beta\')');
        $this->addSql('UPDATE `PREFIX_tab` SET wording = \'New & Experimental Features\' WHERE `class_name` = \'AdminFeatureFlag\'');
        $this->addPhpFunction('ps_update_tab_lang', ['Admin.Navigation.Menu', 'AdminFeatureFlag']);
    }
}
