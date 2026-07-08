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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_8_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ProductLocationAndRedirectType extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('UPDATE `PREFIX_product` SET `location` = \'\' WHERE `location` IS NULL');
        $this->addSql('ALTER TABLE `PREFIX_product` MODIFY COLUMN `location` VARCHAR(255) NOT NULL DEFAULT \'\'');
        $this->addSql('UPDATE `PREFIX_product_attribute` SET `location` = \'\' WHERE `location` IS NULL');
        $this->addSql('ALTER TABLE `PREFIX_product_attribute` MODIFY COLUMN `location` VARCHAR(255) NOT NULL DEFAULT \'\'');
        $this->addSql('UPDATE `PREFIX_product` SET `redirect_type` = \'404\' WHERE `redirect_type` = \'\'');
        $this->addSql('ALTER TABLE `PREFIX_product` MODIFY COLUMN `redirect_type` ENUM(
    \'404\', \'301-product\', \'302-product\', \'301-category\', \'302-category\'
) NOT NULL DEFAULT \'404\'');
    }
}
