<?php

namespace EMS\Controllers;

class PlanetTypeController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['planet_types.repository']->getAllPlanetTypes();
        return $this->app->json($result);
    }

    public function show($type)
    {
        $result = $this->app['planet_types.repository']->getPlanetType($type);
        return $this->app->json($result);
    }

    public function showPlanets($type)
    {
        $result = $this->app['planets.repository']->getPlanetsForType($type);
        return $this->app->json($result);
    }

    public function showSinglePlanet($type, $name)
    {
        $result = $this->app['planets.repository']
            ->getPlanetForType($type, $name);
        return $this->app->json($result);
    }
}