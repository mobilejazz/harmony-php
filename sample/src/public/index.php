<?php

use Harmony\Core\Module\Config\Env\DotEnvPathsContainer;
use Harmony\Core\Module\Kernel\HttpKernel;
use Sample\AppProvider;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . "/../vendor/autoload.php";

try {
  $dotEnvPaths = new DotEnvPathsContainer([__DIR__ . "/../.env"]);
  $kernel = new HttpKernel($dotEnvPaths, new AppProvider());

  $request = Request::createFromGlobals();
  $response = $kernel->handleRequest($request);
  $response->send();
} catch (Exception $error) {
  if (function_exists("dump")) {
    dump($error->getMessage(), $error);
  } else {
    var_dump($error->getMessage(), $error);
  }
}
