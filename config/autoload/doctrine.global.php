<?php

return [
    'doctrine'=>[
        'connection'=>[
            'orm_default'=>[
                'driverClass'=>'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'=>[
                    'host'=>'localhost',
                    'port'=>'3306',
                    'user'=>'root',
                    'password'=>'root',
                    'dbname'=>'code_php7',
                    'driverOptions'=>[
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
                    ]
                ]
            ]
        ],
        'driver'=>[
            'CodeEmailMKT_driver'=>[
                'class'=>'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache'=>'array',
                'paths'=>[__DIR__ . '/../../src/CodeEmailMKT/Infrastructure/Persistence/Doctrine/ORM']
            ],
            'orm_default'=>[
                'drivers'=>[
                    'CodeEmailMKT\Domain\Entity'=>'CodeEmailMKT_driver'
                ]
            ]
        ]
    ]
];