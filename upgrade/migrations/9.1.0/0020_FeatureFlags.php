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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_1_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class FeatureFlags extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Insert new feature flags introduced for the newly improved shipment system
         * Insert new feature flags introduced for the migration of tag page
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/38040
         * @see https://github.com/PrestaShop/PrestaShop/pull/39516
         */
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
  (\'improved_shipment\', \'env,dotenv,db\', \'Improved shipment\', \'Admin.Advparameters.Feature\', \'Enable / Disable the newly improved shipment system\', \'Admin.Advparameters.Help\', 0, \'beta\'),
  (\'discount\', \'env,dotenv,db\', \'Discount\', \'Admin.Advparameters.Feature\', \'Enable / Disable the new discount system.\', \'Admin.Advparameters.Help\', 0, \'beta\'),
  (\'tag\', \'env,dotenv,db\', \'Tag\', \'Admin.Advparameters.Feature\', \'Enable / Disable the tag page.\', \'Admin.Advparameters.Help\', 0, \'beta\')');

        /*
         * Remove obsolete feature flag from old removed cart rule migration
         */
        $this->addSql('DELETE FROM `PREFIX_feature_flag` WHERE `name` IN (\'cart_rule\')');
    }
}
