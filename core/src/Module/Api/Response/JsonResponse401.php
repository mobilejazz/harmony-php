<?php

namespace Harmony\Core\Module\Api\Response;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
class JsonResponse401 extends JsonResponse {
  public function __construct() {
    parent::__construct(
      [
        "error" => "Auth Required",
      ],
      401,
    );
  }
}
