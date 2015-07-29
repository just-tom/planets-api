<?php

namespace EMS\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

abstract class ControllerAbstract
    implements ControllerInterface
{
    protected $app;

    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    public function getResponseObject($results, $type)
    {
        $response = new Response($this->setDataOnResponse($results, $type));
        $response->headers->set(
            'Content-Type',
            'application/' . $this->app['request_lang'] . '; charset=UTF-8'
        );
        return $response;
    }

    protected function setDataOnResponse($results, $type)
    {
        if(!$results){
            return $this->app['twig']->render(
                'error.' . $this->app['request_lang'] . '.twig',
                array('exception' => null, 'code' => null)
            );
        }
        return $this->app['twig']->render(
            $type . '.' . $this->app['request_lang'] . '.twig',
            array($type => $results)
        );
    }
}