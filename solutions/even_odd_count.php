<?php

require_once "./common/print_helper.php";

function sortData(int $rounds, array &$monkeys)
{
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

  }

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