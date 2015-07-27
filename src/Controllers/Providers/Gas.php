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
        $gases->get('/', "EMS\\Controllers\\GasController::index");
        $gases->get('/{formula}', "EMS\\Controllers\\GasController::show");
        return $gases;
    }
}