<?php

function quicksort($list){
    return (count($list) <= 1) ? $list : array_merge( 
        quicksort( array_filter($list, function($item) use ($list) { return $item < current($list); } ) ), 
        [ current($list) ], 
        quicksort( array_filter($list, function($item) use ($list) { return $item > current($list); } ) )
    );
}

function quicksort_min($l){
    return (count($l) <= 1) ? $l : array_merge( quicksort( array_filter($l, function($it) use ($l) { return $it < current($l); } ) ), [ current($l) ], quicksort( array_filter($l, function($it) use ($l) { return $it > current($l); } ) ) );
}


//$arr = [9, 8, 7, 6, 5, 4, 3, 2, 1];
$arr = [5,99,2,45,12,234,29,0];

print('test quicksort:');
print_r($arr);

print_r(quicksort($arr));
print_r(quicksort_min($arr));

// O resultado deve ser igual ao efeito da function sort
sort($arr, SORT_NUMERIC);
print_r($arr);