<?php

function multiplos_5($val){
        $logVal = log($val, 5);
        return (!(strval($logVal) != strval(intval($logVal))) && $logVal > 0); // numero inteiro e maior que zero
}

$array1 = array("a" => 1, "b" => 2, "c" => 3, "d" => 4, "e" => 5);
print_r(array_filter($array1, "multiplos_5"));

print_r(array_filter($array1, function($k) {
        return $k == 2;
}));

?>