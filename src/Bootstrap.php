<?php

namespace EMS;

use Silex\Application;
use EMS\Controllers\Providers as ControllerProvider;

class Bootstrap extends Application{
    public function __construct()
    {
        parent::__construct();
        $app['debug'] = true;
        
        $this->registerProviders();
        $this->registerControllers();
        $this->registerRoutes();
    }

    public function registerProviders()
    {
        $this->register(new \Silex\Provider\ServiceControllerServiceProvider());
        $this->register(new \JDesrosiers\Silex\Provider\CorsServiceProvider());
        $this->register(new \Silex\Provider\DoctrineServiceProvider(), array(
                'db.options' => array(
                    'driver' => 'pdo_mysql',
                    'dbname' => 'ems_planets_local',
                    'host' => '127.0.0.1',
                    'user' => 'root',
                    'password' => 'password'
                )
            )
        );
    }

    public function registerControllers()
    {
        $app = $this;
        $this['planets.controller'] = $this->share(function() use ($app){
                return new \EMS\Controllers\PlanetController($this);
            });
        $this['gases.controller'] = $this->share(function() use ($app){
                return new \EMS\Controllers\GasController($this);
            });
        $this['satellites.controller'] = $this->share(function() use ($app){
                return new \EMS\Controllers\SatelliteController($this);
            });
        $this['planet_types.controller'] = $this->share(function() use ($app){
                return new \EMS\Controllers\PlanetTypeController($this);
            });
    }

    public function registerRoutes()
    {
        $app = $this;
        $this->before(function() use ($app){
                $this['request_lang'] = 'json';
                if($this['request']->get('lang') != null){
                    $this['request_lang'] = $this['request']->get('lang');
                }
            });
        $this->mount("/planets", new ControllerProvider\Planet());
        $this->mount("/gases", new ControllerProvider\Gas());
        $this->mount("/satellites", new ControllerProvider\Satellite());
        $this->mount("/planet-types", new ControllerProvider\PlanetType());
        $this->after($this['cors']);
    }
}
