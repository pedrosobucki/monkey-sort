<?php

require_once "import_test_case.php";

// retrieves test data from file
$testContent = import_request_variables();

$rounds = $testContent->rounds;
$monkeys = $testContent->monkeys;

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

  printInfo($rounds, $monkeys);

}

function printInfo(int $rounds, array $monkeys)
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