<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @copyright   2016 Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service\Test;

use Falc\Robo\Service\Start;
use Falc\Robo\Service\Test\BaseTestCase;
use Robo\Result;

/**
 * Daemon reload tests.
 */
class DaemonReloadTest extends BaseTestCase
{
    protected $builder;
    protected $factory;

    protected function setUp()
    {
        $this->builder = $this->createCommandBuilderMock();
        $this->factory = $this->createFactoryMock($this->builder);
    }

    public function testWithoutServiceManager()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $task = $this->taskServiceDaemonReload(null, $this->factory)
            ->getCommand();
    }

    public function testDaemonReload()
    {
        // It must call daemonReload()
        $this->builder
            ->expects($this->once())
            ->method('daemonReload');

        $this->taskServiceDaemonReload(null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testQuiet()
    {
        // It must call daemonReload()
        $this->builder
            ->expects($this->once())
            ->method('daemonReload');

        // It must call quiet()
        $this->builder
            ->expects($this->once())
            ->method('quiet');

        $this->taskServiceDaemonReload(null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testVerbose()
    {
        // It must call daemonReload()
        $this->builder
            ->expects($this->once())
            ->method('daemonReload');

        // It must NOT call quiet()
        $this->builder
            ->expects($this->never())
            ->method('quiet');

        $this->taskServiceDaemonReload(null, $this->factory)
            ->serviceManager('myservicemanager')
            ->verbose()
            ->getCommand();
    }

    public function testOneLiner()
    {
        // It must call daemonReload()
        $this->builder
            ->expects($this->once())
            ->method('daemonReload');

        $this->taskServiceDaemonReload('myservicemanager', $this->factory)->getCommand();
    }

    public function testRun()
    {
        // Task mock
        $task = $this->getMockBuilder('Falc\Robo\Service\DaemonReload')
            ->setConstructorArgs([null, $this->factory])
            ->setMethods(['executeCommand'])
            ->getMock();

        // It must call executeCommand()
        $task
            ->expects($this->once())
            ->method('executeCommand')
            ->will($this->returnValue(Result::success($task, 'Success')));

        $task
            ->serviceManager('myservicemanager')
            ->run();
    }
}
