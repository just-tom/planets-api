<?php

namespace EMS\Controllers;

class SatelliteController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['satellites.repository']->getAllSatellites();

        return $this->getResponseObject($result, 'collection');
    }

    public function show($satellite)
    {
        $result = $this->app['satellites.repository']->getSatellite($satellite);

        return $this->getResponseObject($result, 'single');
    }

    public function showPlanets($satellite)
    {
        $result = $this->app['planets.repository']
            ->getPlanetsForSatellite($satellite);

        return $this->getResponseObject($result, 'collection');
    }

    public function showSinglePlanet($satellite, $name)
    {
        $result = $this->app['planets.repository']
            ->getPlanetForSatellite($satellite, $name);

        return $this->getResponseObject($result, 'single');
    }
}