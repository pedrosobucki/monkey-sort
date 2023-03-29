<?php

require_once("Model/CoconutMonkey.php");
require_once("Model/EvenOddMonkey.php");

enum Sort:string
{
  case Direct = 'direct';
  case EvenOddCount = 'even_odd_count';
  case PatterIdentification = 'pattern_identification';
  case ImprovedPatterIdentification = 'improved_pattern_identification';

  public function number(): int
  {
    return array_search($this, self::cases()) + 1;
  }

  public function monkeyType(): string
  {
    if ($this === self::Direct) {
      return CoconutMonkey::class;
    }

    return EvenOddMonkey::class;
  }

  public static function validateFrom(string|int $value): self
  {
    if (is_numeric($value)) {
        return self::validateFromInt((int)$value);
    }

    return self::validateFromString($value);
  }

  private static function validateFromString(string $value): self
  {
    $sort = self::tryFrom($value);

    if ($sort === null) {
      echo "\nrequested '{$value}' sort was not found!\n";
      die;
    }

    return $sort;
  }

  private static function validateFromInt(int $value): self
  {
    $sorts = self::cases();

    for ($i=0; $i < count($sorts); $i++) {
      if ($sorts[$i]->number() === $value) {
        return $sorts[$i];
      }
    }

    echo "\nrequested '{$value}' sort was not found!\n";
    die;
  }
}