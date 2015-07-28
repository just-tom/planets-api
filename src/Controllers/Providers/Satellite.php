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
        $satellites->get('/', "satellites.controller:index");
        $satellites->get('/{satellite}', "satellites.controller:show");
        $satellites->get('/{satellite}/planets', "satellites.controller:showPlanets");
        return $satellites;
    }
}