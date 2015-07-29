<?php

namespace EMS\Controllers;

use Symfony\Component\HttpFoundation\Response;

class PlanetController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['planets.repository']->getAllPlanets();

        return $this->getResponseObject($result, 'collection');
    }

    public function show($name)
    {
        $result = $this->app['planets.repository']->getPlanet($name);

        return $this->getResponseObject($result, 'single');
    }

    public function showGases($name)
    {
        $result = $this->app['gases.repository']->getGasesForPlanet($name);

        return $this->getResponseObject($result, 'collection');
    }

    public function showSingleGas($name, $formula)
    {
        $result = $this->app['gases.repository']
            ->getGasForPlanet($name, $formula);

        return $this->getResponseObject($result, 'single');
    }

    public function showSatellites($name)
    {
        $result = $this->app['satellites.repository']
            ->getSatellitesForPlanet($name);

        return $this->getResponseObject($result, 'collection');
    }

    public function showSingleSatellite($name, $satellite)
    {
        $result = $this->app['satellites.repository']
            ->getSatelliteForPlanet($name, $satellite);

        return $this->getResponseObject($result, 'single');
    }

    public function showPlanetTypes($name)
    {
        $result = $this->app['planet_types.repository']
            ->getPlanetTypesForPlanet($name);

        return $this->getResponseObject($result, 'collection');
    }

    public function showSinglePlanetType($name, $type)
    {
        $result = $this->app['planet_types.repository']
            ->getPlanetTypeForPlanet($name, $type);

        return $this->getResponseObject($result, 'single');
    }
}