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

class HookRenames extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`)
VALUES (NULL, \'actionOrderMessageFormBuilderModifier\', \'Modify order message identifiable object form\',
        \'This hook allows to modify order message identifiable object forms content by modifying form builder data or FormBuilder itself\',
        \'1\'),
       (NULL, \'actionCatalogPriceRuleFormBuilderModifier\', \'Modify catalog price rule identifiable object form\',
        \'This hook allows to modify catalog price rule identifiable object forms content by modifying form builder data or FormBuilder itself\',
        \'1\'),
       (NULL, \'actionAttachmentFormBuilderModifier\', \'Modify attachment identifiable object form\',
        \'This hook allows to modify attachment identifiable object forms content by modifying form builder data or FormBuilder itself\',
        \'1\'),
       (NULL, \'actionBeforeUpdateFeatureFormHandler\', \'Modify feature identifiable object data before updating it\',
        \'This hook allows to modify feature identifiable object forms data before it was updated\', \'1\'),
       (NULL, \'actionBeforeUpdateOrderMessageFormHandler\',
        \'Modify order message identifiable object data before updating it\',
        \'This hook allows to modify order message identifiable object forms data before it was updated\', \'1\'),
       (NULL, \'actionBeforeUpdateCatalogPriceRuleFormHandler\',
        \'Modify catalog price rule identifiable object data before updating it\',
        \'This hook allows to modify catalog price rule identifiable object forms data before it was updated\', \'1\'),
       (NULL, \'actionBeforeUpdateAttachmentFormHandler\',
        \'Modify attachment identifiable object data before updating it\',
        \'This hook allows to modify attachment identifiable object forms data before it was updated\', \'1\'),
       (NULL, \'actionAfterUpdateOrderMessageFormHandler\',
        \'Modify order message identifiable object data after updating it\',
        \'This hook allows to modify order message identifiable object forms data after it was updated\', \'1\'),
       (NULL, \'actionAfterUpdateCatalogPriceRuleFormHandler\',
        \'Modify catalog price rule identifiable object data after updating it\',
        \'This hook allows to modify catalog price rule identifiable object forms data after it was updated\', \'1\'),
       (NULL, \'actionAfterUpdateAttachmentFormHandler\', \'Modify attachment identifiable object data after updating it\',
        \'This hook allows to modify attachment identifiable object forms data after it was updated\', \'1\'),
       (NULL, \'actionBeforeCreateFeatureFormHandler\', \'Modify feature identifiable object data before creating it\',
        \'This hook allows to modify feature identifiable object forms data before it was created\', \'1\'),
       (NULL, \'actionBeforeCreateOrderMessageFormHandler\',
        \'Modify order message identifiable object data before creating it\',
        \'This hook allows to modify order message identifiable object forms data before it was created\', \'1\'),
       (NULL, \'actionBeforeCreateCatalogPriceRuleFormHandler\',
        \'Modify catalog price rule identifiable object data before creating it\',
        \'This hook allows to modify catalog price rule identifiable object forms data before it was created\', \'1\'),
       (NULL, \'actionBeforeCreateAttachmentFormHandler\',
        \'Modify attachment identifiable object data before creating it\',
        \'This hook allows to modify attachment identifiable object forms data before it was created\', \'1\'),
       (NULL, \'actionAfterCreateOrderMessageFormHandler\',
        \'Modify order message identifiable object data after creating it\',
        \'This hook allows to modify order message identifiable object forms data after it was created\', \'1\'),
       (NULL, \'actionAfterCreateCatalogPriceRuleFormHandler\',
        \'Modify catalog price rule identifiable object data after creating it\',
        \'This hook allows to modify catalog price rule identifiable object forms data after it was created\', \'1\'),
       (NULL, \'actionAfterCreateAttachmentFormHandler\', \'Modify attachment identifiable object data after creating it\',
        \'This hook allows to modify attachment identifiable object forms data after it was created\', \'1\'),
       (NULL, \'actionMerchandiseReturnForm\', \'Modify merchandise return options form content\',
        \'This hook allows to modify merchandise return options form FormBuilder\', \'1\'),
       (NULL, \'actionCreditSlipForm\', \'Modify credit slip options form content\',
        \'This hook allows to modify credit slip options form FormBuilder\', \'1\'),
       (NULL, \'actionMerchandiseReturnSave\', \'Modify merchandise return options form saved data\',
        \'This hook allows to modify data of merchandise return options form after it was saved\', \'1\'),
       (NULL, \'actionCreditSlipSave\', \'Modify credit slip options form saved data\',
        \'This hook allows to modify data of credit slip options form after it was saved\', \'1\'),
       (NULL, \'actionEmptyCategoryGridDefinitionModifier\', \'Modify empty category grid definition\',
        \'This hook allows to alter empty category grid columns, actions and filters\', \'1\'),
       (NULL, \'actionNoQtyProductWithCombinationGridDefinitionModifier\',
        \'Modify no qty product with combination grid definition\',
        \'This hook allows to alter no qty product with combination grid columns, actions and filters\', \'1\'),
       (NULL, \'actionNoQtyProductWithoutCombinationGridDefinitionModifier\',
        \'Modify no qty product without combination grid definition\',
        \'This hook allows to alter no qty product without combination grid columns, actions and filters\', \'1\'),
       (NULL, \'actionDisabledProductGridDefinitionModifier\', \'Modify disabled product grid definition\',
        \'This hook allows to alter disabled product grid columns, actions and filters\', \'1\'),
       (NULL, \'actionProductWithoutImageGridDefinitionModifier\', \'Modify product without image grid definition\',
        \'This hook allows to alter product without image grid columns, actions and filters\', \'1\'),
       (NULL, \'actionProductWithoutDescriptionGridDefinitionModifier\',
        \'Modify product without description grid definition\',
        \'This hook allows to alter product without description grid columns, actions and filters\', \'1\'),
       (NULL, \'actionProductWithoutPriceGridDefinitionModifier\', \'Modify product without price grid definition\',
        \'This hook allows to alter product without price grid columns, actions and filters\', \'1\'),
       (NULL, \'actionOrderGridDefinitionModifier\', \'Modify order grid definition\',
        \'This hook allows to alter order grid columns, actions and filters\', \'1\'),
       (NULL, \'actionCatalogPriceRuleGridDefinitionModifier\', \'Modify catalog price rule grid definition\',
        \'This hook allows to alter catalog price rule grid columns, actions and filters\', \'1\'),
       (NULL, \'actionOrderMessageGridDefinitionModifier\', \'Modify order message grid definition\',
        \'This hook allows to alter order message grid columns, actions and filters\', \'1\'),
       (NULL, \'actionAttachmentGridDefinitionModifier\', \'Modify attachment grid definition\',
        \'This hook allows to alter attachment grid columns, actions and filters\', \'1\'),
       (NULL, \'actionAttributeGroupGridDefinitionModifier\', \'Modify attribute group grid definition\',
        \'This hook allows to alter attribute group grid columns, actions and filters\', \'1\'),
       (NULL, \'actionMerchandiseReturnGridDefinitionModifier\', \'Modify merchandise return grid definition\',
        \'This hook allows to alter merchandise return grid columns, actions and filters\', \'1\'),
       (NULL, \'actionTaxRulesGroupGridDefinitionModifier\', \'Modify tax rules group grid definition\',
        \'This hook allows to alter tax rules group grid columns, actions and filters\', \'1\'),
       (NULL, \'actionAddressGridDefinitionModifier\', \'Modify address grid definition\',
        \'This hook allows to alter address grid columns, actions and filters\', \'1\'),
       (NULL, \'actionCreditSlipGridDefinitionModifier\', \'Modify credit slip grid definition\',
        \'This hook allows to alter credit slip grid columns, actions and filters\', \'1\'),
       (NULL, \'actionEmptyCategoryGridQueryBuilderModifier\', \'Modify empty category grid query builder\',
        \'This hook allows to alter Doctrine query builder for empty category grid\', \'1\'),
       (NULL, \'actionNoQtyProductWithCombinationGridQueryBuilderModifier\',
        \'Modify no qty product with combination grid query builder\',
        \'This hook allows to alter Doctrine query builder for no qty product with combination grid\', \'1\'),
       (NULL, \'actionNoQtyProductWithoutCombinationGridQueryBuilderModifier\',
        \'Modify no qty product without combination grid query builder\',
        \'This hook allows to alter Doctrine query builder for no qty product without combination grid\', \'1\'),
       (NULL, \'actionDisabledProductGridQueryBuilderModifier\', \'Modify disabled product grid query builder\',
        \'This hook allows to alter Doctrine query builder for disabled product grid\', \'1\'),
       (NULL, \'actionProductWithoutImageGridQueryBuilderModifier\', \'Modify product without image grid query builder\',
        \'This hook allows to alter Doctrine query builder for product without image grid\', \'1\'),
       (NULL, \'actionProductWithoutDescriptionGridQueryBuilderModifier\',
        \'Modify product without description grid query builder\',
        \'This hook allows to alter Doctrine query builder for product without description grid\', \'1\'),
       (NULL, \'actionProductWithoutPriceGridQueryBuilderModifier\', \'Modify product without price grid query builder\',
        \'This hook allows to alter Doctrine query builder for product without price grid\', \'1\'),
       (NULL, \'actionOrderGridQueryBuilderModifier\', \'Modify order grid query builder\',
        \'This hook allows to alter Doctrine query builder for order grid\', \'1\'),
       (NULL, \'actionCatalogPriceRuleGridQueryBuilderModifier\', \'Modify catalog price rule grid query builder\',
        \'This hook allows to alter Doctrine query builder for catalog price rule grid\', \'1\'),
       (NULL, \'actionOrderMessageGridQueryBuilderModifier\', \'Modify order message grid query builder\',
        \'This hook allows to alter Doctrine query builder for order message grid\', \'1\'),
       (NULL, \'actionAttachmentGridQueryBuilderModifier\', \'Modify attachment grid query builder\',
        \'This hook allows to alter Doctrine query builder for attachment grid\', \'1\'),
       (NULL, \'actionAttributeGroupGridQueryBuilderModifier\', \'Modify attribute group grid query builder\',
        \'This hook allows to alter Doctrine query builder for attribute group grid\', \'1\'),
       (NULL, \'actionMerchandiseReturnGridQueryBuilderModifier\', \'Modify merchandise return grid query builder\',
        \'This hook allows to alter Doctrine query builder for merchandise return grid\', \'1\'),
       (NULL, \'actionTaxRulesGroupGridQueryBuilderModifier\', \'Modify tax rules group grid query builder\',
        \'This hook allows to alter Doctrine query builder for tax rules group grid\', \'1\'),
       (NULL, \'actionAddressGridQueryBuilderModifier\', \'Modify address grid query builder\',
        \'This hook allows to alter Doctrine query builder for address grid\', \'1\'),
       (NULL, \'actionCreditSlipGridQueryBuilderModifier\', \'Modify credit slip grid query builder\',
        \'This hook allows to alter Doctrine query builder for credit slip grid\', \'1\'),
       (NULL, \'actionEmptyCategoryGridDataModifier\', \'Modify empty category grid data\',
        \'This hook allows to modify empty category grid data\', \'1\'),
       (NULL, \'actionNoQtyProductWithCombinationGridDataModifier\', \'Modify no qty product with combination grid data\',
        \'This hook allows to modify no qty product with combination grid data\', \'1\'),
       (NULL, \'actionNoQtyProductWithoutCombinationGridDataModifier\',
        \'Modify no qty product without combination grid data\',
        \'This hook allows to modify no qty product without combination grid data\', \'1\'),
       (NULL, \'actionDisabledProductGridDataModifier\', \'Modify disabled product grid data\',
        \'This hook allows to modify disabled product grid data\', \'1\'),
       (NULL, \'actionProductWithoutImageGridDataModifier\', \'Modify product without image grid data\',
        \'This hook allows to modify product without image grid data\', \'1\'),
       (NULL, \'actionProductWithoutDescriptionGridDataModifier\', \'Modify product without description grid data\',
        \'This hook allows to modify product without description grid data\', \'1\'),
       (NULL, \'actionProductWithoutPriceGridDataModifier\', \'Modify product without price grid data\',
        \'This hook allows to modify product without price grid data\', \'1\'),
       (NULL, \'actionOrderGridDataModifier\', \'Modify order grid data\', \'This hook allows to modify order grid data\',
        \'1\'),
       (NULL, \'actionCatalogPriceRuleGridDataModifier\', \'Modify catalog price rule grid data\',
        \'This hook allows to modify catalog price rule grid data\', \'1\'),
       (NULL, \'actionOrderMessageGridDataModifier\', \'Modify order message grid data\',
        \'This hook allows to modify order message grid data\', \'1\'),
       (NULL, \'actionAttachmentGridDataModifier\', \'Modify attachment grid data\',
        \'This hook allows to modify attachment grid data\', \'1\'),
       (NULL, \'actionAttributeGroupGridDataModifier\', \'Modify attribute group grid data\',
        \'This hook allows to modify attribute group grid data\', \'1\'),
       (NULL, \'actionMerchandiseReturnGridDataModifier\', \'Modify merchandise return grid data\',
        \'This hook allows to modify merchandise return grid data\', \'1\'),
       (NULL, \'actionTaxRulesGroupGridDataModifier\', \'Modify tax rules group grid data\',
        \'This hook allows to modify tax rules group grid data\', \'1\'),
       (NULL, \'actionAddressGridDataModifier\', \'Modify address grid data\',
        \'This hook allows to modify address grid data\', \'1\'),
       (NULL, \'actionCreditSlipGridDataModifier\', \'Modify credit slip grid data\',
        \'This hook allows to modify credit slip grid data\', \'1\'),
       (NULL, \'actionEmptyCategoryGridFilterFormModifier\', \'Modify empty category grid filters\',
        \'This hook allows to modify filters for empty category grid\', \'1\'),
       (NULL, \'actionNoQtyProductWithCombinationGridFilterFormModifier\',
        \'Modify no qty product with combination grid filters\',
        \'This hook allows to modify filters for no qty product with combination grid\', \'1\'),
       (NULL, \'actionNoQtyProductWithoutCombinationGridFilterFormModifier\',
        \'Modify no qty product without combination grid filters\',
        \'This hook allows to modify filters for no qty product without combination grid\', \'1\'),
       (NULL, \'actionDisabledProductGridFilterFormModifier\', \'Modify disabled product grid filters\',
        \'This hook allows to modify filters for disabled product grid\', \'1\'),
       (NULL, \'actionProductWithoutImageGridFilterFormModifier\', \'Modify product without image grid filters\',
        \'This hook allows to modify filters for product without image grid\', \'1\'),
       (NULL, \'actionProductWithoutDescriptionGridFilterFormModifier\',
        \'Modify product without description grid filters\',
        \'This hook allows to modify filters for product without description grid\', \'1\'),
       (NULL, \'actionProductWithoutPriceGridFilterFormModifier\', \'Modify product without price grid filters\',
        \'This hook allows to modify filters for product without price grid\', \'1\'),
       (NULL, \'actionOrderGridFilterFormModifier\', \'Modify order grid filters\',
        \'This hook allows to modify filters for order grid\', \'1\'),
       (NULL, \'actionCatalogPriceRuleGridFilterFormModifier\', \'Modify catalog price rule grid filters\',
        \'This hook allows to modify filters for catalog price rule grid\', \'1\'),
       (NULL, \'actionOrderMessageGridFilterFormModifier\', \'Modify order message grid filters\',
        \'This hook allows to modify filters for order message grid\', \'1\'),
       (NULL, \'actionAttachmentGridFilterFormModifier\', \'Modify attachment grid filters\',
        \'This hook allows to modify filters for attachment grid\', \'1\'),
       (NULL, \'actionAttributeGroupGridFilterFormModifier\', \'Modify attribute group grid filters\',
        \'This hook allows to modify filters for attribute group grid\', \'1\'),
       (NULL, \'actionMerchandiseReturnGridFilterFormModifier\', \'Modify merchandise return grid filters\',
        \'This hook allows to modify filters for merchandise return grid\', \'1\'),
       (NULL, \'actionTaxRulesGroupGridFilterFormModifier\', \'Modify tax rules group grid filters\',
        \'This hook allows to modify filters for tax rules group grid\', \'1\'),
       (NULL, \'actionAddressGridFilterFormModifier\', \'Modify address grid filters\',
        \'This hook allows to modify filters for address grid\', \'1\'),
       (NULL, \'actionCreditSlipGridFilterFormModifier\', \'Modify credit slip grid filters\',
        \'This hook allows to modify filters for credit slip grid\', \'1\'),
       (NULL, \'actionEmptyCategoryGridPresenterModifier\', \'Modify empty category grid template data\',
        \'This hook allows to modify data which is about to be used in template for empty category grid\', \'1\'),
       (NULL, \'actionNoQtyProductWithCombinationGridPresenterModifier\',
        \'Modify no qty product with combination grid template data\',
        \'This hook allows to modify data which is about to be used in template for no qty product with combination grid\',
        \'1\'),
       (NULL, \'actionNoQtyProductWithoutCombinationGridPresenterModifier\',
        \'Modify no qty product without combination grid template data\',
        \'This hook allows to modify data which is about to be used in template for no qty product without combination grid\',
        \'1\'),
       (NULL, \'actionDisabledProductGridPresenterModifier\', \'Modify disabled product grid template data\',
        \'This hook allows to modify data which is about to be used in template for disabled product grid\', \'1\'),
       (NULL, \'actionProductWithoutImageGridPresenterModifier\', \'Modify product without image grid template data\',
        \'This hook allows to modify data which is about to be used in template for product without image grid\', \'1\'),
       (NULL, \'actionProductWithoutDescriptionGridPresenterModifier\',
        \'Modify product without description grid template data\',
        \'This hook allows to modify data which is about to be used in template for product without description grid\',
        \'1\'),
       (NULL, \'actionProductWithoutPriceGridPresenterModifier\', \'Modify product without price grid template data\',
        \'This hook allows to modify data which is about to be used in template for product without price grid\', \'1\'),
       (NULL, \'actionOrderGridPresenterModifier\', \'Modify order grid template data\',
        \'This hook allows to modify data which is about to be used in template for order grid\', \'1\'),
       (NULL, \'actionCatalogPriceRuleGridPresenterModifier\', \'Modify catalog price rule grid template data\',
        \'This hook allows to modify data which is about to be used in template for catalog price rule grid\', \'1\'),
       (NULL, \'actionOrderMessageGridPresenterModifier\', \'Modify order message grid template data\',
        \'This hook allows to modify data which is about to be used in template for order message grid\', \'1\'),
       (NULL, \'actionAttachmentGridPresenterModifier\', \'Modify attachment grid template data\',
        \'This hook allows to modify data which is about to be used in template for attachment grid\', \'1\'),
       (NULL, \'actionAttributeGroupGridPresenterModifier\', \'Modify attribute group grid template data\',
        \'This hook allows to modify data which is about to be used in template for attribute group grid\', \'1\'),
       (NULL, \'actionMerchandiseReturnGridPresenterModifier\', \'Modify merchandise return grid template data\',
        \'This hook allows to modify data which is about to be used in template for merchandise return grid\', \'1\'),
       (NULL, \'actionTaxRulesGroupGridPresenterModifier\', \'Modify tax rules group grid template data\',
        \'This hook allows to modify data which is about to be used in template for tax rules group grid\', \'1\'),
       (NULL, \'actionAddressGridPresenterModifier\', \'Modify address grid template data\',
        \'This hook allows to modify data which is about to be used in template for address grid\', \'1\'),
       (NULL, \'actionCreditSlipGridPresenterModifier\', \'Modify credit slip grid template data\',
        \'This hook allows to modify data which is about to be used in template for credit slip grid\', \'1\'),
       (NULL, \'displayAfterTitleTag\', \'After title tag\', \'Use this hook to add content after title tag\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
        $this->addSql('/* Update wrong hook names */
UPDATE `PREFIX_hook_module` AS hm
INNER JOIN `PREFIX_hook` AS hfrom ON hm.id_hook = hfrom.id_hook AND hfrom.name = \'actionAdministrationPageFormSave\'
INNER JOIN `PREFIX_hook` AS hto ON hto.name = \'actionAdministrationPageSave\'
SET hm.id_hook = hto.id_hook');
        $this->addSql('DELETE FROM `PREFIX_hook` WHERE name = \'actionAdministrationPageFormSave\'');
        $this->addSql('UPDATE `PREFIX_hook_module` AS hm
INNER JOIN `PREFIX_hook` AS hfrom ON hm.id_hook = hfrom.id_hook AND hfrom.name = \'actionMaintenancePageFormSave\'
INNER JOIN `PREFIX_hook` AS hto ON hto.name = \'actionMaintenancePageSave\'
SET hm.id_hook = hto.id_hook');
        $this->addSql('DELETE FROM `PREFIX_hook` WHERE name = \'actionMaintenancePageFormSave\'');
        $this->addSql('UPDATE `PREFIX_hook_module` AS hm
INNER JOIN `PREFIX_hook` AS hfrom ON hm.id_hook = hfrom.id_hook AND hfrom.name = \'actionPerformancePageFormSave\'
INNER JOIN `PREFIX_hook` AS hto ON hto.name = \'actionPerformancePageSave\'
SET hm.id_hook = hto.id_hook');
        $this->addSql('DELETE FROM `PREFIX_hook` WHERE name = \'actionPerformancePageFormSave\'');
        $this->addSql('UPDATE `PREFIX_hook_module` AS hm
INNER JOIN `PREFIX_hook` AS hfrom ON hm.id_hook = hfrom.id_hook AND hfrom.name = \'actionFrontControllerAfterInit\'
INNER JOIN `PREFIX_hook` AS hto ON hto.name = \'actionFrontControllerInitAfter\'
SET hm.id_hook = hto.id_hook');
        $this->addSql('DELETE FROM `PREFIX_hook` WHERE name = \'actionFrontControllerAfterInit\'');
        $this->addSql('/* Update wrong hook alias */
UPDATE `PREFIX_hook_alias` SET name = \'displayHeader\', alias = \'Header\' WHERE name = \'Header\' AND alias = \'displayHeader\'');
    }
}
