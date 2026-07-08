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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_0_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class FeatureFlags extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('add_column', ['feature_flag', 'type', 'VARCHAR(64) DEFAULT \'env,dotenv,db\' NOT NULL AFTER `name`']);

        /*
         * Insert new feature flags introduced by v9
         */
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
  (\'front_container_v2\', \'env,dotenv,db\', \'New front container\', \'Admin.Advparameters.Feature\', \'Enable / Disable the new front container.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
  (\'customer_group\', \'env,dotenv,db\', \'Customer group\', \'Admin.Advparameters.Feature\', \'Enable / Disable the customer group page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
  (\'store\', \'env,dotenv,db\', \'Store\', \'Admin.Advparameters.Feature\', \'Enable / Disable the store page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
  (\'merchandise_return\', \'env,dotenv,db\', \'Merchandise return\', \'Admin.Advparameters.Feature\', \'Enable / Disable the merchandise return page.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
  (\'admin_api_multistore\', \'env,query,dotenv,db\', \'Admin API - Multistore\', \'Admin.Advparameters.Feature\', \'Enable or disable the Admin API when multistore is enabled.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
  (\'admin_api_experimental_endpoints\', \'env,dotenv,db\', \'Admin API - Enable experimental endpoints\', \'Admin.Advparameters.Feature\', \'Experimental API endpoints are disabled by default in prod environment, this configuration allows to forcefully enable them.\', \'Admin.Advparameters.Help\', 0, \'beta\')');

        /*
         * Remove olf feature flag before Authorization server was renamed into Admin API
         */
        $this->addSql('DELETE FROM `PREFIX_feature_flag` WHERE `name`=\'authorization_server\'');

        /*
         * Update carrier feature flag to stable, but we don't force enabled by default
         */
        $this->addSql('UPDATE `PREFIX_feature_flag` SET `stability` = \'stable\' WHERE `name` = \'carrier\'');

        /*
         * Remove old feature flags from 8.1.x
         */
        $this->addSql('DELETE FROM `PREFIX_feature_flag` WHERE `name` IN (\'product_page_v2\', \'title\', \'order_state\', \'multiple_image_format\', \'attribute_group\')');
    }
}
