<?php

namespace Harmony\Core\Module\Api\Response;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
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
