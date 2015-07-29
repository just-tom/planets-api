<?php

namespace EMS;

use Silex\Application;
use Igorw\Silex\ConfigServiceProvider;
use EMS\Controllers\Providers as ControllerProvider;

class Bootstrap extends Application
{
    public function __construct()
    {
        parent::__construct();

        $this->register( new ConfigServiceProvider(__DIR__ . "/Config/Config.yml"));
        foreach ($this['app_config'] as $key => $value) {
            $this[$key] = $value;
        }

        $this->registerProviders();
        $this->registerRepositories();
        $this->registerControllers();
        $this->registerRoutes();
    }

    public function registerProviders()
    {
        $this->register(
            new ConfigServiceProvider(
                __DIR__ . "/Config/Providers.yml",
                array('root_path' => __DIR__)
            )
        );

        foreach ($this['providers'] as $providerData) {
            $this->register(
                new $providerData['class'],
                (array_key_exists('parameters', $providerData))
                    ? $providerData['parameters'] : array()
            );
        }
    }

    public function registerRepositories()
    {
        $this->register(
            new ConfigServiceProvider(__DIR__ . "/Config/Repositories.yml")
        );

        foreach ($this['repositories'] as $repositoryName => $repositoryData) {
            $this[$repositoryName . '.repository'] = $this->share(
                function () use ($repositoryData) {
                    return new $repositoryData['repository']($this);
                }
            );
        }
    }

    public function registerControllers()
    {
        $this->register(
            new ConfigServiceProvider(__DIR__ . "/Config/Controllers.yml")
        );

        foreach ($this['app_controllers'] as $controllerName => $controllerData) {
            $this[$controllerName . '.controller'] = $this->share(
                function () use ($controllerData) {
                    return new $controllerData['controller']($this);
                }
            );
        }
    }

    public function registerRoutes()
    {
        $this->before(
            function (){
                $this['request_lang'] = 'json';
                if ($this['request']->get('lang') != null) {
                    $this['request_lang'] = $this['request']->get('lang');
                }
            }
        );
        $this->mount("/planets", new ControllerProvider\Planet());
        $this->mount("/gases", new ControllerProvider\Gas());
        $this->mount("/satellites", new ControllerProvider\Satellite());
        $this->mount("/planet-types", new ControllerProvider\PlanetType());
        $this->after($this['cors']);
    }
}
