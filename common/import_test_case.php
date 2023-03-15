<?php

abstract class Monkey
{
  public function __construct(
    public int $evenPointer,
    public int $oddPointer,
  )
  { }

  abstract public function totalCoconuts(): int;
}

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
}

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
}

class TestContent
{
  public function __construct(
    public int $rounds,
    public array $monkeys
  )
  {}
}

function import_request_variables(int $caseFile): TestContent
{
  $caseFile = str_pad((string)$caseFile, 4, "0", STR_PAD_LEFT );
  $filepath = __DIR__ . "/../test-cases/caso{$caseFile}.txt";
  $content = file($filepath);

  $monkeys = [];
  $rounds = retrieveRoundsFromRow($content[0]);
  
  for ($i=1; $i < count($content); $i++) {
    $monkeys[] = createMonkeyObject($content[$i]);
  }

  return new TestContent($rounds, $monkeys);
}

function retrieveRoundsFromRow(string $row): int
{
  $words = explode(' ', $row);
  return (int)$words[1];
}

function createMonkeyObject(string $row): Monkey
{
  $sections = explode(':', $row);

  $monkeyInfo = retrieveNumbersFromString($sections[0]);
  $coconuts = retrieveNumbersFromString($sections[2]);

  return new CoconutMonkey((int)$monkeyInfo[1], (int)$monkeyInfo[2], $coconuts);
}

function retrieveNumbersFromString(string $source): array
{
  preg_match_all('/[0-9]+/', $source, $matches);
  return $matches[0];
}