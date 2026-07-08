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

class FeatureFlagsAndShipment extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('-- https://github.com/PrestaShop/PrestaShop/pull/40238
/* Mark the "tag" feature flag as stable */
UPDATE `PREFIX_feature_flag` SET `stability` = \'stable\' WHERE `name` = \'tag\'');
        $this->addSql('-- https://github.com/PrestaShop/PrestaShop/pull/41032
/* New pricing feature flag (beta) */
INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
  (\'new_pricing\', \'env,query,dotenv,db\', \'New pricing\', \'Admin.Advparameters.Feature\', \'Enable / Disable the new pricing system. This feature introduces an improved pricing engine.\', \'Admin.Advparameters.Help\', 0, \'beta\')');
        $this->addSql('-- https://github.com/PrestaShop/PrestaShop/pull/41508 + https://github.com/PrestaShop/PrestaShop/pull/41630
/* Quick Access migrated to Symfony: add the (already stable) feature flag, then move the existing AdminQuickAccesses tab under Advanced Parameters and create its missing permissions */
INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
  (\'quick_access\', \'env,dotenv,db\', \'Quick access\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated quick access page.\', \'Admin.Advparameters.Help\', 0, \'stable\')');
        $this->addPhpFunction('ps_920_quick_access_tab');
        $this->addSql('-- https://github.com/PrestaShop/PrestaShop/pull/41433
-- https://github.com/PrestaShop/PrestaShop/pull/41627
INSERT INTO `PREFIX_feature_flag` (`name`, `type`, `label_wording`, `label_domain`, `description_wording`, `description_domain`, `state`, `stability`) VALUES
  (\'email_body_translation\', \'env,dotenv,db\', \'Email body translations\', \'Admin.Advparameters.Feature\', \'Enable / Disable the migrated email body translations page.\', \'Admin.Advparameters.Help\', 0, \'stable\')');
        $this->addSql('-- https://github.com/PrestaShop/PrestaShop/pull/41662
UPDATE `PREFIX_feature_flag` SET `stability` = \'stable\' WHERE `name` = \'merchandise_return\'');
        $this->addPhpFunction('add_column', ['shipment', 'deleted', 'TINYINT(1) NOT NULL DEFAULT 0']);
    }
}
