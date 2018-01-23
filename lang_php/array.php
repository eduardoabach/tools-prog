<?php

//array_column ( array $input , mixed $column_key [, mixed $index_key = null ] )
$records = array(
    array(
        'id' => 2135,
        'first_name' => 'John',
        'last_name' => 'Doe',
    ),
    array(
        'id' => 3245,
        'first_name' => 'Sally',
        'last_name' => 'Smith',
    ),
    array(
        'id' => 5342,
        'first_name' => 'Jane',
        'last_name' => 'Jones',
    ),
    array(
        'id' => 5623,
        'first_name' => 'Peter',
        'last_name' => 'Doe',
    )
);

$first_names = array_column($records, 'first_name');
print_r($first_names);

// Array
// (
//     [0] => John
//     [1] => Sally
//     [2] => Jane
//     [3] => Peter
// )

$last_names = array_column($records, 'last_name', 'id');
print_r($last_names);

// Array
// (
//     [2135] => Doe
//     [3245] => Smith
//     [5342] => Jones
//     [5623] => Doe
// )

// End, move ponteiro para o último registro
$frutas = array('melancia', 'banana', 'morango');
echo end($frutas); // morango

//array_key_exists($item,$list); boolean
//array_search($item, $list); key do primeiro item encontrado
//array_keys($list, $item);  array com lista com todas as possibilidades



?>