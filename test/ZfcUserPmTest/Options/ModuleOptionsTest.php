<?php

namespace Ogogo\ZfcUserPmTest\Form;

use Ogogo\ZfcUser\Pm\Options\ModuleOptions;
use PHPUnit_Framework_TestCase;

class ModuleOptionsTest extends PHPUnit_Framework_TestCase
{
    /** @var \Ogogo\ZfcUser\Pm\Options\ModuleOptions */
    protected $options;

    public function setUp()
    {
        $options = new ModuleOptions([]);
        $this->options = $options;
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::setConversationsPerPage
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::getConversationsPerPage
     */
    public function testSetGetConversationsPerPage()
    {
        $this->options->setConversationsPerPage(1);
        $this->assertEquals(1, $this->options->getConversationsPerPage());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::setMessageSortOrder
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::getMessageSortOrder
     */
    public function testSetGetMessageSortOrder()
    {
        $this->options->setMessageSortOrder('ASC');
        $this->assertEquals('ASC', $this->options->getMessageSortOrder());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::setMessagesPerPage
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::getMessagesPerPage
     */
    public function testSetGetMessagesPerPage()
    {
        $this->options->setMessagesPerPage(10);
        $this->assertEquals(10, $this->options->getMessagesPerPage());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::setConversationEntity
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::getConversationEntity
     */
    public function testSetGetConversationEntity()
    {
        $this->options->setConversationEntity('Ogogo\ZfcUser\Pm\Entity\Conversation');
        $this->assertEquals('Ogogo\ZfcUser\Pm\Entity\Conversation', $this->options->getConversationEntity());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::setConversationReceiverEntity
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::getConversationReceiverEntity
     */
    public function testSetGetConversationReceiverEntity()
    {
        $this->options->setConversationReceiverEntity('Ogogo\ZfcUser\Pm\Entity\ConversationReceiver');
        $this->assertEquals('Ogogo\ZfcUser\Pm\Entity\ConversationReceiver', $this->options->getConversationReceiverEntity());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::setMessageEntity
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::getMessageEntity
     */
    public function testSetGetMessageEntity()
    {
        $this->options->setMessageEntity('Ogogo\ZfcUser\Pm\Entity\Message');
        $this->assertEquals('Ogogo\ZfcUser\Pm\Entity\Message', $this->options->getMessageEntity());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::setPmMapper
     * @covers Ogogo\ZfcUser\Pm\Options\ModuleOptions::getPmMapper
     */
    public function testSetGetPmMapper()
    {
        $this->options->setPmMapper('Ogogo\ZfcUser\Pm\Mapper\DoctrineORM\PmMapper');
        $this->assertEquals('Ogogo\ZfcUser\Pm\Mapper\DoctrineORM\PmMapper', $this->options->getPmMapper());
    }
}
