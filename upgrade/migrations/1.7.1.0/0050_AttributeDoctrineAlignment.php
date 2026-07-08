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

class AttributeDoctrineAlignment extends AbstractMigration
{
    protected function up(): void
    {
        // UPDATE TO DOCTRINE
        $this->addSql('ALTER TABLE `PREFIX_attribute` CHANGE `id_attribute` `id_attribute` INT(11) NOT NULL AUTO_INCREMENT');
        $this->addSql('ALTER TABLE `PREFIX_attribute` CHANGE `id_attribute_group` `id_attribute_group` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute` ADD KEY `attribute_group` (`id_attribute_group`)');
        $this->addSql('ALTER TABLE `PREFIX_attribute` DROP KEY IDX_6C3355F967A664FB');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group` CHANGE `id_attribute_group` `id_attribute_group` INT(11) NOT NULL AUTO_INCREMENT');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_lang` CHANGE `id_attribute_group` `id_attribute_group` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_lang` CHANGE `id_lang` `id_lang` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_lang` DROP FOREIGN KEY FK_4653726CBA299860');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_lang` DROP KEY IDX_4653726CBA299860');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_shop` CHANGE `id_attribute_group` `id_attribute_group` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_shop` CHANGE `id_shop` `id_shop` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_lang` CHANGE `id_attribute` `id_attribute` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_lang` CHANGE `id_lang` `id_lang` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_lang` DROP FOREIGN KEY FK_3ABE46A7BA299860');
        $this->addSql('ALTER TABLE `PREFIX_attribute_lang` DROP KEY IDX_3ABE46A7BA299860');
        $this->addSql('ALTER TABLE `PREFIX_attribute_shop` CHANGE `id_attribute` `id_attribute` INT(11) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attribute_shop` CHANGE `id_shop` `id_shop` INT(11) NOT NULL');
    }
}
