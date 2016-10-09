<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2016 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 *
 * @author      Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 * @copyright   2016 Polyvaniy Oleksii (alexndlm) <alexndlm@gmail.com>
 *
 * @license     MIT
 */

namespace Falc\Robo\Service\CommandBuilder;

/**
 * SysVinit command builder for Debian based distros.
 */
class SysVinitDebianCommandBuilder extends SysVinitCommandBuilder
{
    /**
     * {@inheritdoc}
     */
    public function enable($service)
    {
        if (empty($service)) {
            throw new \InvalidArgumentException('No service selected to be enabled');
        }

        $this->cmd = 'update-rc.d';
        $this->service = $service;
        $this->action = 'defaults';

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function disable($service)
    {
        if (empty($service)) {
            throw new \InvalidArgumentException('No service selected to be disabled');
        }

        $this->cmd = 'update-rc.d';
        $this->service = $service;
        $this->action = 'remove';
        $this->options[] = '-f';

        return $this;
    }
}
