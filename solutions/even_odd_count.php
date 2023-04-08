<?php

require_once "./common/print_helper.php";
require_once "./common/helper_functions.php";

function sortData(int $rounds, array &$monkeys)
{
  $monkeyCount = count($monkeys);

  // iterates over all rounds
  for ($i = 0; $i < $rounds; $i++) {

    // iterates over all monkeys
    for ($j = 0; $j < $monkeyCount; $j++) {
      
      // // sends even numbers to target monkey and resets current monkey even count
      $monkeys[$monkeys[$j]->evenPointer]->evens += $monkeys[$j]->evens;
      $monkeys[$j]->evens = 0;
      
      // // sends odd numbers to target monkey and resets current monkey odd count
      $monkeys[$monkeys[$j]->oddPointer]->odds += $monkeys[$j]->odds;
      $monkeys[$j]->odds = 0;

    }

  }

}