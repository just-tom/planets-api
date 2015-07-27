<?php

namespace EMS\Controllers;

class PlanetTypeController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['db']->fetchAll('SELECT * FROM types');
        return $this->app->json($result);
    }

    public function show($type)
    {
        $builder = $this->app['db']->createQueryBuilder();
        $builder->select('*')->from('types')->where('type = :name')
            ->setParameter(':name', $type);
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $this->app->json($result);
    }
}