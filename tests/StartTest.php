<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service\Test;

use Falc\Robo\Service\Start;
use Falc\Robo\Service\Test\BaseTestCase;
use Robo\Result;

/**
 * Start tests.
 */
class StartTest extends BaseTestCase
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
        $this->setExpectedException('\Exception');

        $task = $this->taskServiceStart(null, null, $this->factory)
            ->getCommand();
    }

    public function testWithoutService()
    {
        // It must call start() without service
        $this->builder
            ->expects($this->once())
            ->method('start')
            ->with($this->equalTo(null));

        $this->taskServiceStart(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testStart()
    {
        $service = 'service1';

        // It must call start()
        $this->builder
            ->expects($this->once())
            ->method('start')
            ->with($this->equalTo($service));

        $this->taskServiceStart(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->service($service)
            ->getCommand();
    }

    public function testQuiet()
    {
        // It must call start()
        $this->builder
            ->expects($this->once())
            ->method('start');

        // It must call quiet()
        $this->builder
            ->expects($this->once())
            ->method('quiet');

        $this->taskServiceStart(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testVerbose()
    {
        // It must call start()
        $this->builder
            ->expects($this->once())
            ->method('start');

        // It must NOT call quiet()
        $this->builder
            ->expects($this->never())
            ->method('quiet');

        $this->taskServiceStart(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->verbose()
            ->getCommand();
    }

    public function testOneLiner()
    {
        $service = 'service1';

        // It must call start()
        $this->builder
            ->expects($this->once())
            ->method('start')
            ->with($this->equalTo($service));

        $this->taskServiceStart('myservicemanager', $service, $this->factory)->getCommand();
    }

    public function testRun()
    {
        // Task mock
        $task = $this->getMockBuilder('Falc\Robo\Service\Start')
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
