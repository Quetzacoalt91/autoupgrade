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

class SitemapAndAdminMenuHooks extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'actionModifyFrontendSitemap\', \'Add or remove links on sitemap page\', \'This hook allows to modify links on sitemap page of your shop. Useful to improve indexation of your modules.\', \'1\'),
  (NULL, \'displayAddressSelectorBottom\', \'After address selection on checkout page\', \'This hook is displayed after the address selection in checkout step.\', \'1\'),
  (NULL, \'actionGenerateDocumentReference\', \'Modify document reference\', \'This hook allows modules to return custom document references\', \'1\'),
  (NULL, \'actionLoggerLogMessage\', \'Allows to make extra action while a log is triggered\', \'This hook allows to make an extra action while an exception is thrown and the logger logs it\', \'1\'),
  (NULL, \'actionProductPriceCalculation\', \'Product Price Calculation\', \'This hook is called into the priceCalculation method to be able to override the price calculation\', \'1\'),
  (NULL, \'actionAfterCreateCountryFormHandler\',\'Modify country identifiable object data after creating it\',\'This hook allows to modify country identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterCreateOrderReturnFormHandler\',\'Modify order return identifiable object data after creating it\',\'This hook allows to modify order return identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterCreateProductShopsFormHandler\',\'Modify product shops identifiable object data after creating it\',\'This hook allows to modify product shops identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterCreateStateFormHandler\',\'Modify state identifiable object data after creating it\',\'This hook allows to modify state identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterCreateTaxRulesGroupFormHandler\',\'Modify tax rules group identifiable object data after creating it\',\'This hook allows to modify tax rules group identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterUpdateCountryFormHandler\',\'Modify country identifiable object data after updating it\',\'This hook allows to modify country identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateOrderReturnFormHandler\',\'Modify order return identifiable object data after updating it\',\'This hook allows to modify order return identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateProductShopsFormHandler\',\'Modify product shops identifiable object data after updating it\',\'This hook allows to modify product shops identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateStateFormHandler\',\'Modify state identifiable object data after updating it\',\'This hook allows to modify state identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateTaxRulesGroupFormHandler\',\'Modify tax rules group identifiable object data after updating it\',\'This hook allows to modify tax rules group identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionBeforeCreateCountryFormHandler\',\'Modify country identifiable object data before creating it\',\'This hook allows to modify country identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeCreateOrderReturnFormHandler\',\'Modify order return identifiable object data before creating it\',\'This hook allows to modify order return identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeCreateProductShopsFormHandler\',\'Modify product shops identifiable object data before creating it\',\'This hook allows to modify product shops identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeCreateStateFormHandler\',\'Modify state identifiable object data before creating it\',\'This hook allows to modify state identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeCreateTaxRulesGroupFormHandler\',\'Modify tax rules group identifiable object data before creating it\',\'This hook allows to modify tax rules group identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeUpdateCountryFormHandler\',\'Modify country identifiable object data before updating it\',\'This hook allows to modify country identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionBeforeUpdateOrderReturnFormHandler\',\'Modify order return identifiable object data before updating it\',\'This hook allows to modify order return identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionBeforeUpdateProductShopsFormHandler\',\'Modify product shops identifiable object data before updating it\',\'This hook allows to modify product shops identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionBeforeUpdateStateFormHandler\',\'Modify state identifiable object data before updating it\',\'This hook allows to modify state identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionBeforeUpdateTaxRulesGroupFormHandler\',\'Modify tax rules group identifiable object data before updating it\',\'This hook allows to modify tax rules group identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionCountryFormBuilderModifier\',\'Modify country identifiable object form\',\'This hook allows to modify country identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionCountryFormDataProviderData\',\'Provide country identifiable object form data for update\',\'This hook allows to provide country identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionCountryFormDataProviderDefaultData\',\'Provide country identifiable object default form data for creation\',\'This hook allows to provide country identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionCustomerThreadGridDataModifier\',\'Modify customer thread grid data\',\'This hook allows to modify customer thread grid data\', \'1\'),
  (NULL, \'actionCustomerThreadGridDefinitionModifier\',\'Modify customer thread grid definition\',\'This hook allows to alter customer thread grid columns, actions and filters\', \'1\'),
  (NULL, \'actionCustomerThreadGridFilterFormModifier\',\'Modify customer thread grid filters\',\'This hook allows to modify filters for customer thread grid\', \'1\'),
  (NULL, \'actionCustomerThreadGridPresenterModifier\',\'Modify customer thread grid template data\',\'This hook allows to modify data which is about to be used in template for customer thread grid\', \'1\'),
  (NULL, \'actionCustomerThreadGridQueryBuilderModifier\',\'Modify customer thread grid query builder\',\'This hook allows to alter Doctrine query builder for customer thread grid\', \'1\'),
  (NULL, \'actionOrderReturnFormBuilderModifier\',\'Modify order return identifiable object form\',\'This hook allows to modify order return identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionOrderReturnFormDataProviderData\',\'Provide order return identifiable object form data for update\',\'This hook allows to provide order return identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionOrderReturnFormDataProviderDefaultData\',\'Provide order return identifiable object default form data for creation\',\'This hook allows to provide order return identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionProductShopsFormBuilderModifier\',\'Modify product shops identifiable object form\',\'This hook allows to modify product shops identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionProductShopsFormDataProviderData\',\'Provide product shops identifiable object form data for update\',\'This hook allows to provide product shops identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionProductShopsFormDataProviderDefaultData\',\'Provide product shops identifiable object default form data for creation\',\'This hook allows to provide product shops identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionStateFormBuilderModifier\',\'Modify state identifiable object form\',\'This hook allows to modify state identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionStateFormDataProviderData\',\'Provide state identifiable object form data for update\',\'This hook allows to provide state identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionStateFormDataProviderDefaultData\',\'Provide state identifiable object default form data for creation\',\'This hook allows to provide state identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionTaxRulesGroupFormBuilderModifier\',\'Modify tax rules group identifiable object form\',\'This hook allows to modify tax rules group identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionTaxRulesGroupFormDataProviderData\',\'Provide tax rules group identifiable object form data for update\',\'This hook allows to provide tax rules group identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionTaxRulesGroupFormDataProviderDefaultData\',\'Provide tax rules group identifiable object default form data for creation\',\'This hook allows to provide tax rules group identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'displayContactContent\',\'Content wrapper section of the contact page\',\'This hook displays new elements in the content wrapper of the contact page\', \'1\'),
  (NULL, \'displayContactLeftColumn\',\'Left column blocks on the contact page\',\'This hook displays new elements in the left-hand column of the contact page\', \'1\'),
  (NULL, \'displayContactRightColumn\',\'Right column blocks of the contact page\',\'This hook displays new elements in the right-hand column of the contact page\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'actionAdminMenuTabsModifier\', \'Modify back office menu\', \'This hook allows modifying back office menu tabs\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
    }
}
