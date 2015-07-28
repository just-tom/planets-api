<?php

namespace EMS\Controllers;

class GasController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['gases.repository']->getAllGases();
        return $this->app->json($result);
    }

    public function show($formula)
    {
        $result = $this->app['gases.repository']->getGas($formula);
        return $this->app->json($result);
    }

    public function showPlanets($formula)
    {
        $result = $this->app['planets.repository']->getPlanetsforGas($formula);
        return $this->app->json($result);
    }

    public function showSinglePlanet($formula, $name)
    {
        $result = $this->app['planets.repository']
            ->getPlanetforGas($formula, $name);
        return $this->app->json($result);
    }
}