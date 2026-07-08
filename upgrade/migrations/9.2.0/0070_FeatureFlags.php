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

/**
 * All the feature flags introduced or updated in PrestaShop 9.2.0.
 */
class FeatureFlags extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Insert new feature flag introduced for the migration of the Hook a module page
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/41407
         */
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
  (\'hook_module_v2\', \'env,dotenv,db\', \'Hook a module\', \'Admin.Design.Feature\', \'Enable / Disable the migrated Hook a module form page.\', \'Admin.Design.Help\', 0, \'stable\')');

        /*
         * New B2B feature
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/40224
         */
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
  (\'improved_b2b\', \'env,dotenv,db\', \'Improved B2B\', \'Admin.Advparameters.Feature\', \'Enable / Disable the improved B2B mode. To use the feature activate the B2B mode in General Settings\', \'Admin.Advparameters.Help\', 0, \'beta\')');

        // https://github.com/PrestaShop/PrestaShop/pull/40238
        // Mark the "tag" feature flag as stable
        $this->addSql('UPDATE `PREFIX_feature_flag` SET `stability` = \'stable\' WHERE `name` = \'tag\'');

        // https://github.com/PrestaShop/PrestaShop/pull/41032
        // New pricing feature flag (beta)
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
            (\'new_pricing\', \'env,query,dotenv,db\', \'New pricing\', \'Admin.Advparameters.Feature\', \'Enable / Disable the new pricing system. This feature introduces an improved pricing engine.\', \'Admin.Advparameters.Help\', 0, \'beta\')');

        /*
         * Quick Access migrated to Symfony: add the (already stable) feature flag, then move the existing AdminQuickAccesses tab under Advanced Parameters and create its missing permissions
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/41508
         * @see https://github.com/PrestaShop/PrestaShop/pull/41630
         */
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
            (\'quick_access\', \'env,dotenv,db\', \'Quick access\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated quick access page.\', \'Admin.Advparameters.Help\', 0, \'stable\')');
        $this->addPhpFunction('ps_920_quick_access_tab');

        /*
         * @see https://github.com/PrestaShop/PrestaShop/pull/41433
         * @see https://github.com/PrestaShop/PrestaShop/pull/41627
         */
        $this->addSql('INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
            (\'email_body_translation\', \'env,dotenv,db\', \'Email body translations\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated email body translations page.\', \'Admin.Advparameters.Help\', 0, \'stable\')');

        /*
         * @see https://github.com/PrestaShop/PrestaShop/pull/41662
         */
        $this->addSql('UPDATE `PREFIX_feature_flag` SET `stability` = \'stable\' WHERE `name` = \'merchandise_return\'');
    }
}
