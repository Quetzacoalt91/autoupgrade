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

class ApiClientAndMutationTables extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('DROP TABLE IF EXISTS `PREFIX_api_access`');
        $this->addSql('DROP TABLE IF EXISTS `PREFIX_authorized_application`');
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_api_client`
(
     `id_api_client` int(10) unsigned NOT NULL AUTO_INCREMENT,
     `client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
     `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
     `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
     `enabled` tinyint(1) NOT NULL,
     `scopes` json NOT NULL,
     `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT \'\',
     `external_issuer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
     `lifetime` int(11) NOT NULL DEFAULT \'3600\',
     PRIMARY KEY (`id_api_client`),
     UNIQUE KEY `api_client_client_id_idx` (`client_id`,`external_issuer`),
     UNIQUE KEY `api_client_client_name_idx` (`client_name`,`external_issuer`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE `PREFIX_image_type`
    CHANGE `id_image_type` `id_image_type` int(10) unsigned NOT NULL AUTO_INCREMENT,
    CHANGE `width` `width` int(10) unsigned NOT NULL,
    CHANGE `height` `height` int(10) unsigned NOT NULL,
    CHANGE `products` `products`  tinyint(1) NOT NULL DEFAULT \'1\',
    CHANGE `manufacturers` `manufacturers`  tinyint(1) NOT NULL DEFAULT \'1\',
    CHANGE `stores` `stores` tinyint(1) NOT NULL DEFAULT \'1\',
    DROP key `image_type_name`,
    ADD UNIQUE KEY `UNIQ_907C95215E237E06` (`name`)');
        $this->addSql('CREATE TABLE IF NOT EXISTS `PREFIX_mutation` (
   `id_mutation` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `mutation_table` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `mutation_row_id` bigint(20) NOT NULL,
   `mutation_action` enum(\'create\',\'update\',\'delete\') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `mutator_type` enum(\'employee\',\'api_client\',\'module\') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `mutator_identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `mutation_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `date_add` datetime NOT NULL,
   PRIMARY KEY (`id_mutation`)
) ENGINE=ENGINE_TYPE DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
    }
}
