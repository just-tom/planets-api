<?php

namespace EMS\Repositories;

use Silex\Application;

class GasRepository
{
    protected $app;
    protected $queryBuilder;

    public function __construct(Application $application)
    {
        $this->app = $application;
        $this->queryBuilder = $application['db']->createQueryBuilder();
    }

    public function getAllGases()
    {
        $this->queryBuilder
            ->select('*')
            ->from('gases');

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }

    public function getGas($formula)
    {
        $this->queryBuilder
            ->select('*')
            ->from('gases')
            ->where('formula = :formula')
            ->setParameter(':formula', $formula);

        return $this->queryBuilder
            ->execute()
            ->fetch();
    }

    public function getGasesForPlanet($name)
    {
        $this->queryBuilder->select('g.id', 'g.formula')
            ->from('planets', 'p')
            ->innerJoin('p', 'planets_gases', 'pg', 'p.id = pg.planet_id')
            ->innerJoin('pg', 'gases', 'g', 'pg.gas_id = g.id')
            ->where('p.name = :name')
            ->setParameter(':name', $name);

        return $this->queryBuilder
            ->execute()
            ->fetchAll();

    }

    public function getGasForPlanet($name, $formula)
    {
        $this->queryBuilder->select('g.*')
            ->from('planets', 'p')
            ->innerJoin('p', 'planets_gases', 'pg', 'p.id = pg.planet_id')
            ->innerJoin('pg', 'gases', 'g', 'pg.gas_id = g.id')
            ->where('p.name = :name')
            ->andWhere('g.formula = :formula')
            ->setParameters(array(':name' => $name, ':formula' => $formula));

        return $this->queryBuilder
            ->execute()
            ->fetch();
    }
}