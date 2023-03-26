<?php

require_once "./common/print_helper.php";
require_once "./common/helper_functions.php";

function sortData(int $rounds, array &$monkeys)
{
  // variable for storing monkey hierarchy (most to least coconuts) every round iteration
  $roundWinners = [];

  $lastRoundMonkeyCount = INF;
  $patternStart = -1;

  // stores only even/odd count for each monkey
  $monkeys = countEvensAndOdds($monkeys);

  // iterates over all rounds
  for ($i = 0; $i < $rounds; $i++) {

    // iterates over all monkeys
    for ($j = 0; $j < count($monkeys); $j++) {

      // sends even numbers to target monkey and resets current monkey even count
      sendEvens($monkeys, $j);
      // sends odd numbers to target monkey and resets current monkey odd count
      sendOdds($monkeys, $j);

    }

    // stores monkey hierarchy for current round iteration 
    $monkeysWithCoconuts = mapCoconutCount($monkeys);
    $currentRoundMonkeyCount = count($monkeysWithCoconuts);

    $roundWinner = array_search(max($monkeysWithCoconuts),$monkeysWithCoconuts);
    echo "round {$i} winner: {$roundWinner}\n";

    var_dump($roundWinners);

    if ($currentRoundMonkeyCount < $lastRoundMonkeyCount) {

      $lastRoundMonkeyCount = $currentRoundMonkeyCount;
      $patternStart++;
      $roundWinners[] = $roundWinner;

      continue;
    }

    if ($i === $patternStart + 1) {
      $roundWinners = [$roundWinners[$patternStart]];
    }

    echo "pattern start: {$patternStart}\n";
    $roundWinner = array_search(max($monkeysWithCoconuts),$monkeysWithCoconuts);
    $patternExists = array_search($roundWinner, $roundWinners);

    echo "pattern exists: {$patternExists}\n";
    
    if ($patternExists !== false) {
      $winnerMonkey = retrieveWinnerMonkey($rounds, $patternStart, $roundWinners);
      echo "Winner: Monkey {$winnerMonkey}\n";
      die;
    }

    $roundWinners[] = $roundWinner;
  }

}

function retrieveWinnerMonkey(int $rounds, int $patternStart, array &$roundWinners): int
{
  echo "pattern start position: {$patternStart}\n";

  $patternSize = count($roundWinners);
  echo "pattern size: {$patternSize}\n";

  // excludes rounds before pattern start
  $remainingRounds = $rounds - ($patternStart);

  echo "remaining rounds: {$remainingRounds}\n";

  // gets mod between remaining rounds and patter size
  $mod = $remainingRounds % $patternSize;
  echo "mod: {$mod}\n";

  // retrieves hierarchy corresponding to desired rounds 
  $finalWinner = $roundWinners[$mod - 1];

  echo "\n";
  return $finalWinner;
}