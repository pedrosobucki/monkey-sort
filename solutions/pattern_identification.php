<?php

require_once "./common/print_helper.php";
require_once "./common/helper_functions.php";

function sortData(int $rounds, array &$monkeys)
{
  $roundHierarchyList = [];

  // printResult($rounds, $monkeys);
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

    $roundHierarchy = sortMonkeysWithMostCoconuts($monkeys);
    $patternStart = array_search($roundHierarchy, $roundHierarchyList);

    if ($patternStart !== false) {
      $patternEnd = $i-1;
      
      $finalHierarchy = retrieveFinalMonkeyHierarchy($rounds, $patternStart, $patternEnd, $roundHierarchyList);

      printMonkeyHierarchy($finalHierarchy);
      die;
    }

    $roundHierarchyList[] = $roundHierarchy;
  }

}

function sortMonkeysWithMostCoconuts(array $monkeys): array
{
  for ($i = 0; $i < count($monkeys); $i++) {
    $totalCoconuts = $monkeys[$i]->totalCoconuts();

    if ($totalCoconuts > 0) {
      $monkeysScore[$i] = $totalCoconuts;
    }
  }
  
  arsort($monkeysScore, SORT_NUMERIC);

  return array_keys($monkeysScore);
}

function retrieveFinalMonkeyHierarchy(int $rounds, int $patternStart, int $patternEnd, array &$hierarchyList): array
{
  $remainingRounds = $rounds - ($patternStart - 1);
  $mod = $remainingRounds % ($patternEnd - $patternStart);

  $targetHierarchy = $mod + $patternStart;

  $finalHierarchy = $hierarchyList[$targetHierarchy];

  return $finalHierarchy;
}