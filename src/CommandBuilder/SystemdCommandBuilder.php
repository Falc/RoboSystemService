<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service\CommandBuilder;

use Falc\Robo\Service\CommandBuilder\CommandBuilderInterface;

/**
 * Systemd command builder.
 */
class SystemdCommandBuilder implements CommandBuilderInterface
{
    /**
     * Command action.
     *
     * @var string
     */
    protected $action;

    /**
     * Option list.
     *
     * @var string[]
     */
    protected $options = [];

    /**
     * Service.
     *
     * @var string
     */
    protected $service;

    /**
     * {@inheritdoc}
     */
    public function start($service)
    {
        if (empty($service)) {
            throw new \Exception('No service selected to be started');
        }

        $this->service = $service;
        $this->action = 'start';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function stop($service)
    {
        if (empty($service)) {
            throw new \Exception('No service selected to be started');
        }

        $this->service = $service;
        $this->action = 'stop';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function restart($service)
    {
        if (empty($service)) {
            throw new \Exception('No service selected to be started');
        }

        $this->service = $service;
        $this->action = 'restart';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function quiet()
    {
        $this->options[] = '-q';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCommand()
    {
        $options = implode(' ', array_unique($this->options));

        $command = "systemctl {$options} {$this->action} {$this->service}";

        // Remove extra whitespaces
        $command = preg_replace('/\s+/', ' ', trim($command));

        return $command;
    }
}
