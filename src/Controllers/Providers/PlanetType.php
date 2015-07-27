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
        $planetTypes->get('/', "planet_types.controller:index");
        $planetTypes->get('/{type}', "planet_types.controller:show");
        return $planetTypes;
    }
}