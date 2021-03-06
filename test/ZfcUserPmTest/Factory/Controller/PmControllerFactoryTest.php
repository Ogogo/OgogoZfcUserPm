<?php

namespace Ogogo\Zf2UserPmTest\Factory\Controller;

use Ogogo\ZfcUser\Pm\Factory\Controller\PmControllerFactory;
use Zend\Mvc\Controller\ControllerManager;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceLocatorInterface;

class PmControllerFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var PmControllerFactory */
    protected $factory;

    /** @var ControllerManager */
    protected $controllerManager;

    /** @var ServiceLocatorInterface */
    protected $serviceLocator;

    public function setUp()
    {
        /** @var ControllerManager $controllerManager */
        $controllerManager = $this->getMock('Zend\Mvc\Controller\ControllerManager');
        $this->controllerManager = $controllerManager;

        /** @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $this->serviceLocator = $serviceLocator;

        $controllerManager->expects($this->any())
                          ->method('getServiceLocator')
                          ->willReturn($serviceLocator);

        $factory = new PmControllerFactory();
        $this->factory = $factory;
    }

     /**
     * @covers Ogogo\ZfcUser\Pm\Factory\Controller\PmControllerFactory::createService
     */
    public function testCreateService()
    {
        $pmService = $this->getMockBuilder('Ogogo\ZfcUser\Pm\Service\PmService')
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->serviceLocator->expects($this->at(0))
                             ->method('get')
                             ->with('Ogogo\ZfcUser\Pm\Service\PmService')
                             ->willReturn($pmService);

        $newConversationFormService = $this->getMockBuilder('Ogogo\ZfcUser\Pm\Form\NewConversationForm')
                             ->disableOriginalConstructor()
                             ->getMock();

        $this->serviceLocator->expects($this->at(1))
                             ->method('get')
                             ->with('Ogogo\ZfcUser\Pm\Form\NewConversationForm')
                             ->willReturn($newConversationFormService);

        $newMessageForm = $this->getMockBuilder('Ogogo\ZfcUser\Pm\Form\NewMessageForm')
                            ->disableOriginalConstructor()
                            ->getMock();

        $this->serviceLocator->expects($this->at(2))
                             ->method('get')
                             ->with('Ogogo\ZfcUser\Pm\Form\NewMessageForm')
                             ->willReturn($newMessageForm);

        $deleteConversationForm = $this->getMockBuilder('Ogogo\ZfcUser\Pm\Form\DeleteConversationsForm')
                                ->disableOriginalConstructor()
                                ->getMock();

        $this->serviceLocator->expects($this->at(3))
                             ->method('get')
                             ->with('Ogogo\ZfcUser\Pm\Form\DeleteConversationsForm')
                             ->willReturn($deleteConversationForm);

        $moduleOptions = $this->getMockBuilder('Ogogo\ZfcUser\Pm\Options\ModuleOptions')
                              ->disableOriginalConstructor()
                              ->getMock();

        $this->serviceLocator->expects($this->at(4))
                             ->method('get')
                             ->with('Ogogo\ZfcUser\Pm\Options\ModuleOptions')
                             ->willReturn($moduleOptions);

        $zfcModuleOptions = $this->getMockBuilder('ZfcUser\Options\ModuleOptions')
                              ->disableOriginalConstructor()
                              ->getMock();

        $this->serviceLocator->expects($this->at(5))
                             ->method('get')
                             ->with('zfcuser_module_options')
                             ->willReturn($zfcModuleOptions);

        $eventManager = $this->getMockBuilder('Zend\EventManager\EventManagerInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $this->serviceLocator->expects($this->at(6))
            ->method('get')
            ->with('EventManager')
            ->willReturn($eventManager);

        $result = $this->factory->createService($this->controllerManager);

        $this->assertInstanceOf('Ogogo\ZfcUser\Pm\Controller\PmController', $result);
    }
}
