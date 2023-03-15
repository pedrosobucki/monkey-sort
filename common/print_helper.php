<?php

function printCompleteInfo(int $rounds, array $monkeys)
{
  $roundInfo = "rounds: {$rounds}";

  $winner = 0;
  $monkeysInfo = "";

  for ($i = 0; $i < count($monkeys); $i++) {

    if (count($monkeys[$i]->coconuts) > count($monkeys[$winner]->coconuts)) {
      $winner = $i;
    }

    $coconuts = implode(', ', $monkeys[$i]->coconuts);
    $monkeysInfo .= "Monkey {$i}: {$coconuts}\n";
  }

  $winnerInfo = "Winner: Monkey {$winner}";

  echo "{$roundInfo}\n\n{$monkeysInfo}\n{$winnerInfo}\n";
}

function printResult(int $rounds, array $monkeys)
{
  $roundInfo = "rounds: {$rounds}";

  $winner = 0;
  $monkeysInfo = "";

  for ($i = 0; $i < count($monkeys); $i++) {

    if (count($monkeys[$i]->coconuts) > count($monkeys[$winner]->coconuts)) {
      $winner = $i;
    }

    $coconuts = count($monkeys[$i]->coconuts);
    $monkeysInfo .= "Monkey {$i}: {$coconuts}\n";
  }

  $winnerInfo = "Winner: Monkey {$winner}";

  echo "{$roundInfo}\n\n{$monkeysInfo}\n{$winnerInfo}\n";
}