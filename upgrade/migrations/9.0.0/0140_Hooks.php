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

class Hooks extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * Auto generated hooks added for version 9.0.0
         *
         * @see https://github.com/PrestaShop/PrestaShop/pull/34133
         */
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'actionMailAlterMessageBeforeSend\', \'Modify Swift Message before sending\', \'This hook is called before the Swift Message is sent in Mail.php\', \'1\'),
  (NULL, \'actionValidateOrderBefore\', \'Before validating an order\', \'This hook is called before validating an order by core\', \'1\'),
  (NULL, \'actionDuplicateCartData\', \'Cart duplication\', \'This hook is triggered after all the cart related data has been duplicated\', \'1\'),
  (NULL, \'actionObjectDuplicateAfter\', \'After duplicating an object\', \'This hook is called after duplicating an object by the core.\', \'1\'),
  (NULL, \'displayCartExtraProductInfo\', \'Extra information in shopping cart product line\', \'This hook adds extra information to the product lines, in the shopping cart\', \'1\'),
  (NULL, \'actionPresentSupplier\', \'Supplier Presenter\', \'This hook is called before a supplier is presented\', \'1\'),
  (NULL, \'actionPresentManufacturer\', \'Manufacturer Presenter\', \'This hook is called before a manufacturer is presented\', \'1\'),
  (NULL, \'actionPresentStore\', \'Store Presenter\', \'This hook is called before a store is presented\', \'1\'),
  (NULL, \'actionPresentCategory\', \'Category Presenter\', \'This hook is called before a category is presented\', \'1\'),
  (NULL, \'actionCartGetPackageShippingCost\', \'After getting package shipping cost value\', \'This hook is called in order to allow to modify package shipping cost\', \'1\'),
  (NULL, \'actionUpdateCartAddress\', \'Triggers after changing address on the cart\', \'This hook is called after address is changed on the cart\', \'1\'),
  (NULL, \'actionValidateCartRule\', \'Alter cart rule validation process\', \'Allow modules to implement their own rules to validate a cart rule.\', \'1\'),
  (NULL, \'actionFeatureValueFormBuilderModifier\', \'Modify feature value identifiable object form\', \'This hook allows to modify feature value identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionCartRuleFormBuilderModifier\', \'Modify cart rule identifiable object form\', \'This hook allows to modify cart rule identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionTitleFormBuilderModifier\', \'Modify title identifiable object form\', \'This hook allows to modify title identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionApiClientFormBuilderModifier\', \'Modify api client identifiable object form\', \'This hook allows to modify api client identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionImageTypeFormBuilderModifier\', \'Modify image type identifiable object form\', \'This hook allows to modify image type identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionCarrierFormBuilderModifier\', \'Modify carrier identifiable object form\', \'This hook allows to modify carrier identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionFeatureValueFormDataProviderData\', \'Provide feature value identifiable object form data for update\', \'This hook allows to provide feature value identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionCartRuleFormDataProviderData\', \'Provide cart rule identifiable object form data for update\', \'This hook allows to provide cart rule identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionTitleFormDataProviderData\', \'Provide title identifiable object form data for update\', \'This hook allows to provide title identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionApiClientFormDataProviderData\', \'Provide api client identifiable object form data for update\', \'This hook allows to provide api client identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionImageTypeFormDataProviderData\', \'Provide image type identifiable object form data for update\', \'This hook allows to provide image type identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionCarrierFormDataProviderData\', \'Provide carrier identifiable object form data for update\', \'This hook allows to provide carrier identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionFeatureValueFormDataProviderDefaultData\', \'Provide feature value identifiable object default form data for creation\', \'This hook allows to provide feature value identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionCartRuleFormDataProviderDefaultData\', \'Provide cart rule identifiable object default form data for creation\', \'This hook allows to provide cart rule identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionTitleFormDataProviderDefaultData\', \'Provide title identifiable object default form data for creation\', \'This hook allows to provide title identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionApiClientFormDataProviderDefaultData\', \'Provide api client identifiable object default form data for creation\', \'This hook allows to provide api client identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionImageTypeFormDataProviderDefaultData\', \'Provide image type identifiable object default form data for creation\', \'This hook allows to provide image type identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionCarrierFormDataProviderDefaultData\', \'Provide carrier identifiable object default form data for creation\', \'This hook allows to provide carrier identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionBeforeUpdateFeatureValueFormHandler\', \'Modify feature value identifiable object data before updating it\', \'This hook allows to modify feature value identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionBeforeUpdateCartRuleFormHandler\', \'Modify cart rule identifiable object data before updating it\', \'This hook allows to modify cart rule identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionBeforeUpdateTitleFormHandler\', \'Modify title identifiable object data before updating it\', \'This hook allows to modify title identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionBeforeUpdateApiClientFormHandler\', \'Modify api client identifiable object data before updating it\', \'This hook allows to modify api client identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionBeforeUpdateImageTypeFormHandler\', \'Modify image type identifiable object data before updating it\', \'This hook allows to modify image type identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionBeforeUpdateCarrierFormHandler\', \'Modify carrier identifiable object data before updating it\', \'This hook allows to modify carrier identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateFeatureValueFormHandler\', \'Modify feature value identifiable object data after updating it\', \'This hook allows to modify feature value identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateCartRuleFormHandler\', \'Modify cart rule identifiable object data after updating it\', \'This hook allows to modify cart rule identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateTitleFormHandler\', \'Modify title identifiable object data after updating it\', \'This hook allows to modify title identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateApiClientFormHandler\', \'Modify api client identifiable object data after updating it\', \'This hook allows to modify api client identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateImageTypeFormHandler\', \'Modify image type identifiable object data after updating it\', \'This hook allows to modify image type identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateCarrierFormHandler\', \'Modify carrier identifiable object data after updating it\', \'This hook allows to modify carrier identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionBeforeCreateFeatureValueFormHandler\', \'Modify feature value identifiable object data before creating it\', \'This hook allows to modify feature value identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeCreateCartRuleFormHandler\', \'Modify cart rule identifiable object data before creating it\', \'This hook allows to modify cart rule identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeCreateTitleFormHandler\', \'Modify title identifiable object data before creating it\', \'This hook allows to modify title identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeCreateApiClientFormHandler\', \'Modify api client identifiable object data before creating it\', \'This hook allows to modify api client identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeCreateImageTypeFormHandler\', \'Modify image type identifiable object data before creating it\', \'This hook allows to modify image type identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionBeforeCreateCarrierFormHandler\', \'Modify carrier identifiable object data before creating it\', \'This hook allows to modify carrier identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionAfterCreateFeatureValueFormHandler\', \'Modify feature value identifiable object data after creating it\', \'This hook allows to modify feature value identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterCreateCartRuleFormHandler\', \'Modify cart rule identifiable object data after creating it\', \'This hook allows to modify cart rule identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterCreateTitleFormHandler\', \'Modify title identifiable object data after creating it\', \'This hook allows to modify title identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterCreateApiClientFormHandler\', \'Modify api client identifiable object data after creating it\', \'This hook allows to modify api client identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterCreateImageTypeFormHandler\', \'Modify image type identifiable object data after creating it\', \'This hook allows to modify image type identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionAfterCreateCarrierFormHandler\', \'Modify carrier identifiable object data after creating it\', \'This hook allows to modify carrier identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionImageSettingsPageForm\', \'Modify image settings page options form content\', \'This hook allows to modify image settings page options form FormBuilder\', \'1\'),
  (NULL, \'actionAdminAPIForm\', \'Modify admin api options form content\', \'This hook allows to modify admin api options form FormBuilder\', \'1\'),
  (NULL, \'actionBackOfficeLoginForm\', \'Modify back office login options form content\', \'This hook allows to modify back office login options form FormBuilder\', \'1\'),
  (NULL, \'actionEmployeeRequestPasswordResetForm\', \'Modify employee request password reset options form content\', \'This hook allows to modify employee request password reset options form FormBuilder\', \'1\'),
  (NULL, \'actionEmployeeResetPasswordForm\', \'Modify employee reset password options form content\', \'This hook allows to modify employee reset password options form FormBuilder\', \'1\'),
  (NULL, \'actionImageSettingsPageSave\', \'Modify image settings page options form saved data\', \'This hook allows to modify data of image settings page options form after it was saved\', \'1\'),
  (NULL, \'actionAdminAPISave\', \'Modify admin api options form saved data\', \'This hook allows to modify data of admin api options form after it was saved\', \'1\'),
  (NULL, \'actionBackOfficeLoginSave\', \'Modify back office login options form saved data\', \'This hook allows to modify data of back office login options form after it was saved\', \'1\'),
  (NULL, \'actionEmployeeRequestPasswordResetSave\', \'Modify employee request password reset options form saved data\', \'This hook allows to modify data of employee request password reset options form after it was saved\', \'1\'),
  (NULL, \'actionEmployeeResetPasswordSave\', \'Modify employee reset password options form saved data\', \'This hook allows to modify data of employee reset password options form after it was saved\', \'1\'),
  (NULL, \'actionCustomerCartGridDefinitionModifier\', \'Modify customer cart grid definition\', \'This hook allows to alter customer cart grid columns, actions and filters\', \'1\'),
  (NULL, \'actionCustomerOrderGridDefinitionModifier\', \'Modify customer order grid definition\', \'This hook allows to alter customer order grid columns, actions and filters\', \'1\'),
  (NULL, \'actionCustomerBoughtProductGridDefinitionModifier\', \'Modify customer bought product grid definition\', \'This hook allows to alter customer bought product grid columns, actions and filters\', \'1\'),
  (NULL, \'actionCustomerViewedProductGridDefinitionModifier\', \'Modify customer viewed product grid definition\', \'This hook allows to alter customer viewed product grid columns, actions and filters\', \'1\'),
  (NULL, \'actionCustomerGroupsGridDefinitionModifier\', \'Modify customer groups grid definition\', \'This hook allows to alter customer groups grid columns, actions and filters\', \'1\'),
  (NULL, \'actionCustomerCartGridQueryBuilderModifier\', \'Modify customer cart grid query builder\', \'This hook allows to alter Doctrine query builder for customer cart grid\', \'1\'),
  (NULL, \'actionCustomerOrderGridQueryBuilderModifier\', \'Modify customer order grid query builder\', \'This hook allows to alter Doctrine query builder for customer order grid\', \'1\'),
  (NULL, \'actionCustomerBoughtProductGridQueryBuilderModifier\', \'Modify customer bought product grid query builder\', \'This hook allows to alter Doctrine query builder for customer bought product grid\', \'1\'),
  (NULL, \'actionCustomerViewedProductGridQueryBuilderModifier\', \'Modify customer viewed product grid query builder\', \'This hook allows to alter Doctrine query builder for customer viewed product grid\', \'1\'),
  (NULL, \'actionCustomerGroupsGridQueryBuilderModifier\', \'Modify customer groups grid query builder\', \'This hook allows to alter Doctrine query builder for customer groups grid\', \'1\'),
  (NULL, \'actionCustomerCartGridDataModifier\', \'Modify customer cart grid data\', \'This hook allows to modify customer cart grid data\', \'1\'),
  (NULL, \'actionCustomerOrderGridDataModifier\', \'Modify customer order grid data\', \'This hook allows to modify customer order grid data\', \'1\'),
  (NULL, \'actionCustomerBoughtProductGridDataModifier\', \'Modify customer bought product grid data\', \'This hook allows to modify customer bought product grid data\', \'1\'),
  (NULL, \'actionCustomerViewedProductGridDataModifier\', \'Modify customer viewed product grid data\', \'This hook allows to modify customer viewed product grid data\', \'1\'),
  (NULL, \'actionCustomerGroupsGridDataModifier\', \'Modify customer groups grid data\', \'This hook allows to modify customer groups grid data\', \'1\'),
  (NULL, \'actionCustomerCartGridFilterFormModifier\', \'Modify customer cart grid filters\', \'This hook allows to modify filters for customer cart grid\', \'1\'),
  (NULL, \'actionCustomerOrderGridFilterFormModifier\', \'Modify customer order grid filters\', \'This hook allows to modify filters for customer order grid\', \'1\'),
  (NULL, \'actionCustomerBoughtProductGridFilterFormModifier\', \'Modify customer bought product grid filters\', \'This hook allows to modify filters for customer bought product grid\', \'1\'),
  (NULL, \'actionCustomerViewedProductGridFilterFormModifier\', \'Modify customer viewed product grid filters\', \'This hook allows to modify filters for customer viewed product grid\', \'1\'),
  (NULL, \'actionCustomerGroupsGridFilterFormModifier\', \'Modify customer groups grid filters\', \'This hook allows to modify filters for customer groups grid\', \'1\'),
  (NULL, \'actionCustomerCartGridPresenterModifier\', \'Modify customer cart grid template data\', \'This hook allows to modify data which is about to be used in template for customer cart grid\', \'1\'),
  (NULL, \'actionCustomerOrderGridPresenterModifier\', \'Modify customer order grid template data\', \'This hook allows to modify data which is about to be used in template for customer order grid\', \'1\'),
  (NULL, \'actionCustomerBoughtProductGridPresenterModifier\', \'Modify customer bought product grid template data\', \'This hook allows to modify data which is about to be used in template for customer bought product grid\', \'1\'),
  (NULL, \'actionCustomerViewedProductGridPresenterModifier\', \'Modify customer viewed product grid template data\', \'This hook allows to modify data which is about to be used in template for customer viewed product grid\', \'1\'),
  (NULL, \'actionCustomerGroupsGridPresenterModifier\', \'Modify customer groups grid template data\', \'This hook allows to modify data which is about to be used in template for customer groups grid\', \'1\'),
  (NULL, \'actionPDFInvoiceRender\', \'PDF Invoice - Render\', \'This hook is called when a PDF invoice is rendered from the Front Office and the Back Office\', \'1\'),
  (NULL, \'actionPresentObject\', \'Object Presenter\', \'This hook is called before an object is presented\', \'1\'),
  (NULL, \'actionSetInvoice\', \'\', \'\', \'1\'),
  (NULL, \'actionOrderHistoryAddAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionInvoiceNumberFormatted\', \'\', \'\', \'1\'),
  (NULL, \'actionOnImageResizeAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionOnImageCutAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionSubmitCustomerAddressForm\', \'\', \'\', \'1\'),
  (NULL, \'actionCartSummary\', \'\', \'\', \'1\'),
  (NULL, \'actionGetExtraMailTemplateVars\', \'\', \'\', \'1\'),
  (NULL, \'deleteProductAttribute\', \'\', \'\', \'1\'),
  (NULL, \'actionGetProductPropertiesBefore\', \'\', \'\', \'1\'),
  (NULL, \'actionGetProductPropertiesAfter\', \'\', \'\', \'1\'),
  (NULL, \'displayCustomization\', \'\', \'\', \'1\'),
  (NULL, \'actionDeliveryPriceByWeight\', \'\', \'\', \'1\'),
  (NULL, \'actionDeliveryPriceByPrice\', \'\', \'\', \'1\'),
  (NULL, \'actionDispatcher\', \'\', \'\', \'1\'),
  (NULL, \'moduleRoutes\', \'\', \'\', \'1\'),
  (NULL, \'actionGetIDZoneByAddressID\', \'\', \'\', \'1\'),
  (NULL, \'actionModuleRegisterHookBefore\', \'\', \'\', \'1\'),
  (NULL, \'actionModuleRegisterHookAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionModuleUnRegisterHookBefore\', \'\', \'\', \'1\'),
  (NULL, \'actionModuleUnRegisterHookAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionShopDataDuplication\', \'\', \'\', \'1\'),
  (NULL, \'actionAdminMetaBeforeWriteRobotsFile\', \'\', \'\', \'1\'),
  (NULL, \'actionAdminMetaAfterWriteRobotsFile\', \'\', \'\', \'1\'),
  (NULL, \'termsAndConditions\', \'\', \'\', \'1\'),
  (NULL, \'actionValidateStepComplete\', \'\', \'\', \'1\'),
  (NULL, \'actionAdminControllerSetMedia\', \'\', \'\', \'1\'),
  (NULL, \'overrideMinimalPurchasePrice\', \'\', \'\', \'1\'),
  (NULL, \'actionFrontControllerSetMedia\', \'\', \'\', \'1\'),
  (NULL, \'overrideLayoutTemplate\', \'\', \'\', \'1\'),
  (NULL, \'productSearchProvider\', \'\', \'\', \'1\'),
  (NULL, \'actionAttributeCombinationDelete\', \'\', \'\', \'1\'),
  (NULL, \'actionAttributeCombinationSave\', \'\', \'\', \'1\'),
  (NULL, \'actionCustomerBeforeUpdateGroup\', \'\', \'\', \'1\'),
  (NULL, \'actionCustomerAddGroups\', \'\', \'\', \'1\'),
  (NULL, \'actionProductCoverage\', \'\', \'\', \'1\'),
  (NULL, \'actionObjectAddBefore\', \'\', \'\', \'1\'),
  (NULL, \'actionObjectAddAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionObjectUpdateBefore\', \'\', \'\', \'1\'),
  (NULL, \'actionObjectUpdateAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionObjectDeleteBefore\', \'\', \'\', \'1\'),
  (NULL, \'actionObjectDeleteAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionWishlistAddProduct\', \'\', \'\', \'1\'),
  (NULL, \'displayGDPRConsent\', \'\', \'\', \'1\'),
  (NULL, \'actionObjectProductCommentValidateAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionExportGDPRData\', \'\', \'\', \'1\'),
  (NULL, \'actionDeleteGDPRCustomer\', \'\', \'\', \'1\'),
  (NULL, \'actionModuleMailAlertSendCustomer\', \'\', \'\', \'1\'),
  (NULL, \'actionNewsletterRegistrationBefore\', \'\', \'\', \'1\'),
  (NULL, \'actionNewsletterRegistrationAfter\', \'\', \'\', \'1\'),
  (NULL, \'displayNewsletterRegistration\', \'\', \'\', \'1\'),
  (NULL, \'dashboardZoneOne\', \'\', \'\', \'1\'),
  (NULL, \'dashboardZoneTwo\', \'\', \'\', \'1\'),
  (NULL, \'dashboardData\', \'\', \'\', \'1\'),
  (NULL, \'actionPasswordRenew\', \'\', \'\', \'1\'),
  (NULL, \'actionDownloadAttachment\', \'\', \'\', \'1\'),
  (NULL, \'displayReassurance\', \'\', \'\', \'1\'),
  (NULL, \'displayProductPriceBlock\', \'\', \'\', \'1\'),
  (NULL, \'displayProductListReviews\', \'\', \'\', \'1\'),
  (NULL, \'displayCrossSellingShoppingCart\', \'\', \'\', \'1\'),
  (NULL, \'displayExpressCheckout\', \'\', \'\', \'1\'),
  (NULL, \'displayCheckoutSubtotalDetails\', \'\', \'\', \'1\'),
  (NULL, \'displayNav1\', \'\', \'\', \'1\'),
  (NULL, \'displayNav2\', \'\', \'\', \'1\'),
  (NULL, \'displayOrderConfirmation1\', \'\', \'\', \'1\'),
  (NULL, \'displayOrderConfirmation2\', \'\', \'\', \'1\'),
  (NULL, \'displayFooterBefore\', \'\', \'\', \'1\'),
  (NULL, \'displayFooterAfter\', \'\', \'\', \'1\'),
  (NULL, \'displayCMSDisputeInformation\', \'\', \'\', \'1\'),
  (NULL, \'displayCMSPrintButton\', \'\', \'\', \'1\'),
  (NULL, \'displaySearch\', \'\', \'\', \'1\'),
  (NULL, \'displayNotFound\', \'\', \'\', \'1\'),
  (NULL, \'displayAdminAfterHeader\', \'\', \'\', \'1\'),
  (NULL, \'displayAdminNavBarBeforeEnd\', \'\', \'\', \'1\'),
  (NULL, \'displayAdminListBefore\', \'\', \'\', \'1\'),
  (NULL, \'displayAdminListAfter\', \'\', \'\', \'1\'),
  (NULL, \'displayAdminOptions\', \'\', \'\', \'1\'),
  (NULL, \'displayAdminForm\', \'\', \'\', \'1\'),
  (NULL, \'displayAdminView\', \'\', \'\', \'1\'),
  (NULL, \'displayAdminOrderSideBottom\', \'\', \'\', \'1\'),
  (NULL, \'displayOrderPreview\', \'\', \'\', \'1\'),
  (NULL, \'displayAdminLogin\', \'\', \'\', \'1\'),
  (NULL, \'actionPresentModule\', \'\', \'\', \'1\'),
  (NULL, \'actionAdminThemesControllerUpdate_optionsAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionAdminDuplicateBefore\', \'\', \'\', \'1\'),
  (NULL, \'actionAdminDuplicateAfter\', \'\', \'\', \'1\'),
  (NULL, \'actionSearch\', \'\', \'\', \'1\'),
  (NULL, \'actionSearchTermFormBuilderModifier\', \'Modify search term identifiable object form\', \'This hook allows to modify search term identifiable object forms content by modifying form builder data or FormBuilder itself\', \'1\'),
  (NULL, \'actionSearchTermFormDataProviderData\', \'Provide search term identifiable object form data for update\', \'This hook allows to provide search term identifiable object form data which will prefill the form in update/edition page\', \'1\'),
  (NULL, \'actionSearchTermFormDataProviderDefaultData\', \'Provide search term identifiable object default form data for creation\', \'This hook allows to provide search term identifiable object form data which will prefill the form in creation page\', \'1\'),
  (NULL, \'actionBeforeUpdateSearchTermFormHandler\', \'Modify search term identifiable object data before updating it\', \'This hook allows to modify search term identifiable object forms data before it was updated\', \'1\'),
  (NULL, \'actionAfterUpdateSearchTermFormHandler\', \'Modify search term identifiable object data after updating it\', \'This hook allows to modify search term identifiable object forms data after it was updated\', \'1\'),
  (NULL, \'actionBeforeCreateSearchTermFormHandler\', \'Modify search term identifiable object data before creating it\', \'This hook allows to modify search term identifiable object forms data before it was created\', \'1\'),
  (NULL, \'actionAfterCreateSearchTermFormHandler\', \'Modify search term identifiable object data after creating it\', \'This hook allows to modify search term identifiable object forms data after it was created\', \'1\'),
  (NULL, \'actionProductGetAttributesGroupsBefore\', \'Triggers before getting product attributes groups\', \'Allows to modify product attributes groups SQL query before they are retrieved from the database.\', \'1\'),
  (NULL, \'actionProductGetAttributesGroupsAfter\', \'Triggers after getting product attributes groups\', \'Allows to modify product attributes groups after they are retrieved from the database.\', \'1\'),
  (NULL, \'actionGetPdfRenderer\', \'Provide a PDF renderer\', \'This hook allows to provide a custom PDF renderer to generate PDF files\', \'1\'),
  (NULL, \'displayAdminStoreInformation\', \'Display extra store information\', \'This hook displays content in the Information page to add store information\', \'1\'),
  (NULL, \'actionSubmitAccountBefore\', \'Before customer account creation\', \'This hook is called before a customer account creation\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');

        /*
         * Auto generated hooks removed for version 9.0.0
         */
        $this->addSql('DELETE FROM `PREFIX_hook` WHERE `name` IN (
  \'actionAdminLoginControllerBefore\',
  \'actionAdminLoginControllerLoginBefore\',
  \'actionAdminLoginControllerLoginAfter\',
  \'actionAdminLoginControllerForgotBefore\',
  \'actionAdminLoginControllerForgotAfter\',
  \'actionAdminLoginControllerResetBefore\',
  \'actionAdminLoginControllerResetAfter\',
  \'actionBeforeEnableMobileModule\',
  \'actionBeforeDisableMobileModule\',
  \'actionAjaxDieBefore\'
)');

        /*
         * Clean hook registrations related to removed hooks
         */
        $this->addSql('DELETE FROM `PREFIX_hook_module` WHERE `id_hook` NOT IN (SELECT id_hook FROM `PREFIX_hook`)');
        $this->addSql('DELETE FROM `PREFIX_hook_module_exceptions` WHERE `id_hook` NOT IN (SELECT id_hook FROM `PREFIX_hook`)');
    }
}
