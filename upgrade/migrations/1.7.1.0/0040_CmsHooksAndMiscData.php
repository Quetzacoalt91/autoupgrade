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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_1_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class CmsHooksAndMiscData extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'filterCmsContent\', \'Filter the content page\', \'This hook is called just before fetching content page\', \'1\'),
  (NULL, \'filterCmsCategoryContent\', \'Filter the content page category\', \'This hook is called just before fetching content page category\', \'1\'),
  (NULL, \'filterProductContent\', \'Filter the content page product\', \'This hook is called just before fetching content page product\', \'1\'),
  (NULL, \'filterCategoryContent\', \'Filter the content page category\', \'This hook is called just before fetching content page category\', \'1\'),
  (NULL, \'filterManufacturerContent\', \'Filter the content page manufacturer\', \'This hook is called just before fetching content page manufacturer\', \'1\'),
  (NULL, \'filterSupplierContent\', \'Filter the content page supplier\', \'This hook is called just before fetching content page supplier\', \'1\'),
  (NULL, \'filterHtmlContent\', \'Filter HTML field before rending a page\', \'This hook is called just before fetching a page on HTML field\', \'1\'),
  (NULL, \'displayDashboardTop\', \'Dashboard Top\', \'Displays the content in the dashboard\'\'s top area\', \'1\'),
  (NULL, \'actionObjectProductInCartDeleteBefore\', \'Cart product removal\', \'This hook is called before a product is removed from a cart\', \'1\'),
  (NULL, \'actionObjectProductInCartDeleteAfter\', \'Cart product removal\', \'This hook is called after a product is removed from a cart\', \'1\'),
  (NULL, \'actionUpdateLangAfter\', \'Update "lang" tables\', \'Update "lang" tables after adding or updating a language\', \'1\'),
  (NULL, \'actionOutputHTMLBefore\', \'Filter the whole HTML page\', \'This hook is used to filter the whole HTML page before it is rendered (only front)\', \'1\'),
  (NULL, \'displayAfterProductThumbs\', \'Display extra content below product thumbs\', \'This hook displays new elements below product images ex. additional media\', \'1\'),
  (NULL, \'actionDispatcherBefore\', \'Before dispatch\', \'This hook is called at the beginning of the dispatch method of the Dispatcher\', \'1\'),
  (NULL, \'actionDispatcherAfter\', \'After dispatch\', \'This hook is called at the end of the dispatch method of the Dispatcher\', \'1\'),
  (NULL, \'actionClearCache\', \'Clear smarty cache\', \'This hook is called when the cache of the theme is cleared\', \'1\'),
  (NULL, \'actionClearCompileCache\', \'Clear smarty compile cache\', \'This hook is called when smarty\'\'s compile cache is cleared\', \'1\'),
  (NULL, \'actionClearSf2Cache\', \'Clear Sf2 cache\', \'This hook is called when the Symfony cache is cleared\', \'1\'),
  (NULL, \'filterProductSearch\', \'Filter search products result\', \'This hook is called in order to allow to modify search product result\', \'1\'),
  (NULL, \'actionProductSearchAfter\', \'Event triggered after search product completed\', \'This hook is called after the product search. Parameters are already filtered\', \'1\'),
  (NULL, \'actionEmailSendBefore\', \'Before sending an email\', \'This hook is used to filter the content or the metadata of an email before sending it or even prevent its sending\', \'1\'),
  (NULL, \'displayProductPageDrawer\', \'Product Page Drawer\', \'This hook displays content in the right sidebar of the product page\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
        $this->addSql('DELETE FROM `PREFIX_configuration` WHERE `name` IN (\'PS_META_KEYWORDS\')');
        $this->addSql('INSERT INTO `PREFIX_operating_system` (`name`) VALUES (\'Windows 8.1\'), (\'Windows 10\')');
    }
}
