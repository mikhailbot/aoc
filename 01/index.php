<?php

function totalCalories($items)
{
    return array_sum($items);
}

function parseInput($inputFile)
{
    $elves = [];
    $elf = 0;
    $inputContent = fopen($inputFile, "r") or die("Unable to open file!");

    if ($inputContent) {
        while (($line = fgets($inputContent)) !== false) {
            if (!isset($elves[$elf])) {
                $elves[$elf] = array();
            }

            if (trim($line) != "") {
                array_push($elves[$elf], (int)$line);
            } else {
                $elf = $elf + 1;
            }
        }

        fclose($inputContent);
    }

    return $elves;
}

$groupedElves = parseInput("input.txt");
$calculatedTotals = array_map('totalCalories', $groupedElves);
rsort($calculatedTotals);

echo "The elf with the most calories is carrying " . $calculatedTotals[0] . " calories!";
echo "\n";
echo "The top 3 elves with the most calories are carrying " . array_sum(array_slice($calculatedTotals, 0, 3)) . " calories!";
