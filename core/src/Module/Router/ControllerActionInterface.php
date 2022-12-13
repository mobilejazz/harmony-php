<?php

namespace Harmony\Core\Module\Router;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ControllerActionInterface {
  public function __invoke(Request $request): Response;
}
