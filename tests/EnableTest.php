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
 * Enable tests.
 */
class EnableTest extends BaseTestCase
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

        $task = $this->taskServiceEnable(null, null, $this->factory)
            ->getCommand();
    }

    public function testWithoutService()
    {
        // It must call enable() without service
        $this->builder
            ->expects($this->once())
            ->method('enable')
            ->with($this->equalTo(null));

        $this->taskServiceEnable(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testEnable()
    {
        $service = 'service1';

        // It must call enable()
        $this->builder
            ->expects($this->once())
            ->method('enable')
            ->with($this->equalTo($service));

        $this->taskServiceEnable(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->service($service)
            ->getCommand();
    }

    public function testQuiet()
    {
        // It must call enable()
        $this->builder
            ->expects($this->once())
            ->method('enable');

        // It must call quiet()
        $this->builder
            ->expects($this->once())
            ->method('quiet');

        $this->taskServiceEnable(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testVerbose()
    {
        // It must call enable()
        $this->builder
            ->expects($this->once())
            ->method('enable');

        // It must NOT call quiet()
        $this->builder
            ->expects($this->never())
            ->method('quiet');

        $this->taskServiceEnable(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->verbose()
            ->getCommand();
    }

    public function testOneLiner()
    {
        $service = 'service1';

        // It must call enable()
        $this->builder
            ->expects($this->once())
            ->method('enable')
            ->with($this->equalTo($service));

        $this->taskServiceEnable('myservicemanager', $service, $this->factory)->getCommand();
    }

    public function testRun()
    {
        // Task mock
        $task = $this->getMockBuilder('Falc\Robo\Service\Enable')
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
