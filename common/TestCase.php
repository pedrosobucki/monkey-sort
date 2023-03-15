<?php

enum TestCase:int
{
  case Fifty = 50;
  case Hundred = 100;
  case TwoHundred = 200;
  case FourHundred = 400;
  case SixHundred = 600;
  case EightHundred = 800;
  case NienHundred = 900;
  case Thousand = 1000;

  public static function validateFrom(int $value): self
  {
    $testCase = self::tryFrom($value);

    if ($testCase === null) {
      echo "\nrequested '{$value}' test case was not found!\n";
      die;
    }

    return $testCase;
  }
}