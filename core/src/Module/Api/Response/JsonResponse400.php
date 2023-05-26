<?php

namespace Harmony\Core\Module\Api\Response;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
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
