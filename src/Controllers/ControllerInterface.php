<?php

namespace EMS\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

interface ControllerInterface
{
    public function index(Application $app, Request $request);
    public function show(Application $app, Request $request, $id);
}