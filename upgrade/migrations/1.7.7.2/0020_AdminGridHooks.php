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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_7_2;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class AdminGridHooks extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
    (NULL, \'displayAdminGridTableBefore\', \'Display before Grid table\', \'This hook adds new blocks before Grid component table.\', \'1\'),
    (NULL, \'displayAdminGridTableAfter\', \'Display after Grid table\', \'This hook adds new blocks after Grid component table.\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
        $this->addSql('UPDATE `PREFIX_hook_module` AS hm
    INNER JOIN `PREFIX_hook` AS hfrom ON hm.id_hook = hfrom.id_hook AND hfrom.name = \'displayAdminListBefore\'
    INNER JOIN `PREFIX_hook` AS hto ON hto.name = \'displayAdminGridTableBefore\'
    SET hm.id_hook = hto.id_hook');
        $this->addSql('DELETE FROM `PREFIX_hook` WHERE name = \'displayAdminListBefore\'');
        $this->addSql('UPDATE `PREFIX_hook_module` AS hm
    INNER JOIN `PREFIX_hook` AS hfrom ON hm.id_hook = hfrom.id_hook AND hfrom.name = \'displayAdminListAfter\'
    INNER JOIN `PREFIX_hook` AS hto ON hto.name = \'displayAdminGridTableAfter\'
    SET hm.id_hook = hto.id_hook');
        $this->addSql('DELETE FROM `PREFIX_hook` WHERE name = \'displayAdminListAfter\'');
        $this->addSql('INSERT IGNORE INTO `PREFIX_hook_alias` (`name`, `alias`) VALUES
     (\'displayAdminGridTableBefore\', \'displayAdminListBefore\'),
     (\'displayAdminGridTableAfter\', \'displayAdminListAfter\')');
    }
}
