<?php

enum Sort:string
{
  case Direct = 'direct';

  public function number(): int
  {
    return match($this) {
      self::Direct => 1
    };
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
    $sort = match($value) {
      self::Direct->number() => self::Direct,

      default => null
    };

    if ($sort === null) {
      echo "\nrequested '{$value}' sort was not found!\n";
      die;
    }

    return $sort;
  }
}