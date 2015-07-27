<?php

namespace EMS\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PlanetTypeController
    implements ControllerInterface
{
    public function index(Application $app, Request $request)
    {
        $result = $app['db']->fetchAll('SELECT * FROM types');
        return $app->json($result);
    }

    public function show(Application $app, Request $request, $type)
    {
        $builder = $app['db']->createQueryBuilder();
        $builder->select('*')->from('types')->where('type = :name')
            ->setParameter(':name', $type);
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $app->json($result);
    }
}