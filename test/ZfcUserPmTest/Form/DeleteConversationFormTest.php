<?php

namespace Ogogo\ZfcUserPmTest\Form;

use PHPUnit_Framework_TestCase;
use Ogogo\ZfcUser\Pm\Form\DeleteConversationsForm as Form;

class DeleteConversationFormTest extends PHPUnit_Framework_TestCase
{
    protected $deleteConversationForm;

    public function setUp()
    {
        $this->deleteConversationForm = new Form();
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Form\DeleteConversationsForm::__construct
     */
    public function testHasElement()
    {
        $this->assertTrue($this->deleteConversationForm->has('collectionIds[]'));
        $this->assertTrue($this->deleteConversationForm->has('csrf'));
        $this->assertTrue($this->deleteConversationForm->has('submit'));
    }

    /**
     * @covers Ogogo\ZfcUser\Pm\Form\DeleteConversationsForm::getInputFilterSpecification
     */
    public function testHasInputFilter()
    {
        $this->assertTrue($this->deleteConversationForm->getInputFilter()->has('collectionIds[]'));
    }
}
