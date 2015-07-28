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

    public function showPlanets($type)
    {
        $typeCollection = $this->app['db']->createQueryBuilder();
        $typeCollection->select('*')
            ->from('types')
            ->where('type = :type')
            ->setParameter(':type', $type);
        $handle = $typeCollection->execute();
        $result['type'] = $handle->fetch();

        $planetCollection = $this->app['db']->createQueryBuilder();
        $planetCollection->select('*')
            ->from('planets')
            ->where('type_id = :id')
            ->setParameter(':id', $result['type']['id']);
        $handle = $planetCollection->execute();
        $result['planets'] = $handle->fetchAll();

        return $this->app->json($result);
    }
}