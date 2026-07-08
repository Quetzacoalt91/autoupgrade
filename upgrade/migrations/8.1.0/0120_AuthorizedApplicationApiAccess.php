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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_8_1_0;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class AuthorizedApplicationApiAccess extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_authorized_application`
(
    id_authorized_application INT UNSIGNED AUTO_INCREMENT NOT NULL,
    name                      VARCHAR(255) NOT NULL,
    description               LONGTEXT     NOT NULL,
    UNIQUE INDEX UNIQ_475B9BA55E237E06 (name),
    PRIMARY KEY (id_authorized_application)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_api_access`
(
    id_api_access             INT UNSIGNED AUTO_INCREMENT NOT NULL,
    id_authorized_application INT UNSIGNED NOT NULL,
    client_id                 VARCHAR(255) NOT NULL,
    client_secret             VARCHAR(255) NOT NULL,
    active                    TINYINT(1) NOT NULL,
    scopes                    LONGTEXT     NOT NULL COMMENT \'(DC2Type:array)\',
    INDEX                     IDX_6E064442D8BFF738 (id_authorized_application),
    PRIMARY KEY (id_api_access)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('INSERT IGNORE INTO `PREFIX_authorization_role` (`slug`) VALUES
  (\'ROLE_MOD_TAB_ADMINAUTHORIZATIONSERVER_CREATE\'),
  (\'ROLE_MOD_TAB_ADMINAUTHORIZATIONSERVER_DELETE\'),
  (\'ROLE_MOD_TAB_ADMINAUTHORIZATIONSERVER_READ\'),
  (\'ROLE_MOD_TAB_ADMINAUTHORIZATIONSERVER_UPDATE\')');
    }
}
