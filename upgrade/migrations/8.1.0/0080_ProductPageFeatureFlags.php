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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_1_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ProductPageFeatureFlags extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('ps_810_update_product_page_feature_flags');

        /*
         * add new feature flag from 8.0.x to 8.1.0
         */
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`)
VALUES
    (\'attribute_group\', \'Attribute group\', \'Admin.Advparameters.Feature\', \'Enable / Disable migrated attribute group page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'authorization_server\', \'Authorization server\', \'Admin.Advparameters.Feature\', \'Enable or disable the authorization server page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'cart_rule\', \'Cart rules\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated cart rules page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'catalog_price_rule\', \'Catalog price rules\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated catalog price rules page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'multiple_image_format\', \'Multiple image formats\', \'Admin.Advparameters.Feature\', \'Enable / Disable having more than one image format (jpg, webp, avif, png, etc.)\', \'Admin.Advparameters.Help\', 0, \'stable\'),
    (\'country\', \'Countries\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated countries page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'state\', \'States\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated states page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'carrier\', \'Carriers\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated carriers page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'title\', \'Titles\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated titles page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'permission\', \'Permissions\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated permissions page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'tax_rules_group\', \'Tax rule groups\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated tax rules page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'customer_threads\', \'Customer threads\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated customer threads page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
    (\'order_state\', \'Order states\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated order states page.\', \'Admin.Advparameters.Help\', 0, \'beta\')');
    }
}
