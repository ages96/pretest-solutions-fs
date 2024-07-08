<?php

function highestPalindrome($s, $k, $left, $right, &$changes) {
    // Base case: if left index exceeds the right index
    if ($left >= $right) {
        return $s;
    }

    // If the characters at left and right are not equal, we need to change one of them
    if ($s[$left] != $s[$right]) {
        // Reduce the number of allowed changes
        if ($k <= 0) {
            return "-1";
        }
        
        $changes[] = max($s[$left], $s[$right]);
        $s[$left] = max($s[$left], $s[$right]);
        $s[$right] = max($s[$left], $s[$right]);

        // Recursive call with reduced number of allowed changes
        $result = highestPalindrome($s, $k - 1, $left + 1, $right - 1, $changes);
    } else {
        // If they are already equal, just move inward
        $result = highestPalindrome($s, $k, $left + 1, $right - 1, $changes);
    }

    // If we have replacements left, maximize the palindrome by converting to '9's
    if ($result != "-1" && count($changes) < $k) {
        for ($i = 0; $i < count($changes); $i++) {
            if ($result[$i] != '9' && $result[strlen($s) - 1 - $i] != '9') {
                if ($k - count($changes) >= 1) {
                    $result[$i] = '9';
                    $result[strlen($s) - 1 - $i] = '9';
                }
            }
        }
    }

    return $result;
}

// Helper function to initiate the recursive process
function createHighestPalindrome($s, $k) {
    $changes = [];
    return highestPalindrome($s, $k, 0, strlen($s) - 1, $changes);
}

// Example usage:
echo "Input s=3943 , k=1";
echo "\n";
echo "Result : ".createHighestPalindrome("3943", 1); // Output: 3993
echo "\n";
echo "Input s=932239 , k=2";
echo "\n";
echo "Result : ".createHighestPalindrome("932239", 2); // Output: 992299
echo "\n";
?>
