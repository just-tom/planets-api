<?php

namespace EMS\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class SatelliteController
    implements ControllerInterface
{
    public function index(Application $app, Request $request)
    {
        $result = $app['db']->fetchAll('SELECT * FROM satellites');
        return $app->json($result);
    }

    public function show(Application $app, Request $request, $satellite)
    {
        $builder = $app['db']->createQueryBuilder();
        $builder->select('*')->from('satellites')->where('name = :name')
            ->setParameter(':name', $satellite);
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $app->json($result);
    }
}