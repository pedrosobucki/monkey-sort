<?php

$rounds = (int)$argv[1];
$monkeys = (int)$argv[2];

$totalCoconuts = 0;
$fileContent = "Fazer {$rounds} rodadas\n";
$winnerMonkey = 0;
$winnerCoconuts = 0;

for ($i=0; $i<$monkeys; $i++) {
  $coconutCount = rand(1, 500);
  $totalCoconuts += $coconutCount;

  if ($coconutCount > $winnerCoconuts) {
    $winnerCoconuts = $coconutCount;
    $winnerMonkey = $i;
  }

  // monkey sends coconuts to previous monkey in round order
  $target = ($i===0) ? $monkeys-1 : $i-1;

  // // monkey sends coconuts to next monkey in round order
  // $target = ($i===$monkeys-1) ? 0 : $i+1;

  $fileContent .= "Macaco {$i} par -> {$target} impar -> {$target} : {$coconutCount} :";

  for ($j=0; $j<$coconutCount; $j++) {
    $coconut = rand(1, 999999);
    $fileContent .= " {$coconut}";
  }

  $fileContent .= "\n";
}

$result = file_put_contents('test-cases/caso0000.txt', $fileContent);

if (is_numeric($result)) {
  echo "Success!\n------------------\n";
  echo "Total coconuts: {$totalCoconuts}\n";
  echo "Monkey with highest coconut count: Monkey {$winnerMonkey} with {$winnerCoconuts}\n";
}