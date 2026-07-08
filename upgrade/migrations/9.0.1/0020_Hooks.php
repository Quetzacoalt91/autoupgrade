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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_0_1;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class Hooks extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  -- https://github.com/PrestaShop/PrestaShop/pull/39366
  (NULL, \'actionCheckoutStepRenderTemplate\',\'Modify the parameters of the checkout step template rendering\',\'This hook is called when rendering every checkout step template\', \'1\'),
  -- https://github.com/PrestaShop/PrestaShop/pull/39277
  (NULL, \'actionModifyHtmlPurifierConfig\', \'Called when configuring HTMLPurifier\', \'Allows modules to modify the HTMLPurifier definition by adding custom allowed HTML elements or attributes during Tools::purifyHTML().\', \'1\'),
  -- https://github.com/PrestaShop/PrestaShop/pull/38487
  (NULL, \'actionGetPdfTemplateObject\', \'Get PDF template object\', \'This hook allows to recieve a PDF template object from modules\', \'1\'),
  -- https://github.com/PrestaShop/PrestaShop/pull/39716
  (NULL, \'additionalHtmlAttributesFormFields\', \'\', \'\', \'1\'),
  (NULL, \'actionGetCartRuleContextualValue\', \'\', \'\', \'1\'),
  (NULL, \'actionApplyCartRule\', \'\', \'\', \'1\'),
  (NULL, \'actionDatabaseLogsForm\', \'Modify database logs options form content\', \'This hook allows to modify database logs options form FormBuilder\', \'1\'),
  (NULL, \'actionDatabaseLogsSave\', \'Modify database logs options form saved data\', \'This hook allows to modify data of database logs options form after it was saved\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
    }
}
