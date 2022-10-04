<?php

namespace Harmony\Core\Module\Api\Request;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class RequestDTOFactory {
  public function __construct(protected RequestStack $requestStack) {
  }

  public function __invoke(string $dtoName): RequestDTOInterface {
    $request = $this->requestStack->getCurrentRequest();
    $requestFromJson = $this->deserializeJsonToRequestDTO(
      (string) $request?->getContent(),
      $dtoName,
    );

    return $requestFromJson;
  }

  protected function deserializeJsonToRequestDTO(
    string $jsonData,
    string $classNameRequest,
  ): RequestDTOInterface {
    $encoders = [new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];
    $serializer = new Serializer($normalizers, $encoders);

    // Serializer throw an error on empty JSON
    if (empty($jsonData)) {
      $jsonData = "[]";
    }

    /** @var RequestDTOInterface $jsonRequest */
    $jsonRequest = $serializer->deserialize(
      $jsonData,
      $classNameRequest,
      "json",
    );

    return $jsonRequest;
  }
}
