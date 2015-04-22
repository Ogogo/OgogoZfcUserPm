<?php

namespace Ogogo\ZfcUser\Pm\Factory\Options;

use Ogogo\ZfcUser\Pm\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactory implements FactoryInterface
{
    /**
     * Create options
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return ModuleOptions
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        $moduleConfig = [];
        if (isset($config['ogogo']['zfc-user']['pm'])) {
            $moduleConfig = $config['ogogo']['zfc-user']['pm'];
        }

        $service = new ModuleOptions($moduleConfig);

        return $service;
    }
}
