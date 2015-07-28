<?php

namespace EMS\Repositories;

use Silex\Application;

class SatelliteRepository
{
    protected $app;
    protected $queryBuilder;

    public function __construct(Application $application)
    {
        $this->app = $application;
        $this->queryBuilder = $application['db']->createQueryBuilder();
    }

    public function getAllSatellites()
    {
        $this->queryBuilder
            ->select('*')
            ->from('satellites');

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }

    public function getSatellite($satellite)
    {
        $this->queryBuilder
            ->select('*')
            ->from('satellites')
            ->where('name = :satellite')
            ->setParameter(':satellite', $satellite);

        return $this->queryBuilder
            ->execute()
            ->fetch();
    }

    public function getSatellitesForPlanet($name)
    {
        $this->queryBuilder->select('s.id', 's.name')
            ->from('satellites', 's')
            ->innerJoin('s', 'planets', 'p', 's.planet_id = p.id')
            ->where('p.name = :name')
            ->setParameter(':name', $name);

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }

    public function getSatelliteForPlanet($name, $satellite)
    {
        $this->queryBuilder->select('s.*')
            ->from('satellites', 's')
            ->innerJoin('s', 'planets', 'p', 's.planet_id = p.id')
            ->where('p.name = :name')
            ->andWhere('s.name = :satellite')
            ->setParameters(array(':name' => $name, ':satellite' => $satellite));

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }
}