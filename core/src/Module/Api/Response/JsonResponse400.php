<?php

namespace Harmony\Core\Module\Api\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonResponse400 extends JsonResponse {
  public function __construct(string $errors = "") {
    parent::__construct(
      [
        "error" => "Bad Request",
        "errors" => $errors,
      ],
      400,
    );
  }
}
