<?php

function isBalanced($s) {
    $stack = [];
    $bracketPairs = [
        ')' => '(',
        ']' => '[',
        '}' => '{'
    ];

    $length = strlen($s);

    for ($i = 0; $i < $length; $i++) {
        $char = $s[$i];
        // Skip whitespace characters
        if (ctype_space($char)) {
            continue;
        }

        // If it is an opening bracket, push to stack
        if (in_array($char, ['(', '[', '{'])) {
            array_push($stack, $char);
        } elseif (isset($bracketPairs[$char])) { // It is a closing bracket
            if (empty($stack) || array_pop($stack) !== $bracketPairs[$char]) {
                return "NO";
            }
        }
    }

    // If stack is not empty, then brackets are not balanced
    return empty($stack) ? "YES" : "NO";
}

// Example usage:
echo "Input : { [ ( ) ] }";
echo "\n";
echo "Result : ".isBalanced("{ [ ( ) ] }"); // Output: YES
echo "\n";
echo "Input : { [ ( ] ) }";
echo "\n";
echo "Result : ".isBalanced("{ [ ( ] ) }"); // Output: NO
echo "\n";
echo "Input : { ( ( [ ] ) [ ] ) [ ] }";
echo "\n";
echo "Result : ".isBalanced("{ ( ( [ ] ) [ ] ) [ ] }"); // Output: YES
echo "\n";
?>
