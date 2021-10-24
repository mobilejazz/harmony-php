<?php

namespace Sample\User\Api;

use Harmony\Core\Module\Router\ControllerActionInterface;
use Sample\User\Domain\Interactor\GetAllUsersWithNameInteractor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAction implements ControllerActionInterface {
  public function __construct(
    protected GetAllUsersWithNameInteractor $getAllInteractor,
  ) {
  }

  public function __invoke(Request $request): JsonResponse {
    $users = ($this->getAllInteractor)(0, 5, "messi");
    $response = new JsonResponse($users, Response::HTTP_OK);

    return $response;
  }
}
