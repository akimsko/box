<?php
$testOutput = file_get_contents('tests.out');

preg_match('/^OK \(([^\)]+)\)/m', $testOutput, $matches);
list($tests, $assertions) = explode(', ', $matches[1]);

preg_match('/^\s*Summary:\s*\n\s*([^\n]+)\n\s+([^\n]+)\n\s+([^\n]+)/ms', $testOutput, $matches);
$classes = $matches[1];
$methods = $matches[2];
$lines   = $matches[3];

preg_match('/^Code Coverage Report\s*\n\s*([^\n]+)\n/ms', $testOutput, $matches);
$timestamp = $matches[1];

$report = <<<TEMPLATE
Test report
===========

_Timestamp:_ $timestamp

Summary:
--------
  * $tests
  * $assertions

Coverage:
---------
  * $classes
  * $methods
  * $lines

TEMPLATE;

file_put_contents('Test-report.md', $report);
