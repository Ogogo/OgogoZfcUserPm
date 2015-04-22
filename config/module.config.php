<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

return [
    'service_manager' => [
        'factories' => [
            'Ogogo\ZfcUser\Pm\Options\ModuleOptions' => 'Ogogo\ZfcUser\Pm\Factory\Options\ModuleOptionsFactory',
            'Ogogo\ZfcUser\Pm\Service\PmService' => 'Ogogo\ZfcUser\Pm\Factory\Service\PmServiceFactory',
            'Ogogo\ZfcUser\Pm\Mapper\DoctrineORM\PmMapper' => 'Ogogo\ZfcUser\Pm\Factory\Mapper\DoctrineORM\PmMapperFactory',
        ],
        'invokables' => [
            'Ogogo\ZfcUser\Pm\Form\NewConversationForm' => 'Ogogo\ZfcUser\Pm\Form\NewConversationForm',
            'Ogogo\ZfcUser\Pm\Form\NewMessageForm' => 'Ogogo\ZfcUser\Pm\Form\NewMessageForm',
            'Ogogo\ZfcUser\Pm\Form\DeleteConversationsForm' => 'Ogogo\ZfcUser\Pm\Form\DeleteConversationsForm',
        ],
    ],
    'controllers' => [
        'factories' => [
            'Ogogo\ZfcUser\Pm\Controller\PmController' => 'Ogogo\ZfcUser\Pm\Factory\Controller\PmControllerFactory',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            'ZfcUserPm' => 'Ogogo\ZfcUser\Pm\Factory\View\Helper\ZfcUserPmHelperFactory',
        ],
    ],
    'router' => [
        'routes' => [
            'ogogo' => [
                'type' => 'Ogogo\Base\Mvc\Router\Http\NamespaceRoute',
                'child_routes' => [
                    'zfc-user' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/user',
                            'defaults' => [
                                'controller' => 'Ogogo\ZfcUser\Pm\Controller\PmController',
                            ],
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'pm' => [
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => [
                                    'route'    => '/pm',
                                ],
                                'may_terminate' => false,
                                'child_routes' => [
                                    'list' => [
                                        'type' => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => [
                                            'route'    => '/list[/:page]',
                                            'defaults' => [
                                                'action'     => 'index',
                                            ],
                                        ],
                                    ],
                                    'new-conversation' => [
                                        'type' => 'Zend\Mvc\Router\Http\Literal',
                                        'options' => [
                                            'route'    => '/new-conversation',
                                            'defaults' => [
                                                'action'     => 'newConversation',
                                            ],
                                        ],
                                    ],
                                    'new-conversation' => [
                                        'type' => 'Zend\Mvc\Router\Http\Literal',
                                        'options' => [
                                            'route'    => '/get-ajax-messages',
                                            'defaults' => [
                                                'action'     => 'getAjaxMessages',
                                            ],
                                        ],
                                    ],
                                    'read-conversation' => [
                                        'type' => 'Zend\Mvc\Router\Http\Segment',
                                        'options' => [
                                            'route'    => '/:conversationId[/:page]',
                                            'defaults' => [
                                                'action'     => 'readConversation',
                                            ],
                                            'constraints' => [
                                                'conversationId' => '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__.'/../view',
        ],
    ],

    'doctrine' => [
        'driver' => [
            'ogogo_zfcuser_pm_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => [
                    'default' => __DIR__.'/doctrine',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Ogogo\ZfcUser\Pm\Entity' => 'ogogo_zfcuser_pm_driver',
                ],
            ],
        ],
    ],
];
