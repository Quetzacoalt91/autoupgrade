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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_0_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class AttachmentsAndCustomerMessages extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('/* Upgrade attachment names length */
/* https://github.com/PrestaShop/PrestaShop/pull/37598 */
ALTER TABLE `PREFIX_attachment` MODIFY COLUMN `file_name` varchar(255) NOT NULL');
        $this->addSql('ALTER TABLE `PREFIX_attachment_lang` MODIFY COLUMN `name` varchar(255) DEFAULT NULL');
        $this->addPhpFunction('ps_900_migrate_category_images');
        $this->addPhpFunction('add_column', ['customer_message', 'id_product', 'INT UNSIGNED DEFAULT NULL AFTER `id_employee`']);
        $this->addSql('ALTER TABLE `PREFIX_customer_message` ADD INDEX `id_product` (`id_product`)');
    }
}
