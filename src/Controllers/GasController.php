<?php

namespace EMS\Controllers;

class GasController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['db']->fetchAll('SELECT * FROM gases');
        return $this->app->json($result);
    }

    public function show($formula)
    {
        $builder = $this->app['db']->createQueryBuilder();
        $builder->select('*')->from('gases')->where('formula = :name')
            ->setParameter(':name', $formula);
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $this->app->json($result);
    }
}