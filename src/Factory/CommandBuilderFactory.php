<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service\Factory;

use Falc\Robo\Service\CommandBuilder;
use Falc\Robo\Service\Factory\CommandBuilderFactoryInterface;

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
            default:
                throw new \Exception('Not supported');
        }
    }
}
