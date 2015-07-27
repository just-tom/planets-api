<?php

namespace EMS\Controllers;

class SatelliteController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['db']->fetchAll('SELECT * FROM satellites');
        return $this->app->json($result);
    }

    public function show($satellite)
    {
        $builder = $this->app['db']->createQueryBuilder();
        $builder->select('*')->from('satellites')->where('name = :name')
            ->setParameter(':name', $satellite);
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $this->app->json($result);
    }
}