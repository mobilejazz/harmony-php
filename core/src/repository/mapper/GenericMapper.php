<?php

namespace harmony\core\repository\mapper;

use harmony\core\shared\generics\GenericsHelper;

/**
 * @template TFrom
 * @template TTo
 */
abstract class GenericMapper implements Mapper {
  use GenericsHelper;

  /**
   * @psalm-param class-string<TFrom> $from
   * @psalm-param class-string<TTo>   $to
   *
   * @param class-string              $from
   * @param class-string              $to
   */
  public function __construct(
    protected string $from,
    protected string $to
  ) {
    $this->isClassOrFail($from);
    $this->isClassOrFail($to);
  }

  /**
   * @psalm-return class-string<TFrom>
   * @return string
   */
  public function getTypeFrom(): string {
    return $this->from;
  }

  /**
   * @psalm-return class-string<TTo>
   * @return string
   */
  public function getTypeTo(): string {
    return $this->to;
  }

  /**
   * @psalm-param  TFrom $from
   *
   * @param mixed        $from
   *
   * @psalm-return TTo
   * @return mixed
   */
  public function map($from) {
    $this->isTypeFromOrFail($from);

    $to = $this->overrideMap($from);
    $this->isTypeToOrFail($to);

    return $to;
  }

  /**
   * @psalm-param  TFrom $from
   *
   * @param mixed        $from
   *
   * @psalm-return TTo
   * @return mixed
   */
  abstract protected function overrideMap($from);

  /**
   * @param mixed $object
   *
   * @return bool
   */
  protected function isTypeFromOrFail($object): bool {
    return $this->isReceivedObjectLikeExpectedOrFail($object, $this->from);
  }

  /**
   * @param mixed $object
   *
   * @return bool
   */
  protected function isTypeToOrFail($object): bool {
    return $this->isReceivedObjectLikeExpectedOrFail($object, $this->to);
  }
}
