<?php
$handle = fopen ('php://stdin','r');
fscanf($handle,'%d %d',$n,$k);
$a_temp = fgets($handle);
$arr = explode(' ',$a_temp);
array_walk($arr,'intval');

$arr2 = $arr;
for($i=0;$i < count($arr);$i++){
    # Usa princípio da matemática modular
    # o resto da divisão entre ($i + $k) % count($arr)
    $novo_i = (($i + $k) % count($arr));
    $arr2[$i] = $arr[$novo_i];	
}

/*
// #1, com left e right rotation
$diffDist = $n - $k;
if($diffDist < $k){
    for($i=0;$i < $diffDist;$i++){
        array_unshift($arr, array_pop($arr));
    }
} else {
    for($i=0;$i < $k;$i++){
        $arr[] = array_shift($arr);
    }
}
*/

/*
//#2
for($i=0; $i<$k; $i++){
    $arr[] = array_shift($arr);
}
*/

/*
//#3
for($i=0;$i < $k;$i++){
	$keys = array_keys($arr);
	$val = $arr[$keys[0]];
	unset($arr[$keys[0]]);
	$arr[] = $val;
}
*/

/*
//#4
for($i=0; $i<$k; $i++){
    list($kFirst) = array_keys($arr);
	$val = $arr[$kFirst];
	unset($arr[$kFirst]);
	$arr[$kFirst] = $val;
}
*/

//echo implode(' ', $arr);
foreach($arr as $aItem){
    echo $aItem.' ';
}

?>