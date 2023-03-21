#!/usr/bin/env php
<?php

require_once "./common/Sort.php";
require_once "./common/TestCase.php";

if (!isset($argv[1])) {
  echo "\nPlease select a sort type by number or name:\n    1. direct\n\n";
  die;
}

if (!isset($argv[2]) || !is_numeric($argv[2])) {
  echo "\nPlease select a test case:\n    -3\n    - 50\n    - 100\n    - 200\n    - 400\n    - 600\n    - 800\n    - 900\n    - 1000\n\n\n";
  die;
}

$sort = Sort::validateFrom($argv[1]);
$testCase = TestCase::validateFrom((int)$argv[2]);

echo "\n----------------------------------\nSelected \n   sort:'{$sort->value}'\n   test case:'{$testCase->value}'\n----------------------------------\n\n";

require_once "./solutions/{$sort->value}.php";
require_once "./common/import_test_case.php";
require_once "./common/print_helper.php";

// retrieves test data from file
$testContent = import_request_variables($testCase->value);

$rounds = $testContent->rounds;
$monkeys = $testContent->monkeys;

$totalMonkeys = count($monkeys);
echo "\n----------------------------------\nRunning with \n   {$rounds} rounds\n   {$totalMonkeys} monkeys\n----------------------------------\n\n";

sortData($rounds, $monkeys);

// printResult($rounds, $monkeys);
printDescending($monkeys);