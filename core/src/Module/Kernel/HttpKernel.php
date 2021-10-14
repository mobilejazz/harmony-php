<?php

namespace Harmony\Core\Module\Kernel;

use Harmony\Core\Module\Router\ControllerActionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class HttpKernel extends Kernel {
  protected ?Request $request = null;

  public function handleRequest(Request $request): Response {
    $this->request = $request;

    $matcher = new UrlMatcher($this->routes, $this->context);
    $parameters = $matcher->match($this->request->getPathInfo());
    $controllerActionClass = $parameters["_controller"];

    /** @var ControllerActionInterface $controllerAction */
    $controllerAction = $this->diContainer->get($controllerActionClass);

    $response = $controllerAction($this->request);
    $response->prepare($this->request);

    return $response;
  }
}
