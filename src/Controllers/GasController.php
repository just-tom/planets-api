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

    public function showPlanets($formula)
    {
        $planetsCollection = $this->app['db']->createQueryBuilder();
        $planetsCollection->select('p.*')
            ->from('planets', 'p')
            ->innerJoin('p', 'planets_gases', 'pg', 'p.id = pg.planet_id')
            ->innerJoin('pg', 'gases', 'g', 'pg.gas_id = g.id')
            ->where('g.formula = :formula')
            ->setParameter(':formula', $formula);
        $handle = $planetsCollection->execute();
        $result['planets'] = $handle->fetchAll();

        $gasCollection = $this->app['db']->createQueryBuilder();
        $gasCollection->select('*')->from('gases')->where('formula = :name')
            ->setParameter(':name', $formula);
        $handle = $gasCollection->execute();
        $result['gas'] = $handle->fetch();

        return $this->app->json($result);
    }
}