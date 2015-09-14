<?php
/**
 * This file is part of RoboSystemService.
 *
 * @author      Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @copyright   2015 Aitor García Martínez (Falc) <aitor.falc@gmail.com>
 * @license     MIT
 */

namespace Falc\Robo\Service\Factory;

/**
 * CommandBuilderFactory interface.
 */
interface CommandBuilderFactoryInterface
{
    /**
     * Creates a CommandBuilder for the specified $serviceManager.
     *
     * @param   string $serviceManager Service manager.
     * @return  \Falc\Robo\Service\CommandBuilder\CommandBuilderInterface
     */
    public function create($serviceManager);
}
