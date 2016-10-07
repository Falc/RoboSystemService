<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service;

use Falc\Robo\Service\Factory\CommandBuilderFactoryInterface;

/**
 * Loads tasks.
 */
trait loadTasks
{
    /**
     * Allows to start a service.
     *
     * @param   string                         $serviceManager Service manager to use. Optional.
     * @param   string                         $service        Service. Optional.
     * @param   CommandBuilderFactoryInterface $factory        CommandBuilder factory. Optional.
     *
     * @return Start
     */
    protected function taskServiceStart($serviceManager = null, $service = null, CommandBuilderFactoryInterface $factory = null)
    {
        return new Start($serviceManager, $service, $factory);
    }

    /**
     * Allows to stop a service.
     *
     * @param   string                         $serviceManager Service manager to use. Optional.
     * @param   string                         $service        Service. Optional.
     * @param   CommandBuilderFactoryInterface $factory        CommandBuilder factory. Optional.
     *
     * @return Stop
     */
    protected function taskServiceStop($serviceManager = null, $service = null, CommandBuilderFactoryInterface $factory = null)
    {
        return new Stop($serviceManager, $service, $factory);
    }

    /**
     * Allows to restart a service.
     *
     * @param   string                         $serviceManager Service manager to use. Optional.
     * @param   string                         $service        Service. Optional.
     * @param   CommandBuilderFactoryInterface $factory        CommandBuilder factory. Optional.
     *
     * @return Restart
     */
    protected function taskServiceRestart($serviceManager = null, $service = null, CommandBuilderFactoryInterface $factory = null)
    {
        return new Restart($serviceManager, $service, $factory);
    }

    /**
     * Allows to enable a service.
     *
     * @param   string                         $serviceManager Service manager to use. Optional.
     * @param   string                         $service        Service. Optional.
     * @param   CommandBuilderFactoryInterface $factory        CommandBuilder factory. Optional.
     *
     * @return Enable
     */
    protected function taskServiceEnable($serviceManager = null, $service = null, CommandBuilderFactoryInterface $factory = null)
    {
        return new Enable($serviceManager, $service, $factory);
    }

    /**
     * Allows to disable a service.
     *
     * @param   string                         $serviceManager Service manager to use. Optional.
     * @param   string                         $service        Service. Optional.
     * @param   CommandBuilderFactoryInterface $factory        CommandBuilder factory. Optional.
     *
     * @return Disable
     */
    protected function taskServiceDisable($serviceManager = null, $service = null, CommandBuilderFactoryInterface $factory = null)
    {
        return new Disable($serviceManager, $service, $factory);
    }

    /**
     * Allows to reload systemd manager configuration.
     *
     * @param   string                         $serviceManager Service manager to use. Optional.
     * @param   CommandBuilderFactoryInterface $factory        CommandBuilder factory. Optional.
     *
     * @return DaemonReload
     */
    protected function taskServiceDaemonReload($serviceManager = null, CommandBuilderFactoryInterface $factory = null)
    {
        return new DaemonReload($serviceManager, $factory);
    }
}
