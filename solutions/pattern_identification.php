<?php

require_once "./common/print_helper.php";
require_once "./common/helper_functions.php";

function sortData(int $rounds, array &$monkeys)
{
  // variable for storing monkey hierarchy (most to least coconuts) every round iteration
  $roundHierarchyList = [];

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
    $roundHierarchy = sortMonkeysWithMostCoconuts($monkeys);

    // returns index of pattern start if current round hierarchy has already occured
    $patternStart = array_search($roundHierarchy, $roundHierarchyList);

    // checks if a pattern was found
    if ($patternStart !== false) {

      // pattern ending index is equal to previous round
      $patternEnd = $i-1;
      
      // finds hierarchy corresponding to desired rounds 
      $finalHierarchy = retrieveFinalMonkeyHierarchy($rounds, $patternStart, $patternEnd, $roundHierarchyList);

      printMonkeyHierarchy($finalHierarchy);
      die;
    }

    $roundHierarchyList[] = $roundHierarchy;
  }

}

function sortMonkeysWithMostCoconuts(array $monkeys): array
{
  // stores coconut count for monkeys with more than 0 coconuts total
  for ($i = 0; $i < count($monkeys); $i++) {
    $totalCoconuts = $monkeys[$i]->totalCoconuts();

    if ($totalCoconuts > 0) {
      $monkeysScore[$i] = $totalCoconuts;
    }
  }
  
  // sorts monkeys from most to least coconuts
  arsort($monkeysScore, SORT_NUMERIC);

  // returns list with ordered monkeys
  return array_keys($monkeysScore);
}

function retrieveFinalMonkeyHierarchy(int $rounds, int $patternStart, int $patternEnd, array &$hierarchyList): array
{
  // excludes rounds before pattern start
  $remainingRounds = $rounds - ($patternStart - 1);

  // gets mod between remaining rounds and patter size
  $mod = $remainingRounds % ($patternEnd - $patternStart);

  // finds round with desired hierarchy
  $targetHierarchy = $mod + $patternStart;

  // retrieves hierarchy corresponding to desired rounds 
  $finalHierarchy = $hierarchyList[$targetHierarchy];

  return $finalHierarchy;
}