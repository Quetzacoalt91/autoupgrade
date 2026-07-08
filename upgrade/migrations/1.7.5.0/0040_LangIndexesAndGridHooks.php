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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_1_7_5_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class LangIndexesAndGridHooks extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_attribute_group_lang`
    ADD KEY `IDX_4653726CBA299860` (`id_lang`)');
        $this->addSql('ALTER TABLE `PREFIX_attribute_lang`
    ADD KEY `IDX_3ABE46A7BA299860` (`id_lang`)');
        $this->addSql('ALTER TABLE `PREFIX_tab_lang`
    ADD KEY `IDX_CFD9262DBA299860` (`id_lang`)');
        $this->addSql('INSERT INTO `PREFIX_hook` (`name`, `title`, `description`, `position`) VALUES
  (\'actionBackupGridDefinitionModifier\', \'Modifying DB Backup grid definition\', \'This hook allows to alter DB Backup grid columns, actions and filters\', 1),
  (\'actionBackupGridFilterFormModifier\', \'Modify filters form for DB Backup grid\', \'This hook allows to alter filters form used in DB Backup\', 1),
  (\'actionBackupGridPresenterModifier\', \'Modify DB Backup grid view data\', \'This hook allows to alter presented DB Backup grid data\', 1),
  (\'actionEmailLogsGridDefinitionModifier\', \'Modifying E-mail grid definition\', \'This hook allows to alter E-mail grid columns, actions and filters\', 1),
  (\'actionEmailLogsGridFilterFormModifier\', \'Modify filters form for E-mail grid\', \'This hook allows to alter filters form used in E-mail\', 1),
  (\'actionEmailLogsGridPresenterModifier\', \'Modify E-mail grid view data\', \'This hook allows to alter presented E-mail grid data\', 1),
  (\'actionEmailLogsGridQueryBuilderModifier\', \'Modify E-mail grid query builder\', \'This hook allows to alter Doctrine query builder for E-mail grid\', 1),
  (\'actionLogsGridDefinitionModifier\', \'Modifying Logs grid definition\', \'This hook allows to alter Logs grid columns, actions and filters\', 1),
  (\'actionLogsGridFilterFormModifier\', \'Modify filters form for Logs grid\', \'This hook allows to alter filters form used in Logs\', 1),
  (\'actionLogsGridPresenterModifier\', \'Modify Logs grid view data\', \'This hook allows to alter presented Logs grid data\', 1),
  (\'actionLogsGridQueryBuilderModifier\', \'Modify Logs grid query builder\', \'This hook allows to alter Doctrine query builder for Logs grid\', 1),
  (\'actionMetaGridDefinitionModifier\', \'Modifying SEO and URLs grid definition\', \'This hook allows to alter SEO and URLs grid columns, actions and filters\', 1),
  (\'actionMetaGridFilterFormModifier\', \'Modify filters form for SEO and URLs grid\', \'This hook allows to alter filters form used in SEO and URLs\', 1),
  (\'actionMetaGridPresenterModifier\', \'Modify SEO and URLs grid view data\', \'This hook allows to alter presented SEO and URLs grid data\', 1),
  (\'actionMetaGridQueryBuilderModifier\', \'Modify SEO and URLs grid query builder\', \'This hook allows to alter Doctrine query builder for SEO and URLs grid\', 1),
  (\'actionSqlRequestGridDefinitionModifier\', \'Modifying SQL Manager grid definition\', \'This hook allows to alter SQL Manager grid columns, actions and filters\', 1),
  (\'actionSqlRequestGridFilterFormModifier\', \'Modify filters form for SQL Manager grid\', \'This hook allows to alter filters form used in SQL Manager\', 1),
  (\'actionSqlRequestGridPresenterModifier\', \'Modify SQL Manager grid view data\', \'This hook allows to alter presented SQL Manager grid data\', 1),
  (\'actionSqlRequestGridQueryBuilderModifier\', \'Modify SQL Manager grid query builder\', \'This hook allows to alter Doctrine query builder for SQL Manager grid\', 1),
  (\'actionWebserviceKeyGridDefinitionModifier\', \'Modifying Webservice grid definition\', \'This hook allows to alter Webservice grid columns, actions and filters\', 1),
  (\'actionWebserviceKeyGridFilterFormModifier\', \'Modify filters form for Webservice grid\', \'This hook allows to alter filters form used in Webservice\', 1),
  (\'actionWebserviceKeyGridPresenterModifier\', \'Modify Webservice grid view data\', \'This hook allows to alter presented Webservice grid data\', 1),
  (\'actionWebserviceKeyGridQueryBuilderModifier\', \'Modify Webservice grid query builder\', \'This hook allows to alter Doctrine query builder for Webservice grid\', 1)
ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`)');
    }
}
