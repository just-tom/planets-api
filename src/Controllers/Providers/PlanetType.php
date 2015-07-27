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
        $planetTypes->get('/', "EMS\\Controllers\\PlanetTypeController::index");
        $planetTypes->get('/{type}', "EMS\\Controllers\\PlanetTypeController::show");
        return $planetTypes;
    }
}