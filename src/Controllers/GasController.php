<?php

namespace EMS\Controllers;

class GasController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['gases.repository']->getAllGases();
        return $this->getResponseObject($result, 'collection');
    }

    public function show($formula)
    {
        $result = $this->app['gases.repository']->getGas($formula);
        return $this->getResponseObject($result, 'single');
    }

    public function showPlanets($formula)
    {
        $result = $this->app['planets.repository']->getPlanetsforGas($formula);
        return $this->getResponseObject($result, 'collection');
    }

    public function showSinglePlanet($formula, $name)
    {
        $result = $this->app['planets.repository']
            ->getPlanetforGas($formula, $name);
        return $this->getResponseObject($result, 'single');
    }
}