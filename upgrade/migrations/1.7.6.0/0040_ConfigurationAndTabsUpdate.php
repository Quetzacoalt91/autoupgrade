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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_6_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ConfigurationAndTabsUpdate extends AbstractMigration
{
    protected function up(): void
    {
        // Fix Problem with missing lang entries in Configuration
        $this->addSql('INSERT INTO `PREFIX_configuration_lang` (`id_configuration`, `id_lang`, `value`)
SELECT `id_configuration`, l.`id_lang`, `value`
  FROM `PREFIX_configuration` c
  JOIN `PREFIX_lang_shop` l on l.`id_shop` = COALESCE(c.`id_shop`, 1)
  WHERE `name` IN (
      \'PS_DELIVERY_PREFIX\',
      \'PS_INVOICE_PREFIX\',
      \'PS_INVOICE_LEGAL_FREE_TEXT\',
      \'PS_INVOICE_FREE_TEXT\',
      \'PS_RETURN_PREFIX\',
      \'PS_SEARCH_BLACKLIST\',
      \'PS_CUSTOMER_SERVICE_SIGNATURE\',
      \'PS_MAINTENANCE_TEXT\',
      \'PS_LABEL_IN_STOCK_PRODUCTS\',
      \'PS_LABEL_OOS_PRODUCTS_BOA\',
      \'PS_LABEL_OOS_PRODUCTS_BOD\'
      )
  AND NOT EXISTS (SELECT 1 FROM `PREFIX_configuration_lang` WHERE `id_configuration` = c.`id_configuration`)');
        $this->addPhpFunction('ps_1760_update_configuration');
        $this->addPhpFunction('ps_1760_update_tabs');
    }
}
