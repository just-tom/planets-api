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

    public function showPlanet($satellite)
    {
        $satelliteCollection = $this->app['db']->createQueryBuilder();
        $satelliteCollection->select('*')
            ->from('satellites')
            ->where('name = :name')
            ->setParameter(':name', $satellite);
        $handle = $satelliteCollection->execute();
        $result['satellite'] = $handle->fetch();

        $planetCollection = $this->app['db']->createQueryBuilder();
        $planetCollection->select('*')
            ->from('planets')
            ->where('id = :id')
            ->setParameter(':id', $result['satellite']['planet_id']);
        $handle = $planetCollection->execute();
        $result['planet'] = $handle->fetch();


        return $this->app->json($result);

    }
}