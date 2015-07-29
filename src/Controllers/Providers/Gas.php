<?php
namespace EMS\Controllers\Providers;

use Silex\Application;
use Silex\ControllerProviderInterface;

class Gas
    implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $gases = $app['controllers_factory'];
        $gases->get('/all', "gases.controller:index");
        $gases->get('/{formula}', "gases.controller:show");
        $gases->get('/{formula}/planets', "gases.controller:showPlanets");
        $gases->get('/{formula}/planets/{name}', "gases.controller:showSinglePlanet");
        return $gases;
    }
}