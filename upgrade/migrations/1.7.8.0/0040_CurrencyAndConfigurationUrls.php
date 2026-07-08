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

class CurrencyAndConfigurationUrls extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('ALTER TABLE `PREFIX_currency` CHANGE `numeric_iso_code` `numeric_iso_code` varchar(3) NULL DEFAULT NULL');
        $this->addSql('UPDATE `PREFIX_configuration` SET `value` = \'4\' WHERE `name` = \'PS_LOGS_BY_EMAIL\' AND `value` = \'5\'');
        $this->addSql('UPDATE `PREFIX_configuration` SET `value` = \'https://www.prestashop.com\' WHERE `name` = "BLOCKADVERT_LINK" AND `value` = \'http://www.prestashop.com\'');
        $this->addSql('UPDATE `PREFIX_configuration` SET `value` = \'https://www.facebook.com/prestashop\' WHERE `name` = "BLOCKSOCIAL_FACEBOOK" AND `value` = \'http://www.facebook.com/prestashop\'');
        $this->addSql('UPDATE `PREFIX_configuration` SET `value` = \'https://www.prestashop.com/blog/feed/\' WHERE `name` = "BLOCKSOCIAL_RSS" AND `value` = \'http://www.prestashop.com/blog/en/feed/\'');
        $this->addSql('UPDATE `PREFIX_configuration` SET `value` = \'https://www.twitter.com/prestashop\' WHERE `name` = "BLOCKSOCIAL_TWITTER" AND `value` = \'http://www.twitter.com/prestashop\'');
    }
}
