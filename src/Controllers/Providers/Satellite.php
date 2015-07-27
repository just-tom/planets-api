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
        $satellites->get('/', "EMS\\Controllers\\SatelliteController::index");
        $satellites->get('/{satellite}', "EMS\\Controllers\\SatelliteController::show");
        return $satellites;
    }
}