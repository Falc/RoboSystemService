<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 *
 * @author      Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @copyright   2016 Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 *
 * @license     MIT
 */

namespace Falc\Robo\Service\Test\CommandBuilder;

use Falc\Robo\Service\CommandBuilder\SystemdCommandBuilder;
use Falc\Robo\Service\Test\BaseTestCase;

/**
 * SystemdCommandBuilder tests.
 */
class SystemdCommandBuilderTest extends BaseTestCase
{
    /**
     * @var SystemdCommandBuilder
     */
    protected $systemd;

    protected function setUp()
    {
        $this->systemd = new SystemdCommandBuilder();
    }

    public function testStartWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->systemd->start(null);
    }

    public function testStart()
    {
        $this->systemd->start('service1');

        $command = $this->systemd->getCommand();
        $expected = 'systemctl start service1';
        $this->assertEquals($expected, $command);
    }

    public function testStopWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->systemd->stop(null);
    }

    public function testStop()
    {
        $this->systemd->stop('service1');

        $command = $this->systemd->getCommand();
        $expected = 'systemctl stop service1';
        $this->assertEquals($expected, $command);
    }

    public function testRestartWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->systemd->restart(null);
    }

    public function testRestart()
    {
        $this->systemd->restart('service1');

        $command = $this->systemd->getCommand();
        $expected = 'systemctl restart service1';
        $this->assertEquals($expected, $command);
    }

    public function testEnableWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->systemd->enable(null);
    }

    public function testEnable()
    {
        $this->systemd->enable('service1');

        $command = $this->systemd->getCommand();
        $expected = 'systemctl enable service1';
        $this->assertEquals($expected, $command);
    }

    public function testDisableWithoutService()
    {
        $this->setExpectedException('\Exception');
        $this->systemd->disable(null);
    }

    public function testDisable()
    {
        $this->systemd->disable('service1');

        $command = $this->systemd->getCommand();
        $expected = 'systemctl disable service1';
        $this->assertEquals($expected, $command);
    }

    public function testDaemonReload()
    {
        $this->systemd->daemonReload();

        $command = $this->systemd->getCommand();
        $expected = 'systemctl daemon-reload';
        $this->assertEquals($expected, $command);
    }

    public function testQuiet()
    {
        $this->systemd->start('service1')->quiet();

        $command = $this->systemd->getCommand();
        $expected = 'systemctl -q start service1';
        $this->assertEquals($expected, $command);
    }
}
