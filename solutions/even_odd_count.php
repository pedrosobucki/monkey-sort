<?php

require_once "./common/print_helper.php";

function sortData(int $rounds, array $monkeys)
{
  // iterates over all rounds
  for ($i = 0; $i < $rounds; $i++) {

    // iterates over all monkeys
    for ($j = 0; $j < count($monkeys); $j++) {

      // stores current monkey
      $monkey = $monkeys[$j];
      $coconutCount = count($monkey->coconuts);

      // iterates over monkeys's coconuts
      for ($k = 0; $k < $coconutCount; $k++) {

        // stores current coconut
        $coconut = $monkey->coconuts[$k];

        // action if coconut has even pebble number
        if ($coconut % 2 === 0) {
          // sends coconut to monkey
          $monkeys[$monkey->evenPointer]->coconuts[] = $coconut;
          //removes coconut from current monkey
          unset($monkeys[$j]->coconuts[$k]);
        } 
        // action if coconut has odd pebble number
        else {
          // sends coconut to monkey
          $monkeys[$monkey->oddPointer]->coconuts[] = $coconut;
          //removes coconut from current monkey
          unset($monkeys[$j]->coconuts[$k]);
        }
        
      }
      
      // rearange array indexes
      $monkeys[$j]->coconuts = array_values($monkeys[$j]->coconuts);
    }

    // printCompleteInfo($rounds, $monkeys);

  }
}

function countEvensAndOdds(array $monkeys): array
{
  $countedMonkeys = [];

  for ($i=0; $i < count($monkeys); $i++) {

    $newMonkey = new Monkey($monkeys[$i]->evenPointer, $monkeys[$i]->oddPointer);

    for ($j=0; $j < count($monkeys[$i]->coconuts); $j++) {
      if ($monkeys[$i]->coconuts[$j] % 2 === 0) {
        $newMonkey->evens++;
      } else {
        $newMonkey->odds++;
      }
    }

    $countedMonkesy[$i] = $newMonkey;
  }

  return $countedMonkeys;
}