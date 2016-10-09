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

namespace Falc\Robo\Service;

use Robo\Contract\CommandInterface;

/**
 * Service start
 *
 * ``` php
 * // Starting a service:
 * $this->taskServiceStart()
 *     ->serviceManager('systemd')
 *     ->service('httpd')
 *     ->run();
 *
 * // Compact form:
 * $this->taskServiceStart('systemd', 'httpd')->run();
 * ```
 */
class Start extends BaseTask implements CommandInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function getCommand()
    {
        if ($this->builder === null) {
            throw new \InvalidArgumentException('Service manager not defined');
        }

        $this->builder->start($this->service);

        if (!$this->verbose) {
            $this->builder->quiet();
        }

        return $this->builder->getCommand();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function run()
    {
        $command = $this->getCommand();

        $this->printTaskInfo('Starting service...');
        return $this->executeCommand($command);
    }
}
