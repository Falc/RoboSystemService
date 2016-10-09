<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2016 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 *
 * @author      Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @copyright   2016 Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 *
 * @license     MIT
 */

namespace Falc\Robo\Service\Test\CommandBuilder;

use Falc\Robo\Service\CommandBuilder\SysVinitCommandBuilder;
use Falc\Robo\Service\CommandBuilder\SysVinitRedHatCommandBuilder;
use Falc\Robo\Service\Test\BaseTestCase;

/**
 * SysVinitRedHatCommandBuilder tests.
 */
class SysVinitRedHatCommandBuilderTest extends BaseTestCase
{
    /**
     * @var SysVinitCommandBuilder
     */
    protected $sysvinit;

    protected function setUp()
    {
        $this->sysvinit = new SysVinitRedHatCommandBuilder();
    }

    public function testStartWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->sysvinit->start(null);
    }

    public function testStart()
    {
        $this->sysvinit->start('service1');

        $command = $this->sysvinit->getCommand();
        $expected = '/etc/init.d/service1 start';
        $this->assertEquals($expected, $command);
    }

    public function testStopWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->sysvinit->stop(null);
    }

    public function testStop()
    {
        $this->sysvinit->stop('service1');

        $command = $this->sysvinit->getCommand();
        $expected = '/etc/init.d/service1 stop';
        $this->assertEquals($expected, $command);
    }

    public function testRestartWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->sysvinit->restart(null);
    }

    public function testRestart()
    {
        $this->sysvinit->restart('service1');

        $command = $this->sysvinit->getCommand();
        $expected = '/etc/init.d/service1 restart';
        $this->assertEquals($expected, $command);
    }

    public function testEnableWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->sysvinit->enable(null);
    }

    public function testEnable()
    {
        $this->sysvinit->enable('service1');

        $command = $this->sysvinit->getCommand();
        $expected = 'chkconfig service1 on';
        $this->assertEquals($expected, $command);
    }

    public function testDisableWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->sysvinit->disable(null);
    }

    public function testDisable()
    {
        $this->sysvinit->disable('service1');

        $command = $this->sysvinit->getCommand();
        $expected = 'chkconfig service1 off';
        $this->assertEquals($expected, $command);
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Action "daemon-reload" not supported for SysVinit
     */
    public function testDaemonReload()
    {
        $this->sysvinit->daemonReload();
    }

    public function testQuiet()
    {
        $this->sysvinit->start('service1')->quiet();

        $command = $this->sysvinit->getCommand();
        $expected = '/etc/init.d/service1 start > /dev/null';
        $this->assertEquals($expected, $command);
    }
}
