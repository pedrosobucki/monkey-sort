<?php

require_once("Monkey.php");

class CoconutMonkey extends Monkey
{
  public function __construct(
    int $evenPointer,
    int $oddPointer,
    public array $coconuts,
  )
  {
    parent::__construct($evenPointer, $oddPointer);
  }

  public function totalCoconuts(): int
  {
    return count($this->coconuts);
  }

  public static function createMonkeyObject(string $row): self
  {
    $sections = explode(':', $row);

    $monkeyInfo = self::retrieveNumbersFromString($sections[0]);
    $coconuts = self::retrieveNumbersFromString($sections[2]);

    return new self((int)$monkeyInfo[1], (int)$monkeyInfo[2], $coconuts);
  }
}