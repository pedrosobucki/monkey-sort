<?php

abstract class Monkey
{
  public function __construct(
    public int $evenPointer,
    public int $oddPointer,
  )
  { }

  abstract public function totalCoconuts(): int;
  abstract public static function createMonkeyObject(string $row): self;

  protected static function retrieveNumbersFromString(string $source): array
  {
    preg_match_all('/[0-9]+/', $source, $matches);
    return $matches[0];
  }
}