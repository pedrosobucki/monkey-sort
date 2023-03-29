#!/usr/bin/env php
<?php

require_once "./common/Sort.php";
require_once "./common/TestCase.php";
require_once "./common/print_helper.php";

if (!isset($argv[1])) {
  printSortOptions();
  die;
}

if (!isset($argv[2]) || !is_numeric($argv[2])) {
  printTestCaseOptions();
  die;
}

$sort = Sort::validateFrom($argv[1]);
$testCase = TestCase::validateFrom((int)$argv[2]);

echo "\n----------------------------------\nSelected \n   sort:'{$sort->value}'\n   test case:'{$testCase->value}'\n----------------------------------\n\n";

require_once "./solutions/{$sort->value}.php";
require_once "./common/import/import_test_case.php";
require_once "./common/print_helper.php";

// retrieves test data from file
$testContent = import_request_variables($sort->monkeyType(), $testCase->value);

$rounds = $testContent->rounds;
$monkeys = $testContent->monkeys;

$totalMonkeys = count($monkeys);
echo "\n----------------------------------\nRunning with \n   {$rounds} rounds\n   {$totalMonkeys} monkeys\n----------------------------------\n\n";

sortData($rounds, $monkeys);

// printResult($rounds, $monkeys);
// printDescending($monkeys);
printWinner($monkeys);