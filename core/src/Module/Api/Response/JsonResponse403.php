<?php

namespace Harmony\Core\Module\Api\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonResponse403 extends JsonResponse {
  public function __construct() {
    parent::__construct(
      [
        "error" => "Forbidden",
      ],
      403,
    );
  }
}
