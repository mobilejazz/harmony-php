<?php

namespace Harmony\Core\Module\Api\Request;

use socialPALSEventStore\Api\Controller\CreateEventRequest;
use socialPALSEventStore\Api\Controller\GetEventsRequest;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestDTOFactory {
  public function __construct(protected RequestStack $requestStack) {
  }

  public function __invoke(string $dtoName): RequestDTOInterface {
    $request = $this->requestStack->getCurrentRequest();
    $result = match ($dtoName) {
      GetEventsRequest::class => new GetEventsRequest(1),
      CreateEventRequest::class => new CreateEventRequest(1)
    };

    return $result;
  }
}
