<?php

namespace Ogogo\ZfcUserPmTest\Entity;

use PHPUnit_Framework_TestCase;
use Ogogo\ZfcUser\Pm\Entity\ConversationReceiver as Entity;
use Ogogo\ZfcUser\Pm\Entity\Conversation;

class ConversationReceiverTest extends PHPUnit_Framework_TestCase
{
    protected $conversationReceiver;

    public function setUp()
    {
        $this->conversationReceiver = new Entity();
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::__construct
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::__construct
     */
    public function testConstructSetIdAndDeletedAndUnread()
    {
        $conversationReceiver = new Entity();
        $this->assertNotNull($conversationReceiver->getId());
        $this->assertFalse($conversationReceiver->getDeleted());
        $this->assertTrue($conversationReceiver->getUnread());
        $this->assertFalse($conversationReceiver->isDeleted());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::setId
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::getId
     */
    public function testSetGetId()
    {
        $this->conversationReceiver->setId(1);
        $this->assertEquals(1, $this->conversationReceiver->getId());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::setDeleted
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::getDeleted
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::isDeleted
     */
    public function testSetGetDeleted()
    {
        $this->conversationReceiver->setDeleted(true);
        $this->assertTrue($this->conversationReceiver->getDeleted());
        $this->assertTrue($this->conversationReceiver->isDeleted());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::setUnread
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::getUnread
     */
    public function testSetGetUnread()
    {
        $this->conversationReceiver->setUnread(false);
        $this->assertFalse($this->conversationReceiver->getUnread());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::setConversation
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::getConversation
     */
    public function testSetGetConversation()
    {
        $conversation = new Conversation();
        $conversation->setId(1);

        $this->conversationReceiver->setConversation($conversation);
        $this->assertInstanceOf('Ogogo\ZfcUser\Pm\Entity\Conversation', $this->conversationReceiver->getConversation());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::setTo
     * @covers Ogogo\ZfcUser\Pm\Entity\ConversationReceiver::getTo
     */
    public function testSetGetTo()
    {
        $this->conversationReceiver->setTo('045a4049-7c37-4053-97eb-7c6e8d1c1d64');
        $this->assertEquals('045a4049-7c37-4053-97eb-7c6e8d1c1d64', $this->conversationReceiver->getTo());
    }
}
