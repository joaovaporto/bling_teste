<?php

require_once("./quicksort.php");
require_once("./quicksort_decrescent.php");
require_once("Date.php");

/**
 * Rotates a array to right based on a given offset.
 * @param array $array to be rotated.
 * @param int $offset to rotate array.
 * @return array the array rotated.
 */
function rotate_to_right($array, $offset) {
    $array_rotated = [];
    $array_size = sizeof($array);

    foreach ($array as $key => $value) {
        $key_rotated = ($key + $offset) % $array_size;
        $array_rotated[$key_rotated] = $value;
    }

    return $array_rotated;
}

function extract_evens($array) {
    $evens = [];
    foreach ($array as $value) {
        $value_is_even = ($value % 2) === 0;
        if ($value_is_even) {
            $evens[] = $value;
        }
    }

    return $evens;
}

function extract_odds($array) {
    $odds = [];
    foreach ($array as $value) {
        $value_is_odd = ($value % 2) !== 0;
        if ($value_is_odd) {
            $odds[] = $value;
        }
    }

    return $odds;
}

function sort_even_crescent_odd_decrescent($array) {
    $evens = extract_evens($array);
    $odds = extract_odds($array);
    $sorted_evens = quicksort($evens);
    $sorted_odds = quicksort_decrescent($odds);
    $sorted_even_crescent_odd_decrescent = array_merge($sorted_evens, $sorted_odds);
    return $sorted_even_crescent_odd_decrescent;
}

function combine2($array) {
    $combinations = [];
    $array_last_index = sizeof($array) - 1;

    for ($i = 0; $i < $array_last_index; $i++) {
        for ($j = $i + 1; $j <= $array_last_index; $j++) {
            $combinations[] = [$array[$i], $array[$j]];
        }
    }

    return $combinations;
}

function combine($array, $p) {
    if ($p === 2) {
        return combine2($array);
    }

    $combinations = [];
    $array_last_index = sizeof($array) - 1;

    for ($i = 0; $i <= (sizeof($array) - $p); $i++) {
        $array2 = array_slice($array, $i+1, $array_last_index);
        $subcombs = combine($array2, $p-1);

        foreach ($subcombs as $subcomb) {
            array_unshift($subcomb, $array[$i]);
            $combinations[] = $subcomb;
        }
    }

    return $combinations;
}

function get_min_value($array) {
    $array = quicksort($array);
    $min_value = $array[0];
    return $min_value;
}

function get_triangles($array) {
    $triangles = [];
    if (sizeof($array) < 3) {
        return $triangles;
    }

    $combinations = combine($array, 3);
    foreach($combinations as $combination) {
        $sorted_comb = quicksort($combination);
        $comb_is_triangle = $sorted_comb[0] + $sorted_comb[1] > $sorted_comb[2];

        if ($comb_is_triangle) {
            $triangles[] = $combination;
        }
    }

    return $triangles;
}

function contains($string, $substring) {
    $string = str_split($string);
    $substring = str_split($substring);

    for ($i = 0; $i < sizeof($string); $i++) {
        if ((sizeof($string) - $i) < sizeof($substring)) {
            break;
        }
        
        for ($j = 0; $j < sizeof($substring); $j++) {
            if ($substring[$j] !== $string[$i + $j]) {
                break;
            }
        }

        if ($j === sizeof($substring)) {
            return true;
        }
    }

    return false;
}

// print_r(rotate_to_right([1,2,3,4,5,6], 2));
// print_r(sort_even_crescent_odd_decrescent([6,5,4,3,2,1]));
// print_r(Date::calc_date_diff_in_days("03/04/1998", "27/10/2021"));
// print_r(Date::calc_date_diff_in_days("03/04/1998", "27/10/1998"));
// print_r(Date::calc_date_diff_in_days("27/10/2021", "03/04/1998"));
// print_r(combine2([1,2,3,4,5,6]));
// print_r(combine([1,2,3,4,5,6], 3));
// print_r(get_triangles([1,2,3,4]));
// print_r(get_triangles([1,2,3,4,5,6]));
// print_r(contains("amarelo", "amak"));
// print_r(contains("amarelo", "amar"));
// print_r(contains("amarelo", "amaro"));
// print_r(contains("amarelo", "o"));
print_r(contains("amarelo", "b"));