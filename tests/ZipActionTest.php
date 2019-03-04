<?php
/*
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2018 PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

use PHPUnit\Framework\TestCase;
use PrestaShop\Module\AutoUpgrade\UpgradeContainer;
use PrestaShop\Module\AutoUpgrade\ZipAction;

/**
 * Class extending ZipAction in order to force
 * PclZip in some tests.
 */
class ZipActionForPclZip extends ZipAction
{
    const FORCE_PCLZIP = true;
}

class ZipActionTest extends TestCase
{
    const ZIP_PATH = __DIR__ . '/fixtures/ArchiveExample.zip';

    private $contentExcepted;

    protected function setUp()
    {
        require_once __DIR__ . '/../classes/pclzip.lib.php';

        $this->contentExcepted = [
            'dummyFolder/',
            'dummyFolder/AppKernelExample.php.txt',
        ];
    }

    public function testArchiveWithZipArchive()
    {
        if (!class_exists('\ZipArchive')) {
            $this->markTestSkipped('This test requires the extension zip to be installed');
            return;
        }

        $zipAction = (new UpgradeContainer(__DIR__, __DIR__ . '/..'))->getZipAction();
        $this->assertSame($this->contentExcepted, $zipAction->listContent(self::ZIP_PATH));
    }

    public function testArchiveWithPclZip()
    {
        $container = new UpgradeContainer(__DIR__, __DIR__ . '/..');
        $zipAction = new ZipActionForPclZip(
            $container->getTranslator(),
            $container->getLogger(),
            $container->getUpgradeConfiguration(),
            $container->getProperty(UpgradeContainer::PS_ROOT_PATH)
        );
        $this->assertSame(true, $zipAction::FORCE_PCLZIP);
        $this->assertSame($this->contentExcepted, $zipAction->listContent(self::ZIP_PATH));
    }
}
