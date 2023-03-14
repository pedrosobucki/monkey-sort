<?php

require_once "import_test_case.php";

// retrieves test data from file
$testContent = import_request_variables();

$rounds = $testContent->rounds;
$monkeys = $testContent->monkeys;

$rounds = 1;

// iterates over all rounds
for ($i = 0; $i < $rounds; $i++) {

  // iterates over all monkeys
  for ($j = 0; $j < count($monkeys); $j++) {

    // stores current monkey
    $monkey = $monkeys[$j];

    // iterates over monkeys's coconuts
    for ($k = 0; $k < count($monkey->coconuts); $k++) {

      // stores current coconut
      // var_dump("coconuts",count($monkey->coconuts));
      // var_dump("index", $k);
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

  }

}

// var_dump($monkeys);
// die;