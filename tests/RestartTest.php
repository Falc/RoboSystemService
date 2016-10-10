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

namespace Falc\Robo\Service\Test;

use Robo\Result;

/**
 * Restart tests.
 */
class RestartTest extends BaseTestCase
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

        $task = $this->taskServiceRestart(null, 'service1', $this->factory)
            ->getCommand();
    }

    public function testWithoutService()
    {
        // It must call restart() without service
        $this->builder
            ->expects($this->once())
            ->method('restart')
            ->with($this->equalTo(null));

        $this->taskServiceRestart(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testRestart()
    {
        $service = 'service1';

        // It must call restart()
        $this->builder
            ->expects($this->once())
            ->method('restart')
            ->with($this->equalTo($service));

        $this->taskServiceRestart(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->service($service)
            ->getCommand();
    }

    public function testQuiet()
    {
        // It must call restart()
        $this->builder
            ->expects($this->once())
            ->method('restart');

        // It must call quiet()
        $this->builder
            ->expects($this->once())
            ->method('quiet');

        $this->taskServiceRestart(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testVerbose()
    {
        // It must call restart()
        $this->builder
            ->expects($this->once())
            ->method('restart');

        // It must NOT call quiet()
        $this->builder
            ->expects($this->never())
            ->method('quiet');

        $this->taskServiceRestart(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->verbose()
            ->getCommand();
    }

    public function testOneLiner()
    {
        $service = 'service1';

        // It must call restart()
        $this->builder
            ->expects($this->once())
            ->method('restart')
            ->with($this->equalTo($service));

        $this->taskServiceRestart('myservicemanager', $service, $this->factory)->getCommand();
    }

    public function testRun()
    {
        // Task mock
        $task = $this->getMockBuilder('Falc\Robo\Service\Restart')
            ->setConstructorArgs([null, null, $this->factory])
            ->setMethods(['executeCommand'])
            ->getMock();

        // It must call executeCommand()
        $task
            ->expects($this->once())
            ->method('executeCommand')
            ->will($this->returnValue(Result::success($task, 'Success')));

        $task
            ->serviceManager('myservicemanager')
            ->service('service1')
            ->run();
    }
}
