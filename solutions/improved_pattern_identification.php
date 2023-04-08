<?php

require_once "./common/print_helper.php";
require_once "./common/helper_functions.php";

function sortData(int $rounds, array &$monkeys)
{
  // variable for storing monkey hierarchy (most to least coconuts) every round iteration
  $roundWinners = [];

  $lastRoundMonkeyCount = INF;
  $patternStart = -1;

  // iterates over all rounds
  for ($i = 0; $i < $rounds; $i++) {

    // iterates over all monkeys
    for ($j = 0; $j < count($monkeys); $j++) {

      // // sends even numbers to target monkey and resets current monkey even count
      $monkeys[$monkeys[$j]->evenPointer]->evens += $monkeys[$j]->evens;
      $monkeys[$j]->evens = 0;
      
      // // sends odd numbers to target monkey and resets current monkey odd count
      $monkeys[$monkeys[$j]->oddPointer]->odds += $monkeys[$j]->odds;
      $monkeys[$j]->odds = 0;

    }

    // creates array containing only mokneys with coconuts != 0 and stores array length
    $monkeysWithCoconuts = mapCoconutCount($monkeys);
    $currentRoundMonkeyCount = count($monkeysWithCoconuts);

    // searches for monkey with most coconuts in current round
    $roundWinner = array_search(max($monkeysWithCoconuts),$monkeysWithCoconuts);

    // checks if the number of monkeys with more than 0 coconuts has decresed from past round and, if so
    if ($currentRoundMonkeyCount < $lastRoundMonkeyCount) {

      // replaces 'last round count' for 'current count' for next loop iteration
      $lastRoundMonkeyCount = $currentRoundMonkeyCount;

      // increments controll variable for array position in which the pattern starts (will start when the quantity of 
      // monkeys with more than 0 coconuts does not chage from 1 round to the next )
      $patternStart++;

      // sotres current round winner in array
      $roundWinners[] = $roundWinner;

      continue;
    }

    // if last and current round quantity of monkeys with more than 1 coconut are equal
    // AND this is the round right after the pattern has started:
    if ($i === $patternStart + 1) {
      // leaves only 'pattern start' round winner monkeys in pattern list
      $roundWinners = [$roundWinners[$patternStart]];
    }

    // checks if current round winner has already appeared in pattern (found the end of the pattern)
    $patternExists = array_search($roundWinner, $roundWinners);
    
    // if pattern exists:
    if ($patternExists !== false) {

      // retrieves winner monkey
      $winnerMonkey = retrieveWinnerMonkey($rounds, $patternStart, $roundWinners);

      // prints information to screen
      echo "Winner: Monkey {$winnerMonkey}\n";
      die;
    }

    // stores round winner in array if pattern was not found
    $roundWinners[] = $roundWinner;
  }

}

function retrieveWinnerMonkey(int $rounds, int $patternStart, array &$roundWinners): int
{
  echo "pattern start position: {$patternStart}\n";

  // calculates pattern size
  $patternSize = count($roundWinners);
  echo "pattern size: {$patternSize}\n";

  // excludes total rounds before pattern start
  $remainingRounds = $rounds - ($patternStart);
  echo "remaining rounds: {$remainingRounds}\n";

  // gets mod between remaining rounds and patter size
  $mod = ($remainingRounds - 1) % $patternSize;
  echo "mod: {$mod}\n";

  // winner monkey from pattern position 
  $finalWinner = $roundWinners[$mod];
  echo "\n";
  
  return $finalWinner;
}