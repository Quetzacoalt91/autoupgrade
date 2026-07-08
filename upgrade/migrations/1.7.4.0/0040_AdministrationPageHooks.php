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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_4_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class AdministrationPageHooks extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'actionAdministrationPageForm\', \'Manage Administration Page form fields\', \'This hook adds, update or remove fields of the Administration Page form\', \'1\'),
  (NULL, \'actionAdministrationPageFormSave\', \'Processing Administration page form\', \'This hook is called when the Administration Page form is processed\', \'1\'),
  (NULL, \'actionBuildFrontEndObject\', \'Manage elements added to the \\"prestashop\\" javascript object\', \'This hook allows you to customize the \\"prestashop\\" javascript object that is included in all front office pages\', \'1\'),
  (NULL, \'actionFrontControllerAfterInit\', \'Perform actions after front office controller initialization\', \'This hook is launched after the initialization of all front office controllers\', \'1\'),
  (NULL, \'actionPerformancePageForm\', \'Manage Performance Page form fields\', \'This hook adds, update or remove fields of the Performance Page form\', \'1\'),
  (NULL, \'actionPerformancePageFormSave\', \'Processing Performance page form\', \'This hook is called when the Performance Page form is processed\', \'1\'),
  (NULL, \'actionMaintenancePageForm\', \'Manage Maintenance Page form fields\', \'This hook adds, update or remove fields of the Maintenance Page form\', \'1\'),
  (NULL, \'actionMaintenancePageFormSave\', \'Processing Maintenance page form\', \'This hook is called when the Maintenance Page form is processed\', \'1\'),
  (NULL, \'displayAdminEndContent\', \'Administration end of content\', \'This hook is displayed at the end of the main content, before the footer\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
    }
}
