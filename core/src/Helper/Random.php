<?php
namespace Harmony\Core\Helper;

use Carbon\Carbon;

/**
 * @see RandomTest
 */
class Random {
  /**
   * @link https://symfony.com/doc/5.2/components/security/secure_tools.html#generating-a-secure-random-number
   */
  public static function generateInteger(): int {
    $randomInteger = random_int(1, mt_getrandmax());

    return $randomInteger;
  }

  public static function generateStringDateTime(): string {
    $dateTime = Carbon::now()->subSeconds(self::generateInteger());
    $stringDateTime = $dateTime->toDateTimeString();

    return $stringDateTime;
  }

  /**
   * @link https://symfony.com/doc/5.2/components/security/secure_tools.html#generating-a-secure-random-string
   */
  public static function generateAlphaNumeric(): string {
    $randomBytes = random_bytes(20);
    $sha1 = sha1($randomBytes);

    return $sha1;
  }
}
