<?php

namespace EMS\Controllers;

class PlanetController
    extends ControllerAbstract
{
    public function index()
    {
        $result = $this->app['db']->fetchAll('SELECT * FROM planets');
        return $this->app->json($result);
    }

    public function show($name)
    {
        $builder = $this->app['db']->createQueryBuilder();
        $builder->select('*')->from('planets')->where('name = :name')
            ->setParameter(':name', $name);
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $this->app->json($result);
    }

    public function showGases($name)
    {
        $gasCollection = $this->app['db']->createQueryBuilder();
        $gasCollection->select('g.*')
            ->from('gases', 'g')
            ->innerJoin('g', 'planets_gases', 'pg', 'g.id = pg.gas_id')
            ->innerJoin('pg', 'planets', 'p', 'pg.planet_id = p.id')
            ->where('p.name = :name')
            ->setParameter(':name', $name);
        $handle = $gasCollection->execute();
        $result['gases'] = $handle->fetchAll();

        $planetCollection = $this->app['db']->createQueryBuilder();
        $planetCollection->select('*')->from('planets')->where('name = :name')
            ->setParameter(':name', $name);
        $handle = $planetCollection->execute();
        $result['planet'] = $handle->fetch();

        return $this->app->json($result);
    }

    public function showSingleGas($name, $formula)
    {
        $builder = $this->app['db']->createQueryBuilder();
        $builder->select('g.*, p.*')
            ->from('gases', 'g')
            ->innerJoin('g', 'planets_gases', 'pg', 'g.id = pg.gas_id')
            ->innerJoin('pg', 'planets', 'p', 'pg.planet_id = p.id')
            ->where('p.name = :name')
            ->andWhere('g.formula = :formula')
            ->setParameters(array(':name' => $name,':formula' => $formula));
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $this->app->json($result);
    }
}