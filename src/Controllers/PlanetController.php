<?php

namespace EMS\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class PlanetController
    implements ControllerInterface
{
    public function index(Application $app, Request $request)
    {
        $result = $app['db']->fetchAll('SELECT * FROM planets');
        return $app->json($result);
    }

    public function show(Application $app, Request $request, $name)
    {
        $builder = $app['db']->createQueryBuilder();
        $builder->select('*')->from('planets')->where('name = :name')
            ->setParameter(':name', $name);
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $app->json($result);
    }
}