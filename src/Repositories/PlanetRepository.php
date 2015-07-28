<?php

namespace EMS\Repositories;

use Silex\Application;

class PlanetRepository
{
    protected $app;
    protected $queryBuilder;

    public function __construct(Application $application)
    {
        $this->app = $application;
        $this->queryBuilder = $application['db']->createQueryBuilder();
    }

    public function getAllPlanets()
    {
        $this->queryBuilder
            ->select('*')
            ->from('planets');

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }

    public function getPlanet($name)
    {
        $this->queryBuilder
            ->select('*')
            ->from('planets')
            ->where('name = :name')
            ->setParameter(':name', $name);

        return $this->queryBuilder
            ->execute()
            ->fetch();
    }

    public function getPlanetsForGas($formula)
    {
        $this->queryBuilder->select('p.*')
            ->from('planets', 'p')
            ->innerJoin('p', 'planets_gases', 'pg', 'p.id = pg.planet_id')
            ->innerJoin('pg', 'gases', 'g', 'pg.gas_id = g.id')
            ->where('g.formula = :formula')
            ->setParameter(':formula', $formula);

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }

    public function getPlanetsForSatellite($satellite)
    {
        $this->queryBuilder->select('p.*')
            ->from('satellites', 's')
            ->innerJoin('s', 'planets', 'p', 's.planet_id = p.id')
            ->where('s.name = :name')
            ->setParameter(':name', $satellite);

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }

    public function getPlanetsForType($planetType)
    {
        $this->queryBuilder
            ->select('p.*')
            ->from('planets', 'p')
            ->innerJoin('p', 'types', 't', 'p.type_id = t.id')
            ->where('t.type = :planet_type')
            ->setParameter(':planet_type', $planetType);

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }
}