<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service\Test\Factory;

use Falc\Robo\Service\Factory\CommandBuilderFactory;
use Falc\Robo\Service\Test\BaseTestCase;

/**
 * CommandBuilderFactory tests.
 */
class CommandBuilderFactoryTest extends BaseTestCase
{
    protected $factory;

    protected function setUp()
    {
        $this->factory = new CommandBuilderFactory();
    }

    public function testCreateUnsupportedBuilder()
    {
        $this->setExpectedException('\Exception');
        $builder = $this->factory->create('myservicemanager');
    }

    public function testCreateSystemdCommandBuilder()
    {
        $builder = $this->factory->create('systemd');

        $this->assertInstanceOf('Falc\Robo\Service\CommandBuilder\CommandBuilderInterface', $builder);
    }

    public function testCreateSysVinitDebianCommandBuilder()
    {
        $builder = $this->factory->create('sysvinit-debian');

        $this->assertInstanceOf('Falc\Robo\Service\CommandBuilder\CommandBuilderInterface', $builder);
    }

    public function testCreateSysVinitRedHatCommandBuilder()
    {
        $builder = $this->factory->create('sysvinit-redhat');

        $this->assertInstanceOf('Falc\Robo\Service\CommandBuilder\CommandBuilderInterface', $builder);
    }
}
