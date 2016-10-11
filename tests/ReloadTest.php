<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @copyright   2016 Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 *
 * @license     MIT
 */

namespace Falc\Robo\Service\Test;

use Robo\Result;

/**
 * Reload tests.
 */
class ReloadTest extends BaseTestCase
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

        $task = $this->taskServiceReload(null, 'service1', $this->factory)
            ->getCommand();
    }

    public function testWithoutService()
    {
        // It must call reload() without service
        $this->builder
            ->expects($this->once())
            ->method('reload')
            ->with($this->equalTo(null));

        $this->taskServiceReload(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testReload()
    {
        $service = 'service1';

        // It must call reload()
        $this->builder
            ->expects($this->once())
            ->method('reload')
            ->with($this->equalTo($service));

        $this->taskServiceReload(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->service($service)
            ->getCommand();
    }

    public function testQuiet()
    {
        // It must call reload()
        $this->builder
            ->expects($this->once())
            ->method('reload');

        // It must call quiet()
        $this->builder
            ->expects($this->once())
            ->method('quiet');

        $this->taskServiceReload(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->getCommand();
    }

    public function testVerbose()
    {
        // It must call reload()
        $this->builder
            ->expects($this->once())
            ->method('reload');

        // It must NOT call quiet()
        $this->builder
            ->expects($this->never())
            ->method('quiet');

        $this->taskServiceReload(null, null, $this->factory)
            ->serviceManager('myservicemanager')
            ->verbose()
            ->getCommand();
    }

    public function testOneLiner()
    {
        $service = 'service1';

        // It must call reload()
        $this->builder
            ->expects($this->once())
            ->method('reload')
            ->with($this->equalTo($service));

        $this->taskServiceReload('myservicemanager', $service, $this->factory)->getCommand();
    }

    public function testRun()
    {
        // Task mock
        $task = $this->getMockBuilder('Falc\Robo\Service\Reload')
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
