<?php

namespace EMS\Controllers;

use Silex\Application;

abstract class ControllerAbstract
    implements ControllerInterface
{
    protected $app;
    public function __construct(Application $application){
        $this->app = $application;
    }
}