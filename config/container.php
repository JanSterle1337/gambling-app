<?php

use DI\ContainerBuilder;

$config = require "config.php";

$dsn = $config['database']['dsn'];
$username = $config['database']['username'];
$password = $config['database']['password'];

$builder = new ContainerBuilder();

$builder->addDefinitions(
    [
        PDO::class => new PDO($dsn, $username, $password),

        League\Plates\Engine::class => DI\autowire()
            ->constructor(__DIR__ . '/../views')
    ]
);

return $builder->build();
