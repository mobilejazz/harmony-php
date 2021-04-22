<?php

namespace harmony\core\shared\generics;

use harmony\core\shared\error\InvalidObjectException;

trait GenericsHelper {
  /**
   * @param object $received
   * @param string $expected
   *
   * @return bool
   */
  protected function isReceivedObjectLikeExpected(
    object $received,
    string $expected
  ): bool {
    return $received instanceof $expected;
  }

  /**
   * @param object $received
   * @param string $expected
   *
   * @return bool
   */
  protected function isReceivedObjectLikeExpectedOrFail(
    object $received,
    string $expected
  ): bool {
    if (!$this->isReceivedObjectLikeExpected($received, $expected)) {
      throw new InvalidObjectException($expected, get_class($received));
    }

    return true;
  }

  /**
   * @param string $received
   * @param string $expected
   *
   * @return bool
   */
  protected function isReceivedClassLikeExpected(
    string $received,
    string $expected
  ): bool {
    return is_subclass_of($received, $expected);
  }

  /**
   * @param string $received
   * @param string $expected
   *
   * @return bool
   */
  protected function isReceivedClassLikeExpectedOrFail(
    string $received,
    string $expected
  ): bool {
    if (!$this->isReceivedClassLikeExpected($received, $expected)) {
      throw new InvalidObjectException($expected, $received);
    }

    return true;
  }
}
