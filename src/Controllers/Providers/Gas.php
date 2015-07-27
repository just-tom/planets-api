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
        $gases->get('/', "gases.controller:index");
        $gases->get('/{formula}', "gases.controller:show");
        return $gases;
    }
}