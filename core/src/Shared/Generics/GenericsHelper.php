<?php

namespace Harmony\Core\Shared\Generics;

use Harmony\Core\Shared\Error\InvalidObjectException;
use Psr\Log\InvalidArgumentException;

trait GenericsHelper {
  /**
   * @param object $received
   * @param string $expected
   *
   * @return bool
   */
  protected function isReceivedObjectLikeExpected(
    object $received,
    string $expected,
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
    string $expected,
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
    string $expected,
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
    string $expected,
  ): bool {
    if (!$this->isReceivedClassLikeExpected($received, $expected)) {
      throw new InvalidObjectException($expected, $received);
    }

    return true;
  }

  /**
   * @param string $className
   */
  protected function isClassOrFail(string $className): void {
    if (!class_exists($className)) {
      throw new InvalidArgumentException("Class not found: " . $className);
    }
  }
}
