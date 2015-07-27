<?php

namespace EMS\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class GasController
    implements ControllerInterface
{
    public function index(Application $app, Request $request)
    {
        $result = $app['db']->fetchAll('SELECT * FROM gases');
        return $app->json($result);
    }

    public function show(Application $app, Request $request, $formula)
    {
        $builder = $app['db']->createQueryBuilder();
        $builder->select('*')->from('gases')->where('formula = :name')
            ->setParameter(':name', $formula);
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $app->json($result);
    }
}