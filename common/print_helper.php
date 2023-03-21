<?php

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

  arsort($monkeysScore, SORT_NUMERIC);

  foreach ($monkeysScore as $i => $totalCoconuts) {
    $monkeysInfo .= "Monkey {$i}: {$totalCoconuts}\n";
  }

  echo "{$monkeysInfo}\n";
}