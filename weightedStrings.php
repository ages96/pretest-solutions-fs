<?php

function getCharWeight($char) {
    return ord($char) - ord('a') + 1;
}

function getWeightedStrings($s, $queries) {
    $weights = [];
    $length = strlen($s);
    $i = 0;

    while ($i < $length) {
        $currentChar = $s[$i];
        $weight = getCharWeight($currentChar);
        $count = 1;

        while ($i + 1 < $length && $s[$i + 1] == $currentChar) {
            $count++;
            $i++;
            $weight += getCharWeight($currentChar);
            $weights[$weight] = true;
        }

        $weights[getCharWeight($currentChar)] = true;
        $i++;
    }

    $results = [];
    foreach ($queries as $query) {
        if (isset($weights[$query])) {
            $results[] = "Yes";
        } else {
            $results[] = "No";
        }
    }

    return $results;
}

// Example usage:
$string = "abbcccd";
$queries = [1, 3, 9, 8];

echo "Input : ".$string;
echo "\n";
echo "Query : ".json_encode($queries);
echo "\n";
echo "Result : ";
echo "\n";
$result = getWeightedStrings($string, $queries);

print_r($result);  // Output: Array ( [0] => Yes [1] => Yes [2] => Yes [3] => No )
?>