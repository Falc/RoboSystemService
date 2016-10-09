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

namespace Falc\Robo\Service\Factory;

use Falc\Robo\Service\CommandBuilder;

/**
 * CommandBuilder factory.
 */
class CommandBuilderFactory implements CommandBuilderFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create($serviceManager)
    {
        switch ($serviceManager) {
            case 'systemd':
                return new CommandBuilder\SystemdCommandBuilder();
            case 'sysvinit-debian':
                return new CommandBuilder\SysVinitDebianCommandBuilder();
            case 'sysvinit-redhat':
                return new CommandBuilder\SysVinitRedHatCommandBuilder();
            default:
                throw new \InvalidArgumentException('Not supported');
        }
    }
}
