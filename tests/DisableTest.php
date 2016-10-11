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
 * Disable tests.
 */
class DisableTest extends BaseTestCase
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

        $task = $this->taskServiceDisable(null, null, $this->factory)
            ->getCommand();
    }

    public function testWithoutService()
    {
        // It must call disable() without service
        $this->builder
            ->expects($this->once())
            ->method('disable')
            ->with($this->equalTo(null));

        $this->taskServiceDisable(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testDisable()
    {
        $service = 'service1';

        // It must call disable()
        $this->builder
            ->expects($this->once())
            ->method('disable')
            ->with($this->equalTo($service));

        $this->taskServiceDisable(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->service($service)
            ->getCommand();
    }

    public function testQuiet()
    {
        // It must call disable()
        $this->builder
            ->expects($this->once())
            ->method('disable');

        // It must call quiet()
        $this->builder
            ->expects($this->once())
            ->method('quiet');

        $this->taskServiceDisable(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testVerbose()
    {
        // It must call disable()
        $this->builder
            ->expects($this->once())
            ->method('disable');

        // It must NOT call quiet()
        $this->builder
            ->expects($this->never())
            ->method('quiet');

        $this->taskServiceDisable(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->verbose()
            ->getCommand();
    }

    public function testOneLiner()
    {
        $service = 'service1';

        // It must call disable()
        $this->builder
            ->expects($this->once())
            ->method('disable')
            ->with($this->equalTo($service));

        $this->taskServiceDisable('myservicemanager', $service, $this->factory)->getCommand();
    }

    public function testRun()
    {
        // Task mock
        $task = $this->getMockBuilder('Falc\Robo\Service\Disable')
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
