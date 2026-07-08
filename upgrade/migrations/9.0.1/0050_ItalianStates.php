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

namespace PrestaShop\Module\AutoUpgrade\Migrations\Versions\Version_9_0_1;

use PrestaShop\Module\AutoUpgrade\Migrations\AbstractMigration;

class ItalianStates extends AbstractMigration
{
    protected function up(): void
    {
        $this->addSql('-- https://github.com/PrestaShop/PrestaShop/pull/39012
UPDATE `PREFIX_state` s
  JOIN `PREFIX_country` c ON s.id_country = c.id_country
  SET s.name = \'Valle d\\\'Aosta\'
WHERE s.iso_code = \'AO\' AND c.iso_code = \'IT\'');
        $this->addSql('UPDATE `PREFIX_state` s
  JOIN `PREFIX_country` c ON s.id_country = c.id_country
  SET s.name = \'Massa-Carrara\' WHERE s.iso_code = \'MS\' AND c.iso_code = \'IT\'');
        $this->addSql('UPDATE `PREFIX_state` s
  JOIN `PREFIX_country` c ON s.id_country = c.id_country
  SET s.name = \'Monza e Brianza\'
WHERE s.iso_code = \'MB\' AND c.iso_code = \'IT\'');
        $this->addSql('UPDATE `PREFIX_state` s
  JOIN `PREFIX_country` c ON s.id_country = c.id_country
  SET s.name = \'Pesaro e Urbino\'
WHERE s.iso_code = \'PU\' AND c.iso_code = \'IT\'');
        $this->addSql('INSERT INTO `PREFIX_state` (id_country, id_zone, iso_code, name, active)
SELECT 
  c.id_country, z.id_zone, \'SU\' AS iso_code, \'Sulcis Iglesiente\' AS name, 1 AS active
FROM `PREFIX_country` c
  JOIN `PREFIX_zone` z ON z.name = \'Europe\'
WHERE c.iso_code = \'IT\'');
    }
}
