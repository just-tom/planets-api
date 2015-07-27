<?php

use Silex\Application;
use EMS\Controllers\Providers as ControllerProvider;

$app = new Application();
$app['debug'] = true;

$app->register(
    new Silex\Provider\DoctrineServiceProvider(),
    array(
        'db.options' => array(
            'driver' => 'pdo_mysql',
            'dbname' => 'ems_planets_local',
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => 'password'
        )
    )
);

$app->mount("/planets", new ControllerProvider\Planet());
$app->mount("/gases", new ControllerProvider\Gas());
$app->mount("/satellites", new ControllerProvider\Satellite());
$app->mount("/planet-types", new ControllerProvider\PlanetType());

return $app;