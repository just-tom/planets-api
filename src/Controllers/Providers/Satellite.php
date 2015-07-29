<?php
namespace EMS\Controllers\Providers;

use Silex\Application;
use Silex\ControllerProviderInterface;

class Satellite
    implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $satellites = $app['controllers_factory'];
        $satellites->get('/all', "satellites.controller:index");
        $satellites->get('/{satellite}', "satellites.controller:show");
        $satellites->get(
            '/{satellite}/planets',
            "satellites.controller:showPlanets"
        );
        $satellites->get(
            '/{satellite}/planets/{name}',
            "satellites.controller:showSinglePlanet"
        );

        return $satellites;
    }
}