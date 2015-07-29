<?php

namespace EMS\Controllers;

class PlanetTypeController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['planet_types.repository']->getAllPlanetTypes();

        return $this->getResponseObject($result, 'collection');
    }

    public function show($type)
    {
        $result = $this->app['planet_types.repository']->getPlanetType($type);

        return $this->getResponseObject($result, 'single');
    }

    public function showPlanets($type)
    {
        $result = $this->app['planets.repository']->getPlanetsForType($type);

        return $this->getResponseObject($result, 'collection');
    }

    public function showSinglePlanet($type, $name)
    {
        $result = $this->app['planets.repository']
            ->getPlanetForType($type, $name);

        return $this->getResponseObject($result, 'single');
    }
}