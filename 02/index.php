<?php

$convertedPlay = [
    "X" => "A",
    "Y" => "B",
    "Z" => "C",
];

$handResult = [
    "X" => 1,
    "Y" => 2,
    "Z" => 3,
    "A" => 1,
    "B" => 2,
    "C" => 3,
];

$roundResult = [
    "W" => 6,
    "L" => 0,
    "D" => 3,
    "X" => 0,
    "Y" => 3,
    "Z" => 6,
];

$resultLookup = [
    "A" => ["X" => "C", "Y" =>  "A", "Z" => "B"],
    "B" =>  ["X" => "A", "Y" =>  "B", "Z" => "C"],
    "C" =>  ["X" => "B", "Y" =>  "C", "Z" => "A"],
];

function determineResult($one, $two)
{
    global $convertedPlay;

    if ($one == $convertedPlay[$two]) {
        return "D";
    }

    if (($one == "A" && $two == "Y") || ($one == "B" && $two == "Z") || ($one == "C" && $two == "X")) {
        return "W";
    }

    return "L";
}

function determineResultQ2($one, $two)
{
    global $handResult, $roundResult, $resultLookup;

    return $handResult[$resultLookup[$one][$two]] + $roundResult[$two];
}

function run($inputFile)
{
    global $handResult, $roundResult;

    $totalScore = 0;
    $inputContent = fopen($inputFile, "r") or die("Unable to open file!");

    if ($inputContent) {
        while (($line = fgets($inputContent)) !== false) {
            list($one, $two) = explode(" ", trim($line));
            $result = determineResult($one, $two);
            $totalScore += $roundResult[$result] + $handResult[$two];
        }

        fclose($inputContent);
    }

    return $totalScore;
}

function runQ2($inputFile)
{
    $totalScore = 0;
    $inputContent = fopen($inputFile, "r") or die("Unable to open file!");

    if ($inputContent) {
        while (($line = fgets($inputContent)) !== false) {
            list($one, $two) = explode(" ", trim($line));
            $result = determineResultQ2($one, $two);
            $totalScore += $result;
        }

        fclose($inputContent);
    }

    return $totalScore;
}

print("Total score Q1: ");
print(run("input.txt"));

print("\n");

print("Total score Q2: ");
print(runQ2("input.txt"));
