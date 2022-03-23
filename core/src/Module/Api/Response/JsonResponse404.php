<?php

namespace Harmony\Core\Module\Api\Response;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
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
