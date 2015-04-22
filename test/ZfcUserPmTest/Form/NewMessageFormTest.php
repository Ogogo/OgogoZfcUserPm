<?php

namespace Ogogo\ZfcUserPmTest\Form;

use PHPUnit_Framework_TestCase;
use Ogogo\ZfcUser\Pm\Form\NewMessageForm as Form;

class NewMessageFormTest extends PHPUnit_Framework_TestCase
{
    protected $messageForm;

    public function setUp()
    {
        $this->messageForm = new Form();
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Form\NewMessageForm::__construct
     * @covers Ogogo\ZfcUser\Pm\Form\NewMessageForm::__construct
     */
    public function testHasElement()
    {
        $this->assertTrue($this->messageForm->has('message'));
        $this->assertTrue($this->messageForm->has('csrf'));
        $this->assertTrue($this->messageForm->has('submit'));
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Form\NewMessageForm::getInputFilterSpecification
     */
    public function testHasInputFilter()
    {
        $this->assertTrue($this->messageForm->getInputFilter()->has('message'));
    }
}
