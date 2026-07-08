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

class FreeShippingPriceHook extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/* New hooks implemented in https://github.com/PrestaShop/PrestaShop/pull/40730 */
INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'actionOverrideShippingFreePrice\', \'Override price that determines free shipping\', \'Allows modules to override the free shipping price and return their custom value, for example to specify it by zone or other criteria.\', \'1\'),
  (NULL, \'actionOverrideShippingFreeWeight\', \'Override weight that determines free shipping\', \'Allows modules to override the free shipping weight and return their custom value, for example to specify it by zone or other criteria.\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
    }
}
