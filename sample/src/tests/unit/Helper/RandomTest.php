<?php

namespace App\Tests\unit\Helper;

use Carbon\Carbon;
use Harmony\Core\Helper\Format;
use Harmony\Core\Helper\Random;
use PHPUnit\Framework\TestCase;

class RandomTest extends TestCase {
  public function testIntegerReturnNumber(): void {
    $result = Random::generateInteger();

    $this->assertGreaterThan(0, $result);
  }

  public function testIntegerReturnRandomValues(): void {
    $resultOne = Random::generateInteger();
    $resultTwo = Random::generateInteger();

    $this->assertNotEquals($resultOne, $resultTwo);
  }

  public function testStringDateTimeReturnDateTimeWithCorrectFormat(): void {
    $result = Random::generateStringDateTime();
    $dateTime = Carbon::createFromFormat(Format::DATE_TIME, $result);

    $this->assertInstanceOf(Carbon::class, $dateTime);
  }

  public function testStringDateTimeReturnRandomValues(): void {
    $resultOne = Random::generateStringDateTime();
    $dateTimeOne = Carbon::createFromFormat(Format::DATE_TIME, $resultOne);

    $resultTwo = Random::generateStringDateTime();
    $dateTimeTwo = Carbon::createFromFormat(Format::DATE_TIME, $resultTwo);

    $this->assertFalse(!$dateTimeOne || $dateTimeOne->equalTo($dateTimeTwo));
  }

  public function testPhraseReturnValidString(): void {
    $result = Random::generateAlphaNumeric();

    $this->assertGreaterThan(2, strlen($result));
  }

  public function testPhraseReturnRandomValues(): void {
    $resultOne = Random::generateAlphaNumeric();
    $resultTwo = Random::generateAlphaNumeric();

    $this->assertNotEquals($resultOne, $resultTwo);
  }
}
