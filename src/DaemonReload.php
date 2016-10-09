<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @copyright   2016 Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service;

use Falc\Robo\Service\Factory\CommandBuilderFactoryInterface;
use Robo\Contract\CommandInterface;

/**
 * Reload systemd manager configuration
 *
 * ``` php
 * // Enabling a service:
 * $this->taskServiceDaemonReload()
 *     ->serviceManager('systemd')
 *     ->run();
 *
 * // Compact form:
 * $this->taskServiceDaemonReload('systemd')->run();
 * ```
 */
class DaemonReload extends BaseTask implements CommandInterface
{
    /**
     * Constructor.
     *
     * @param   string                          $serviceManager Service manager to use. Optional.
     * @param   CommandBuilderFactoryInterface  $factory        CommandBuilder factory. Optional.
     */
    public function __construct($serviceManager = null, CommandBuilderFactoryInterface $factory = null)
    {
        parent::__construct($serviceManager, null, $factory);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function getCommand()
    {
        if ($this->builder === null) {
            throw new \InvalidArgumentException('Service manager not defined');
        }

        $this->builder->daemonReload();

        if (!$this->verbose) {
            $this->builder->quiet();
        }

        return $this->builder->getCommand();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function run()
    {
        $command = $this->getCommand();

        $this->printTaskInfo('Reload systemd, scanning for new or changed units...');
        return $this->executeCommand($command);
    }
}
