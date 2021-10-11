<?php

use Harmony\Core\Module\Config\Env\DotEnvPathsContainer;
use Harmony\Core\Module\Kernel\HttpKernel;
use Sample\SampleModules;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . "/../vendor/autoload.php";

$dotEnvPaths = new DotEnvPathsContainer([__DIR__ . "/../.env"]);
$kernel = new HttpKernel($dotEnvPaths, new SampleModules());

$request = Request::createFromGlobals();
$kernel->bootstrap($request);
$response = $kernel->handleRequest();

$response->send();
