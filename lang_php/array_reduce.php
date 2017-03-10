<?php
function soma_total($total, $val){
        return $total + $val;
}

$array1 = array("a" => 1, "b" => 2, "c" => 3, "d" => 4, "e" => 5);
$valTotalArr = array_reduce($array1, "soma_total");
print_r($valTotalArr);
?>