<?php
namespace EMS\Controllers\Providers;

use Silex\Application;
use Silex\ControllerProviderInterface;

class PlanetType
    implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $planetTypes = $app['controllers_factory'];
        $planetTypes->get('/all', "planet_types.controller:index");
        $planetTypes->get('/{type}', "planet_types.controller:show");
        $planetTypes->get(
            '/{type}/planets',
            "planet_types.controller:showPlanets"
        );
        $planetTypes->get(
            '/{type}/planets/{name}',
            "planet_types.controller:showSinglePlanet"
        );

        return $planetTypes;
    }
}