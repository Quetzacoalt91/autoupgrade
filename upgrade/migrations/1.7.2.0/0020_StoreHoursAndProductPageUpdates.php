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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_2_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class StoreHoursAndProductPageUpdates extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_store` MODIFY `hours` text');
        $this->addPhpFunction('add_configuration_if_not_exists', ['PS_PRODUCT_SHORT_DESC_LIMIT', '800']);
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'displayAdminProductsMainStepLeftColumnMiddle\', \'Display new elements in back office product page, left column of the Basic settings tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayAdminProductsMainStepLeftColumnBottom\', \'Display new elements in back office product page, left column of the Basic settings tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayAdminProductsMainStepRightColumnBottom\', \'Display new elements in back office product page, right column of the Basic settings tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayAdminProductsQuantitiesStepBottom\', \'Display new elements in back office product page, Quantities/Combinations tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayAdminProductsPriceStepBottom\', \'Display new elements in back office product page, Price tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayAdminProductsOptionsStepTop\', \'Display new elements in back office product page, Options tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayAdminProductsOptionsStepBottom\', \'Display new elements in back office product page, Options tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayAdminProductsSeoStepBottom\', \'Display new elements in back office product page, SEO tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayAdminProductsShippingStepBottom\', \'Display new elements in back office product page, Shipping tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayAdminProductsCombinationBottom\', \'Display new elements in back office product page, Combination tab\', \'This hook launches modules when the back office product page is displayed\', \'1\'),
  (NULL, \'displayWrapperTop\', \'Main wrapper section (top)\', \'This hook displays new elements in the top of the main wrapper\', \'1\'),
  (NULL, \'displayWrapperBottom\', \'Main wrapper section (bottom)\', \'This hook displays new elements in the bottom of the main wrapper\', \'1\'),
  (NULL, \'displayContentWrapperTop\', \'Content wrapper section (top)\', \'This hook displays new elements in the top of the content wrapper\', \'1\'),
  (NULL, \'displayContentWrapperBottom\', \'Content wrapper section (bottom)\', \'This hook displays new elements in the bottom of the content wrapper\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
        $this->addPhpFunction('drop_column_if_exists', ['product_lang', 'social_sharing_title']);
        $this->addPhpFunction('drop_column_if_exists', ['product_lang', 'social_sharing_description']);
    }
}
