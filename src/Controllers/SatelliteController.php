<?php

namespace EMS\Controllers;

class SatelliteController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['satellites.repository']->getAllSatellites();
        return $this->app->json($result);
    }

    public function show($satellite)
    {
        $result = $this->app['satellites.repository']->getSatellite($satellite);
        return $this->app->json($result);
    }

    public function showPlanets($satellite)
    {
        $result = $this->app['planets.repository']
            ->getPlanetsForSatellite($satellite);
        return $this->app->json($result);
    }
}