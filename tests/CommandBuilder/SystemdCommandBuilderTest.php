<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
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

    public function testQuiet()
    {
        $this->systemd->start('service1')->quiet();

        $command = $this->systemd->getCommand();
        $expected = 'systemctl -q start service1';
        $this->assertEquals($expected, $command);
    }
}
