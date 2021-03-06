<?php

namespace Ogogo\ZfcUser\Pm\Factory\Mapper\DoctrineORM;

use Doctrine\ORM\EntityManager;
use Ogogo\ZfcUser\Pm\Mapper\DoctrineORM\PmMapper;
use Ogogo\ZfcUser\Pm\Options\ModuleOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\Options\ModuleOptions as ZfcUserModuleOptions;

class PmMapperFactory implements FactoryInterface
{
    /**
     * Create mapper
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return PmMapper
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /**
         * @var ModuleOptions $moduleOptions
         */
        $moduleOptions = $serviceLocator->get('Ogogo\ZfcUser\Pm\Options\ModuleOptions');

        /**
         * @var EntityManager $objectManager
         */
        $objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');

        /**
         * @var ZfcUserModuleOptions $zfcUserOptions
         */
        $zfcUserOptions = $serviceLocator->get('zfcuser_module_options');

        $mapper = new PmMapper($objectManager, $moduleOptions, $zfcUserOptions);

        return $mapper;
    }
}
