<?php

namespace Harmony\Core\Module\Kernel;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class HttpKernel extends Kernel {
  public function handleRequest(): Response {
    $matcher = new UrlMatcher($this->routes, $this->context);
    $parameters = $matcher->match($this->request->getPathInfo());
    $controllerAction = $parameters["_controller"];

    $response = (new $controllerAction())($this->request);
    $response->prepare($this->request);

    return $response;
  }
}
