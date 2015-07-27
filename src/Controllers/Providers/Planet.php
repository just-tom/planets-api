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
        $planets->get('/', "EMS\\Controllers\\PlanetController::index");
        $planets->get('/{name}', "EMS\\Controllers\\PlanetController::show");
        return $planets;
    }
}