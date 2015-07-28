<?php

namespace EMS\Controllers;

class PlanetController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['planets.repository']->getAllPlanets();
        return $this->app->json($result);
    }

    public function show($name)
    {
        $result = $this->app['planets.repository']->getPlanet($name);
        return $this->app->json($result);
    }

    public function showGases($name)
    {
        $result = $this->app['gases.repository']->getGasesForPlanet($name);
        return $this->app->json($result);
    }

    public function showSingleGas($name, $formula)
    {
        $result = $this->app['gases.repository']
            ->getGasForPlanet($name, $formula);
        return $this->app->json($result);
    }

    public function showSatellites($name)
    {
        $result = $this->app['satellites.repository']
            ->getSatellitesForPlanet($name);
        return $this->app->json($result);
    }

    public function showSingleSatellite($name, $satellite)
    {
        $result = $this->app['satellites.repository']
            ->getSatelliteForPlanet($name, $satellite);
        return $this->app->json($result);
    }

    public function showPlanetTypes($name)
    {
        $result = $this->app['planet_types.repository']
            ->getPlanetTypesForPlanet($name);
        return $this->app->json($result);
    }

    public function showSinglePlanetType($name, $type)
    {
        $result = $this->app['planet_types.repository']
            ->getPlanetTypeForPlanet($name, $type);
        return $this->app->json($result);
    }
}