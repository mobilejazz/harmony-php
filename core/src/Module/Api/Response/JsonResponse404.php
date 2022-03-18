<?php

namespace Harmony\Core\Module\Api\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonResponse404 extends JsonResponse {
  public function __construct() {
    parent::__construct(
      [
        "error" => "Not Found",
      ],
      404,
    );
  }
}
