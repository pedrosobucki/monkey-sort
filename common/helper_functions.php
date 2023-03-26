<?php

function countEvensAndOdds(array $monkeys): array
{
  $countedMonkeys = [];

  // iterates over complete monkey list
  for ($i=0; $i < count($monkeys); $i++) {

    // crates new monkey object, containing even/odd coconut count only
    $newMonkey = new EvenOddMonkey($monkeys[$i]->evenPointer, $monkeys[$i]->oddPointer);

    // iterates over all monkey's coconuts
    for ($j=0; $j < $monkeys[$i]->totalCoconuts(); $j++) {

      // increments even/odd monkey coconut counter according to current coconut examined
      if ($monkeys[$i]->coconuts[$j] % 2 === 0) {
        $newMonkey->evens++;
      } else {
        $newMonkey->odds++;
      }
    }

    // adds new monkey object to array
    $countedMonkeys[$i] = $newMonkey;
  }

  // returns array containing only monkeys's even/odd coconut count
  return $countedMonkeys;
}

function sendEvens(array $monkeys, int $giving)
{
  $monkeys[$monkeys[$giving]->evenPointer]->evens += $monkeys[$giving]->evens;
  $monkeys[$giving]->evens = 0;
}

function sendOdds(array $monkeys, int $giving)
{
  $monkeys[$monkeys[$giving]->oddPointer]->odds += $monkeys[$giving]->odds;
  $monkeys[$giving]->odds = 0;
}

function mapCoconutCount(array $monkeys): array
{
  // stores coconut count for monkeys with more than 0 coconuts total
  for ($i = 0; $i < count($monkeys); $i++) {
    $totalCoconuts = $monkeys[$i]->totalCoconuts();

    if ($totalCoconuts > 0) {
      $monkeysScore[$i] = $totalCoconuts;
    }
  }

  return $monkeysScore;
}

function sortMonkeysWithMostCoconuts(array $monkeysScore): array
{ 
  // sorts monkeys from most to least coconuts
  arsort($monkeysScore, SORT_NUMERIC);

  // returns list with ordered monkeys
  return array_keys($monkeysScore);
}