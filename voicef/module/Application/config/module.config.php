<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            //-- Application --//
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/app',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
	   ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        // ZSmarty
        'factories' => array(
		    'Smarty' => 'ZSmarty\StrategyFactory',
		),
    ),
    'translator' => array(
        'locale' => 'ja_JP',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index'	=> 'Application\Controller\IndexController',
            'Application\Controller\Api'	=> 'Application\Controller\ApiController',
            'Application\Controller\Cli'	=> 'Application\Controller\CliController',
        ),
    ),
    'view_manager' => array(
    	'strategies' => array('Smarty'),
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'application/layout'	  => MODULE_DIR . '/Application/view/layout/layout.tpl',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            	'feed-update-entry' => array(
                    'options' => array(
                        'route'    => 'feed update [--verbose|-v] <categoryId>',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Cli',
                            'action'     => 'update'
                        )
                    )
                ),
            	'feed-update-tweet' => array(
                    'options' => array(
                        'route'    => 'feed update-tweet [--verbose|-v] <categoryId>',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Cli',
                            'action'     => 'update-tweet'
                        )
                    )
                )
            ),
        ),
    ),
);
