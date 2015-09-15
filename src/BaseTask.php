<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service;

use Falc\Robo\Service\Factory\CommandBuilderFactory;
use Falc\Robo\Service\Factory\CommandBuilderFactoryInterface;
use Robo\Common\ExecOneCommand;
use Robo\Task\BaseTask as RoboBaseTask;

/**
 * Base class for all service tasks.
 */
abstract class BaseTask extends RoboBaseTask
{
    use ExecOneCommand;

    /**
     * Service.
     *
     * @var string
     */
    protected $service;

    /**
     * Whether verbose mode is enabled or not.
     *
     * @var boolean
     */
    protected $verbose = false;

    /**
     * CommandBuilder factory.
     *
     * @var CommandBuilderFactoryInterface
     */
    protected $factory;

    /**
     * CommandBuilder.
     *
     * @var \Falc\Robo\Service\CommandBuilder\CommandBuilderInterface
     */
    protected $builder;

    /**
     * Constructor.
     *
     * @param   string                          $serviceManager Service manager to use. Optional.
     * @param   string                          $service        Service. Optional.
     * @param   CommandBuilderFactoryInterface  $factory        CommandBuilder factory. Optional.
     */
    public function __construct($serviceManager = null, $service = null, CommandBuilderFactoryInterface $factory = null)
    {
        $this->factory = $factory ?: new CommandBuilderFactory();

        if ($serviceManager !== null) {
            $this->serviceManager($serviceManager);
        }

        if (!empty($service)) {
            $this->service($service);
        }
    }

    /**
     * Sets the service manager to use.
     *
     * @param   string  $serviceManager Service manager to use.
     * @return  BaseTask
     */
    public function serviceManager($serviceManager)
    {
        $this->builder = $this->factory->create(strtolower($serviceManager));

        return $this;
    }

    /**
     * Sets the service.
     *
     * @param   string  $service    Service.
     * @return  BaseTask
     */
    public function service($service)
    {
        $this->service = trim($service);

        return $this;
    }

    /**
     * Enables the verbose mode.
     *
     * @return BaseTask
     */
    public function verbose()
    {
        $this->verbose = true;

        return $this;
    }
}
