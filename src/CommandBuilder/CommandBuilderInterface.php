<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service\CommandBuilder;

/**
 * CommandBuilder interface.
 */
interface CommandBuilderInterface
{
    /**
     * Sets the action to "start" and specifies the service.
     *
     * @param   string                  $service    Service to start.
     * @return  CommandBuilderInterface
     */
    public function start($service);

    /**
     * Sets the action to "stop" and specifies the service.
     *
     * @param   string                  $service    Service to stop.
     * @return  CommandBuilderInterface
     */
    public function stop($service);

    /**
     * Sets the action to "restart" and specifies the service.
     *
     * @param   string                  $service    Service to restart.
     * @return  CommandBuilderInterface
     */
    public function restart($service);

    /**
     * Sets the action to "enable" and specifies the service.
     *
     * @param   string                  $service    Service to enable.
     * @return  CommandBuilderInterface
     */
    public function enable($service);

    /**
     * Sets the action to "disable" and specifies the service.
     *
     * @param   string                  $service    Service to disable.
     * @return  CommandBuilderInterface
     */
    public function disable($service);

    /**
     * Sets the option "quiet".
     *
     * The service manager will not display output.
     *
     * @return CommandBuilderInterface
     */
    public function quiet();

    /**
     * Gets the resulting command.
     *
     * @return string
     */
    public function getCommand();
}
