<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Ogogo\ZfcUser\Pm\Controller;

use Ogogo\ZfcUser\Pm\Form\DeleteConversationsForm;
use Ogogo\ZfcUser\Pm\Form\NewConversationForm;
use Ogogo\ZfcUser\Pm\Form\NewMessageForm;
use Ogogo\ZfcUser\Pm\Options\ModuleOptionsInterface;
use Ogogo\ZfcUser\Pm\Service\PmServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\Stdlib\ArrayObject;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use ZfcUser\Options\ModuleOptions as ZfcUserModuleOptions;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\View\Model\JsonModel;

use ZfcUser\View\Helper\ZfcUserDisplayName;

class PmController extends AbstractActionController
{

    /**
     * @var PmServiceInterface
     */
    protected $pmService;

    /**
     * @var NewConversationForm
     */
    protected $newConversationForm;

    /**
     * @var NewMessageForm
     */
    protected $newMessageForm;

    /**
     * @var DeleteConversationsForm
     */
    protected $deleteConversationsForm;

    /**
     * @var ModuleOptionsInterface
     */
    protected $options;

    /**
     * @var ZfcUserModuleOptions
     */
    protected $zfcUserOptions;

    /**
     * @param PmServiceInterface      $pmService
     * @param NewConversationForm     $newConversationForm
     * @param NewMessageForm          $newMessageForm
     * @param DeleteConversationsForm $deleteConversationsForm
     * @param ModuleOptionsInterface  $options
     * @param ZfcUserModuleOptions    $zfcUserOptions
     */
    public function __construct(
        PmServiceInterface $pmService,
        NewConversationForm $newConversationForm,
        NewMessageForm $newMessageForm,
        DeleteConversationsForm $deleteConversationsForm,
        ModuleOptionsInterface $options,
        ZfcUserModuleOptions $zfcUserOptions
    ) {
        $this->pmService = $pmService;
        $this->newConversationForm = $newConversationForm;
        $this->newMessageForm = $newMessageForm;
        $this->deleteConversationsForm = $deleteConversationsForm;
        $this->options = $options;
        $this->zfcUserOptions = $zfcUserOptions;
    }

    public function indexAction()
    {
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute($this->zfcUserOptions->getLoginRedirectRoute());
        }

        $user = $this->ZfcUserAuthentication()->getIdentity();
        $form = $this->deleteConversationsForm;
        $conversations = $this->pmService->getUserConversations($user->getId());

        // Paginator
        $paginator = new Paginator(new ArrayAdapter($conversations));
        $page = $this->params('page', 1);
        $paginator->setDefaultItemCountPerPage($this->options->getConversationsPerPage());
        $paginator->setCurrentPageNumber($page);

        $viewModel = new ViewModel(
            [
            'conversations' => $paginator,
            'form' => $form,
            ]
        );
        $viewModel->setTemplate('ogogo/zfc-user/pm/index.phtml');

        $redirectUrl = $this->url()->fromRoute('ogogo/zfc-user/pm/list', ['page' => $page]);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return $viewModel;
        }

        $form->setData($prg);
        if (!$form->isValid()) {
            return $viewModel;
        }

        $this->pmService->deleteConversations($prg['collectionIds'], $user);

        return $this->redirect()->toRoute('ogogo/zfc-user/pm/list');
    }

    public function readConversationAction()
    {
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute($this->zfcUserOptions->getLoginRedirectRoute());
        }

        $form = $this->newMessageForm;
        $conversation = $this->pmService->getConversation($this->params('conversationId'));
        $messages = $this->pmService->getMessages($conversation);
        $user = $this->ZfcUserAuthentication()->getIdentity();

        // Paginator
        $paginator = new Paginator(new ArrayAdapter($messages));
        $page = $this->params('page', 1);
        $paginator->setDefaultItemCountPerPage($this->options->getMessagesPerPage());
        $paginator->setCurrentPageNumber($page);

        $this->pmService->markRead($conversation, $user);

        $viewModel = new ViewModel(
            [
            'conversation' => $conversation,
            'messages' => &$paginator,
            'form' => $form,
            ]
        );
        $viewModel->setTemplate('ogogo/zfc-user/pm/read-conversation.phtml');

        $redirectUrl = $this->url()->fromRoute('ogogo/zfc-user/pm/read-conversation', ['conversationId' => $conversation->getId()]);
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return $viewModel;
        }

        $form->setData($prg);
        if (!$form->isValid()) {
            return $viewModel;
        }

        $user = $this->zfcUserAuthentication()->getIdentity();
        $this->pmService->newMessage($conversation, $form->getData()['message'], $user);

        // return to self to get newest message and clear form
        return $this->redirect()->toRoute('ogogo/zfc-user/pm/read-conversation', ['conversationId' => $conversation->getId()]);
    }

    public function newConversationAction()
    {
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute($this->zfcUserOptions->getLoginRedirectRoute());
        }

        $users = $this->pmService->getUsers();
        $form = $this->newConversationForm;

        $viewModel = new ViewModel(
            [
            'users' => $users,
            'form' => $form,
            ]
        );
        $viewModel->setTemplate('ogogo/zfc-user/pm/new-conversation.phtml');

        $redirectUrl = $this->url()->fromRoute('ogogo/zfc-user/pm/new-conversation');
        $prg = $this->prg($redirectUrl, true);

        if ($prg instanceof Response) {
            return $prg;
        } elseif ($prg === false) {
            return $viewModel;
        }

        $form->setData($prg);
        if (!$form->isValid()) {
            return $viewModel;
        }

        $user = $this->zfcUserAuthentication()->getIdentity();
        $this->pmService->newConversation($form->getData(), $user);

        return $this->redirect()->toRoute('ogogo/zfc-user/pm/list');
    }

    function cmp_function($a, $b)
    {
        $t1 = strtotime($a['timeSent']);
        $t2 = strtotime($b['timeSent']);
       // return $t2 - $t1;

        if ($t1 == $t2) return 0;
        return ($t1 > $t2) ? -1 : 1;

    }    

    public function getAjaxMessagesAction()
    {
    $request = $this->getRequest();


        if ($request->isPost()) {   
            $post = $request->getPost()->toArray();

            $candidateUser = $post['cnd'];
            $employerUser = $post['emp'];

        $conversations = $this->pmService->getUserConversations($candidateUser);

        foreach($conversations as $conversation) {

            $participants = $this->pmService->getParticipants($conversation);
            $rpCount = 0;
 
                foreach ($participants as $participant) {
                    if($participant->getId() == $candidateUser){
                        $rpCount ++;
                    }
                    if($participant->getId() == $employerUser){
                        $rpCount ++;
                    }
                }

                if ($rpCount == 2){
                    $messages = $this->pmService->getMessages($conversation);
                    foreach ($messages as $message){

                        if($candidateUser == $message->getFrom()){
                            $from = 'candidate';
                        }
                        else
                        {
                            $from = 'employer';
                        }

                        $conversationArray =  array (
                         'conversationId'       => $conversation->getId(),
                         'conversationHeadline' => $conversation->getHeadline(),
                         'id'                   => $message->getId(),
                         'message'              => $message->getMessage(),
                         'fromId'               => $message->getFrom(),
                         'timeSent'             => $message->getDate()->format('Y-m-d\TH:i:sO'),
                         'from'                 => $from,
                        );
                        $conversationsArray[] = $conversationArray;

                        }
                }
        }
        usort($conversationsArray, array($this, "cmp_function")); 

        $result = new JsonModel($conversationsArray);

        return $result;
        }

    }

}
