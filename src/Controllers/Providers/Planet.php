<?php
namespace EMS\Controllers\Providers;

use Silex\Application;
use Silex\ControllerProviderInterface;

class Planet
    implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $planets = $app['controllers_factory'];
        $planets->get('/', "planets.controller:index");
        $planets->get('/{name}', "planets.controller:show");
        $planets->get('/{name}/gases', "planets.controller:showGases");
        $planets->get('/{name}/gases/{formula}', "planets.controller:showSingleGas");
        $planets->get('/{name}/satellites', "planets.controller:showSatellites");
        $planets->get('/{name}/satellites/{satellite}', "planets.controller:showSingleSatellite");
        $planets->get('/{name}/planet-types', "planets.controller:showPlanetTypes");
        $planets->get('/{name}/planet-types/{type}', "planets.controller:showSinglePlanetType");
        return $planets;
    }
}