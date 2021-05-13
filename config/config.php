<?php

use Monolog\Logger;

return [
    "database" =>
        [
            "connection" => "mysql:host=localhost;dbname=pelu-recu;charset=utf8",
            "username" => "root",
            "password" => "",
            "options" => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true]
        ]
    ,
    "logfile" => "my_app.log",
    "loglevel" => Logger::DEBUG,
    "partners_path" => "images/partners/",
    "posters_path" => "images/posters/",
    "imagen_path" => "images/design/productos/",
    "avatar_path" => "images/design/",
    'mailer' => [
        'smtp_server' => "smtp.gmail.com",
        'smtp_port' => 587,
        'smtp_security' => 'tls',
        'username' => 'vjorda.pego@gmail.com',
        'password' => 'fakepassword',
        'email' => 'vjorda.pego@gmail.com',
        'name' => 'Vicent Jordà'
    ],

    "security" => ["roles" =>
        [
            "ROLE_ADMIN" => 3,
            "ROLE_USER" => 2,
            "ROLE_ANONYMOUS" => 1
        ]
    ]
];
