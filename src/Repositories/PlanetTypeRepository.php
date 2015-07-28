<?php

namespace EMS\Repositories;

use Silex\Application;

class PlanetTypeRepository
{
    protected $app;
    protected $queryBuilder;

    public function __construct(Application $application)
    {
        $this->app = $application;
        $this->queryBuilder = $application['db']->createQueryBuilder();
    }

    public function getAllPlanetTypes()
    {
        $this->queryBuilder
            ->select('*')
            ->from('types');

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }

    public function getPlanetType($type)
    {
        $this->queryBuilder
            ->select('*')
            ->from('types')
            ->where('type = :type')
            ->setParameter(':type', $type);

        return $this->queryBuilder
            ->execute()
            ->fetch();
    }

    public function getPlanetTypesForPlanet($name)
    {
        $this->queryBuilder->select('pt.id', 'pt.type')
            ->from('types', 'pt')
            ->innerJoin('pt', 'planets', 'p', 'pt.id = p.type_id')
            ->where('p.name = :name')
            ->setParameter(':name', $name);

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }

    public function getPlanetTypeForPlanet($name, $type)
    {
        $this->queryBuilder->select('pt.*')
            ->from('types', 'pt')
            ->innerJoin('pt', 'planets', 'p', 'pt.id = p.type_id')
            ->where('p.name = :name')
            ->andWhere('pt.type = :planet_type')
            ->setParameters(array(':name' => $name, ':planet_type' => $type));

        return $this->queryBuilder
            ->execute()
            ->fetchAll();
    }
}