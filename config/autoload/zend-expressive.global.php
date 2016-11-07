<?php

return [
    'debug' => true,

    'config_cache_enabled' => false,

    'zend-expressive' => [
        'error_handler' => [
            'template_404'   => 'error::404',
            'template_error' => 'error::error',
        ],
    ],
        'dependencies' => [
                'invokables' => [
                        'Zend\Expressive\Whoops' => Whoops\Run::class,
                        'Zend\Expressive\WhoopsPageHandler' => Whoops\Handler\PrettyPageHandler::class,
                    ],
                'factories' => [
                        'Zend\Expressive\FinalHandler' => Zend\Expressive\Container\WhoopsErrorHandlerFactory::class,
                    ],
            ],

        'whoops' => [
                'json_exceptions' => [
                        'display'    => true,
                        'show_trace' => true,
                        'ajax_only'  => true,
                    ],
            ],
];
