<?php

class Monkey
{
  public function __construct(
    public int $evenPointer,
    public int $oddPointer,
    public array $coconuts
  )
  {}
}

class TestContent
{
  public function __construct(
    public int $rounds,
    public array $monkeys
  )
  {}
}

function import_request_variables(): TestContent
{
  $filepath = __DIR__ . '/../test-cases/caso0050.txt';
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


  return new Monkey((int)$monkeyInfo[1], (int)$monkeyInfo[2], $coconuts);
}

function retrieveNumbersFromString(string $source): array
{
  preg_match_all('/[0-9]+/', $source, $matches);
  return $matches[0];
}