<?php

namespace Ogogo\ZfcUserPmTest\Entity;

use DateTime;
use PHPUnit_Framework_TestCase;
use Ogogo\ZfcUser\Pm\Entity\Conversation as Entity;

class ConversationTest extends PHPUnit_Framework_TestCase
{
    protected $conversation;

    public function setUp()
    {
        $this->conversation = new Entity();
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\Conversation::__construct
     * @covers Ogogo\ZfcUser\Pm\Entity\Conversation::__construct
     */
    public function testConstructSetIdAndDate()
    {
        $conversation = new Entity();
        $this->assertNotNull($conversation->getId());
        $this->assertInstanceOf('DateTime', $conversation->getDate());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\Conversation::setId
     * @covers Ogogo\ZfcUser\Pm\Entity\Conversation::getId
     */
    public function testSetGetId()
    {
        $this->conversation->setId(1);
        $this->assertEquals(1, $this->conversation->getId());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\Conversation::setHeadline
     * @covers Ogogo\ZfcUser\Pm\Entity\Conversation::getHeadline
     */
    public function testSetGetHeadLine()
    {
        $this->conversation->setHeadline('foo');
        $this->assertEquals('foo', $this->conversation->getHeadline());
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Entity\Conversation::setDate
     * @covers Ogogo\ZfcUser\Pm\Entity\Conversation::getDate
     */
    public function testSetGetDate()
    {
        $date = new DateTime();
        $this->conversation->setDate($date);
        $this->assertEquals($date, $this->conversation->getDate());
    }
}
