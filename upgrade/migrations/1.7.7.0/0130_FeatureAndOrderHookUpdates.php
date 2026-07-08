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

class FeatureAndOrderHookUpdates extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'actionAfterCreateFeatureFormHandler\', \'Modify feature identifiable object data after creating it\',\'This hook allows to modify feature identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterUpdateFeatureFormHandler\', \'Modify feature identifiable object data after updating it\',\'This hook allows to modify feature identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'displayAdminOrderBottom\', \'Admin Order Side Column Bottom\',\'This hook displays content in the order view page at the bottom of the side column\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
        $this->addSql('UPDATE `PREFIX_hook_module` AS hm
INNER JOIN `PREFIX_hook` AS hfrom ON hm.id_hook = hfrom.id_hook AND hfrom.name = \'displayAdminOrderSideBottom\'
INNER JOIN `PREFIX_hook` AS hto ON hto.name = \'displayAdminOrderBottom\'
SET hm.id_hook = hto.id_hook');
        $this->addSql('DELETE FROM `PREFIX_hook` WHERE name = \'displayAdminOrderSideBottom\'');
    }
}
