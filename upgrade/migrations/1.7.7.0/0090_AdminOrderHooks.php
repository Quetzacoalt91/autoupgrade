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

class AdminOrderHooks extends AbstractMigration
{
    protected function up(): void
    {
        $this->addPhpFunction('ps_1770_update_order_status_colors');
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`) VALUES
  (NULL, \'displayAdminOrderTop\', \'Admin Order Top\', \'This hook displays content at the top of the order view page\'),
  (NULL, \'displayAdminOrderSide\', \'Admin Order Side Column\', \'This hook displays content in the order view page in the side column under the customer view\'),
  (NULL, \'displayAdminOrderSideBottom\', \'Admin Order Side Column Bottom\', \'This hook displays content in the order view page at the bottom of the side column\'),
  (NULL, \'displayAdminOrderMain\', \'Admin Order Main Column\', \'This hook displays content in the order view page in the main column under the details view\'),
  (NULL, \'displayAdminOrderMainBottom\', \'Admin Order Main Column Bottom\', \'This hook displays content in the order view page at the bottom of the main column\'),
  (NULL, \'displayAdminOrderTabLink\', \'Admin Order Tab Link\', \'This hook displays new tab links on the order view page\'),
  (NULL, \'displayAdminOrderTabContent\', \'Admin Order Tab Content\', \'This hook displays new tab contents on the order view page\'),
  (NULL, \'actionGetAdminOrderButtons\', \'Admin Order Buttons\', \'This hook is used to generate the buttons collection on the order view page (see ActionsBarButtonsCollection)\'),
  (NULL, \'displayFooterCategory\', \'Category footer\', \'This hook adds new blocks under the products listing in a category/search\'),
  (NULL, \'displayBackOfficeOrderActions\', \'Admin Order Actions\', \'This hook displays content in the order view page after action buttons (or aliased to side column in migrated page)\'),
  (NULL, \'actionAdminAdminPreferencesControllerPostProcessBefore\', \'On post-process in Admin Preferences\', \'This hook is called on Admin Preferences post-process before processing the form\'),
  (NULL, \'displayAdditionalCustomerAddressFields\', \'Display additional customer address fields\', \'This hook allows to display extra field values added in an address form using hook \'\'additionalCustomerAddressFields\'\'\'),
  (NULL, \'displayAdminProductsExtra\', \'Admin Product Extra Module Tab\', \'This hook displays extra content in the Module tab on the product edit page\'),
  (NULL, \'actionFrontControllerInitBefore\', \'Perform actions before front office controller initialization\', \'This hook is launched before the initialization of all front office controllers\'),
  (NULL, \'actionFrontControllerInitAfter\', \'Perform actions after front office controller initialization\', \'This hook is launched after the initialization of all front office controllers\'),
  (NULL, \'actionAdminControllerInitAfter\', \'Perform actions after admin controller initialization\', \'This hook is launched after the initialization of all admin controllers\'),
  (NULL, \'actionAdminControllerInitBefore\', \'Perform actions before admin controller initialization\', \'This hook is launched before the initialization of all admin controllers\'),
  (NULL, \'actionControllerInitAfter\', \'Perform actions after controller initialization\', \'This hook is launched after the initialization of all controllers\'),
  (NULL, \'actionControllerInitBefore\', \'Perform actions before controller initialization\', \'This hook is launched before the initialization of all controllers\'),
  (NULL, \'actionAdminLoginControllerBefore\', \'Perform actions before admin login controller initialization\', \'This hook is launched before the initialization of the login controller\'),
  (NULL, \'actionAdminLoginControllerLoginBefore\', \'Perform actions before admin login controller login action initialization\', \'This hook is launched before the initialization of the login action in login controller\'),
  (NULL, \'actionAdminLoginControllerLoginAfter\', \'Perform actions after admin login controller login action initialization\', \'This hook is launched after the initialization of the login action in login controller\'),
  (NULL, \'actionAdminLoginControllerForgotBefore\', \'Perform actions before admin login controller forgot action initialization\', \'This hook is launched before the initialization of the forgot action in login controller\'),
  (NULL, \'actionAdminLoginControllerForgotAfter\', \'Perform actions after admin login controller forgot action initialization\', \'This hook is launched after the initialization of the forgot action in login controller\'),
  (NULL, \'actionAdminLoginControllerResetBefore\', \'Perform actions before admin login controller reset action initialization\', \'This hook is launched before the initialization of the reset action in login controller\'),
  (NULL, \'actionAdminLoginControllerResetAfter\', \'Perform actions after admin login controller reset action initialization\', \'This hook is launched after the initialization of the reset action in login controller\'),
  (NULL, \'displayHeader\', \'Pages html head section\', \'This hook adds additional elements in the head section of your pages (head section of html)\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
        $this->addSql('INSERT IGNORE INTO `PREFIX_hook_alias` (`name`, `alias`) VALUES
  (\'displayAdminOrderTop\', \'displayInvoice\'),
  (\'displayAdminOrderSide\', \'displayBackOfficeOrderActions\'),
  (\'actionFrontControllerInitAfter\', \'actionFrontControllerAfterInit\')');
    }
}
