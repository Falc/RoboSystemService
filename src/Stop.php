<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service;

use Falc\Robo\Service\BaseTask;
use Robo\Contract\CommandInterface;

/**
 * Service stop
 *
 * ``` php
 * // Stopping a service:
 * $this->taskServiceStop()
 *     ->serviceManager('systemd')
 *     ->service('httpd')
 *     ->run();
 *
 * // Compact form:
 * $this->taskServiceStop('systemd', 'httpd')->run();
 * ```
 */
class Stop extends BaseTask implements CommandInterface
{
    /**
     * {@inheritdoc}
     */
    public function getCommand()
    {
        if ($this->builder === null) {
            throw new \Exception('Service manager not defined');
        }

        $this->builder->stop($this->service);

        if (!$this->verbose) {
            $this->builder->quiet();
        }

        return $this->builder->getCommand();
    }

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $command = $this->getCommand();

        $this->printTaskInfo('Stopping service...');
        return $this->executeCommand($command);
    }
}
