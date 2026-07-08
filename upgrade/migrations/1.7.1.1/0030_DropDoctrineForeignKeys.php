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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_1_1;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class DropDoctrineForeignKeys extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_attribute` DROP FOREIGN KEY FK_6C3355F967A664FB');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_lang` DROP FOREIGN KEY FK_4653726C67A664FB');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_shop` DROP FOREIGN KEY FK_DB30BAAC274A50A0');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_shop` DROP FOREIGN KEY FK_DB30BAAC67A664FB');
        $this->addSql('ALTER TABLE `PREFIX_attribute_lang` DROP FOREIGN KEY FK_3ABE46A77A4F53DC');
        $this->addSql('ALTER TABLE `PREFIX_attribute_shop` DROP FOREIGN KEY FK_A7DD8E67274A50A0');
        $this->addSql('ALTER TABLE `PREFIX_attribute_shop` DROP FOREIGN KEY FK_A7DD8E677A4F53DC');
        $this->addSql('ALTER TABLE `PREFIX_lang_shop` DROP FOREIGN KEY FK_2F43BFC7274A50A0');
        $this->addSql('ALTER TABLE `PREFIX_lang_shop` DROP FOREIGN KEY FK_2F43BFC7BA299860');
        $this->addSql('ALTER TABLE `PREFIX_shop` DROP FOREIGN KEY FK_CBDFBB9EF5C9E40');
        $this->addSql('ALTER TABLE `PREFIX_tab_lang` DROP FOREIGN KEY FK_CFD9262DED47AB56');
        $this->addSql('ALTER TABLE `PREFIX_translation` DROP FOREIGN KEY FK_ADEBEB36BA299860');
    }
}
