<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2016 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service\CommandBuilder;

/**
 * SysVinit command builder for Red Hat based distros.
 */
class SysVinitRedHatCommandBuilder extends SysVinitCommandBuilder
{
    /**
     * {@inheritdoc}
     */
    public function enable($service)
    {
        if (empty($service)) {
            throw new \InvalidArgumentException('No service selected to be enabled');
        }

        $this->cmd = 'chkconfig';
        $this->service = $service;
        $this->action = 'on';

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

        $this->cmd = 'chkconfig';
        $this->service = $service;
        $this->action = 'off';

        return $this;
    }
}
