<?php

namespace Ogogo\Zf2UserPmTest\Factory\Options;

use Ogogo\ZfcUser\Pm\Factory\Options\ModuleOptionsFactory;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleOptionsFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var ModuleOptionsFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $factory = new ModuleOptionsFactory();
        $this->factory = $factory;
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Factory\Options\ModuleOptionsFactory::createService
     */
    public function testCreateServiceWithoutConfig()
    {
        $config = [];

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Config')
                             ->willReturn($config);

        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Ogogo\ZfcUser\Pm\Options\ModuleOptionsInterface', $result);
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Factory\Options\ModuleOptionsFactory::createService
     */
    public function testCreateServiceWithConfig()
    {
        $config = [
            'ogogo' => [
                'zfc-user' => [
                    'pm' => [
                    ],
                ],
            ],
        ];

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Config')
                             ->willReturn($config);

        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Ogogo\ZfcUser\Pm\Options\ModuleOptionsInterface', $result);
    }
}
