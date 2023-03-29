<?php

class TestContent
{
  public function __construct(
    public int $rounds,
    public array $monkeys
  )
  {}
}

function retrieveRoundsFromRow(string $row): int
{
  $words = explode(' ', $row);
  return (int)$words[1];
}

function import_request_variables(string $monkeyType, int $caseFile): TestContent
{
  $caseFile = str_pad((string)$caseFile, 4, "0", STR_PAD_LEFT );
  $filepath = __DIR__ . "/../../test-cases/caso{$caseFile}.txt";
  $content = file($filepath);

  $monkeys = [];
  $rounds = retrieveRoundsFromRow($content[0]);
  
  for ($i=1; $i < count($content); $i++) {
    $monkeys[] = $monkeyType::createMonkeyObject($content[$i]);
  }

  return new TestContent($rounds, $monkeys);
}