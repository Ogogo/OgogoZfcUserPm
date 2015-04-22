<?php

namespace Ogogo\Zf2UserPmTest\Factory\Service;

use Ogogo\ZfcUser\Pm\Factory\Service\PmServiceFactory;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class PmServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var PmServiceFactory */
    protected $factory;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $factory = new PmServiceFactory();
        $this->factory = $factory;
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Factory\Service\PmServiceFactory::createService
     */
    public function testCreateService()
    {
        $options = $this->getMock('Ogogo\ZfcUser\Pm\Options\ModuleOptions');

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Ogogo\ZfcUser\Pm\Options\ModuleOptions')
                             ->willReturn($options);

        $options->expects($this->once())
                ->method('getPmMapper')
                ->will($this->returnValue('Ogogo\ZfcUser\Pm\Mapper\DoctrineORM\PmMapper'));

        $pmMapperMock = $this->getMockBuilder('Ogogo\ZfcUser\Pm\Mapper\DoctrineORM\PmMapper')
                ->disableOriginalConstructor()
                ->getMock();

        $this->serviceLocator->expects($this->at(1))
                             ->method('get')
                             ->with('Ogogo\ZfcUser\Pm\Mapper\DoctrineORM\PmMapper')
                             ->willReturn($pmMapperMock);

        $result = $this->factory->createService($this->serviceLocator);

        $this->assertInstanceOf('Ogogo\ZfcUser\Pm\Service\PmService', $result);
    }
}
