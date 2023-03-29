<?php

require_once("Monkey.php");

class EvenOddMonkey extends Monkey
{
  public function __construct(
    int $evenPointer,
    int $oddPointer,
    public int $evens = 0,
    public int $odds = 0,
  )
  {
    parent::__construct($evenPointer, $oddPointer);
  }

  public function totalCoconuts(): int
  {
    return $this->evens + $this->odds;
  }

  public static function createMonkeyObject(string $row): self
  {
    $sections = explode(':', $row);

    $monkeyInfo = self::retrieveNumbersFromString($sections[0]);
    $coconuts = self::retrieveNumbersFromString($sections[2]);

    $evens = 0;
    $odds = 0;

    for ($i=0; $i < count($coconuts); $i++) {
      if ($coconuts[$i] % 2 === 0) {
        $evens++;
      } else  {
        $odds++;
      }
    }

    return new self((int)$monkeyInfo[1], (int)$monkeyInfo[2], $evens, $odds);
  }
}