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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_0_2;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class Hooks extends AbstractMigration
{
    protected function up(): void
    {
        /*
         * @see https://github.com/PrestaShop/PrestaShop/pull/39913
         */
        $this->addSql('INSERT INTO `PREFIX_hook` (`id_hook`, `name`, `title`, `description`, `position`) VALUES
  (NULL, \'actionOverrideQuantityAvailableByProduct\',\'Override available quantity by product\',\'Allows modules to override the available quantity returned by StockAvailable::getQuantityAvailableByProduct().\', \'1\'),
  (NULL, \'actionCheckAttributeQuantity\',\'Check product attribute quantity availability\',\'Allows modules to validate or override the stock availability check for a specific product combination.\', \'1\'),
  (NULL, \'actionOverrideProductQuantity\',\'Override product quantity calculation\',\'Allows modules to override the final product quantity returned by Product::getQuantity(), including cart-aware calculations.\', \'1\')
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
    }
}
