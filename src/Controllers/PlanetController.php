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

    public function showSatellites($name)
    {
        $planetCollection = $this->app['db']->createQueryBuilder();
        $planetCollection->select('*')->from('planets')->where('name = :name')
            ->setParameter(':name', $name);
        $handle = $planetCollection->execute();
        $result['planet'] = $handle->fetch();

        $satelliteCollection = $this->app['db']->createQueryBuilder();
        $satelliteCollection->select('*')
            ->from('satellites')
            ->where('planet_id = :id')
            ->setParameter(':id', $result['planet']['id']);
        $handle = $satelliteCollection->execute();
        $result['satellites'] = $handle->fetchAll();

        return $this->app->json($result);
    }

    public function showSingleSatellite($name, $satellite)
    {
        $builder = $this->app['db']->createQueryBuilder();
        $builder->select('s.*, p.*')
            ->from('satellites', 's')
            ->innerJoin('s', 'planets', 'p', 's.planet_id = p.id')
            ->where('p.name = :name')
            ->andWhere('s.name = :satellite')
            ->setParameters(array(':name' => $name,':satellite' => $satellite));
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $this->app->json($result);
    }

    public function showPlanetTypes($name)
    {
        $planetCollection = $this->app['db']->createQueryBuilder();
        $planetCollection->select('*')->from('planets')->where('name = :name')
            ->setParameter(':name', $name);
        $handle = $planetCollection->execute();
        $result['planet'] = $handle->fetch();

        $typeCollection = $this->app['db']->createQueryBuilder();
        $typeCollection->select('*')
            ->from('types')
            ->where('id = :id')
            ->setParameter(':id', $result['planet']['type_id']);
        $handle = $typeCollection->execute();
        $result['types'] = $handle->fetchAll();

        return $this->app->json($result);
    }

    public function showSinglePlanetType($name, $type)
    {
        $builder = $this->app['db']->createQueryBuilder();
        $builder->select('pt.*, p.*')
            ->from('types', 'pt')
            ->innerJoin('pt', 'planets', 'p', 'pt.id = p.type_id')
            ->where('p.name = :name')
            ->andWhere('pt.type = :type')
            ->setParameters(array(':name' => $name,':type' => $type));
        $handle = $builder->execute();
        $result = $handle->fetch();

        return $this->app->json($result);
    }
}