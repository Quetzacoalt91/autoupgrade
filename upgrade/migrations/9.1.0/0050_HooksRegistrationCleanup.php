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

class HooksRegistrationCleanup extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/* Auto generated hooks added for version 9.1.0 */
INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
    (NULL, \'actionModuleUpgradeAfter\', \'\', \'\', \'1\'),
    (NULL, \'actionModuleEnable\', \'\', \'\', \'1\'),
    (NULL, \'actionModuleDisable\', \'\', \'\', \'1\'),
    (NULL, \'actionConfigurationUpdateValueBefore\', \'\', \'\', \'1\'),
    (NULL, \'actionAdminDuplicateDiscountBefore\', \'\', \'\', \'1\'),
    (NULL, \'actionAdminDuplicateDiscountAfter\', \'\', \'\', \'1\'),
    (NULL, \'actionTagFormBuilderModifier\', \'Modify tag identifiable object form\', \'This hook allows to modify tag identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
    (NULL, \'actionTagFormDataProviderData\', \'Provide tag identifiable object form data for update\', \'This hook allows to provide tag identifiable object form data which will prefill the form in update/edition page\', \'1\'),
    (NULL, \'actionTagFormDataProviderDefaultData\', \'Provide tag identifiable object default form data for creation\', \'This hook allows to provide tag identifiable object form data which will prefill the form in creation page\', \'1\'),
    (NULL, \'actionBeforeUpdateTagFormHandler\', \'Modify tag identifiable object data before updating it\', \'This hook allows to modify tag identifiable object forms data before it was updated\', \'1\'),
    (NULL, \'actionAfterUpdateTagFormHandler\', \'Modify tag identifiable object data after updating it\', \'This hook allows to modify tag identifiable object forms data after it was updated\', \'1\'),
    (NULL, \'actionBeforeCreateTagFormHandler\', \'Modify tag identifiable object data before creating it\', \'This hook allows to modify tag identifiable object forms data before it was created\', \'1\'),
    (NULL, \'actionAfterCreateTagFormHandler\', \'Modify tag identifiable object data after creating it\', \'This hook allows to modify tag identifiable object forms data after it was created\', \'1\'),
    (NULL, \'actionDiscountGridDefinitionModifier\', \'Modify discount grid definition\', \'This hook allows to alter discount grid columns, actions and filters\', \'1\'),
    (NULL, \'actionDiscountGridQueryBuilderModifier\', \'Modify discount grid query builder\', \'This hook allows to alter Doctrine query builder for discount grid\', \'1\'),
    (NULL, \'actionDiscountGridDataModifier\', \'Modify discount grid data\', \'This hook allows to modify discount grid data\', \'1\'),
    (NULL, \'actionDiscountGridFilterFormModifier\', \'Modify discount grid filters\', \'This hook allows to modify filters for discount grid\', \'1\'),
    (NULL, \'actionDiscountGridPresenterModifier\', \'Modify discount grid template data\', \'This hook allows to modify data which is about to be used in template for discount grid\', \'1\'),
    (NULL, \'actionUpdateDefaultCombinationAfter\', \'After default combination update\', \'Allows modules to react after the default combination of a product has been updated. This hook is triggered once the default combination has been successfully changed.\', \'1\'),
    (NULL, \'actionOverrideShippingFreePrice\', \'Override price that determines free shipping\', \'Allows modules to override the free shipping price and return their custom value, for example to specify it by zone or other criteria.\', \'1\'),
    (NULL, \'actionOverrideShippingFreeWeight\', \'Override weight that determines free shipping\', \'Allows modules to override the free shipping weight and return their custom value, for example to specify it by zone or other criteria.\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
        $this->addSql('/* Auto generated hooks removed for version 9.1.0 */
DELETE FROM `PREFIX_hook` WHERE `name` IN (
    \'actionCartRuleFormDataProviderData\',
    \'actionCartRuleFormDataProviderDefaultData\'
)');
        $this->addSql('/* Clean hook registrations related to removed hooks */
DELETE FROM `PREFIX_hook_module` WHERE `id_hook` NOT IN (SELECT id_hook FROM `PREFIX_hook`)');
        $this->addSql('DELETE FROM `PREFIX_hook_module_exceptions` WHERE `id_hook` NOT IN (SELECT id_hook FROM `PREFIX_hook`)');
    }
}
