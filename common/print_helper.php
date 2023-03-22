<?php

require_once "./common/Sort.php";
require_once "./common/TestCase.php";

function printSortOptions(): void
{
  echo "\nPlease select a sort type by number or name:\n";
  foreach (Sort::cases() as $sort) { 
    echo "    {$sort->number()}. {$sort->value}\n";
  }
  echo "\n";
}

function printTestCaseOptions(): void
{
  echo "\nPlease select a test case:\n";
  foreach (TestCase::cases() as $testCase) { 
    echo "    -{$testCase->value}\n";
  }
  echo "\n\n";
}

function printCompleteInfo(int $rounds, array $monkeys): void
{
  $roundInfo = "rounds: {$rounds}";

  $winner = 0;
  $monkeysInfo = "";

  for ($i = 0; $i < count($monkeys); $i++) {

    if ($monkeys[$i]->totalCoconuts() > $monkeys[$winner]->totalCoconuts()) {
      $winner = $i;
    }

    $coconuts = implode(', ', $monkeys[$i]->coconuts);
    $monkeysInfo .= "Monkey {$i}: {$coconuts}\n";
  }

  $winnerInfo = "Winner: Monkey {$winner}";

  echo "{$roundInfo}\n\n{$monkeysInfo}\n{$winnerInfo}\n";
}

function printResult(int $rounds, array $monkeys): void
{
  $roundInfo = "rounds: {$rounds}";

  $winner = 0;
  $monkeysInfo = "";

  for ($i = 0; $i < count($monkeys); $i++) {

    if ($monkeys[$i]->totalCoconuts() > $monkeys[$winner]->totalCoconuts()) {
      $winner = $i;
    }

    $monkeysInfo .= "Monkey {$i}: {$monkeys[$i]->totalCoconuts()}\n";
  }

  $winnerInfo = "Winner: Monkey {$winner}";

  echo "{$roundInfo}\n\n{$monkeysInfo}\n{$winnerInfo}\n";
}

function printDescending(array $monkeys): void
{
  $monkeysInfo = "";
  $monkeysScore = [];

  for ($i = 0; $i < count($monkeys); $i++) {
    $totalCoconuts = $monkeys[$i]->totalCoconuts();

    if ($totalCoconuts > 0) {
      $monkeysScore[$i] = $totalCoconuts;
    }
  }

  $remainingMonkeys = count($monkeysScore);
  $monkeysInfo .= "Total remaining monkeys: {$remainingMonkeys}\n\n";
  
  arsort($monkeysScore, SORT_NUMERIC);

  foreach ($monkeysScore as $i => $totalCoconuts) {
    $monkeysInfo .= "Monkey {$i}: {$totalCoconuts}\n";
  }

  echo "{$monkeysInfo}\n";
}