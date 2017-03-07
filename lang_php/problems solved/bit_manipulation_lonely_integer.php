<?php

$handle = fopen ("php://stdin","r");
fscanf($handle,"%d",$n);
$a_temp = fgets($handle);
$a = explode(" ",$a_temp);
array_walk($a,'intval');

//Em uma lista de números, ocorrem sempre em pares em exceção de apenas um número único.
//Ex1: 1 1 2
//Ex2: 0 0 1 2 1
//Ex3: 59 88 14 8 85 1 94 74 57 96 39 2 47 43 35 17 53 52 92 31 99 48 94 30 92 60 32 45 88 13 39 50 22 65 89 46 65 76 57 67 99 35 76 46 85 82 45 62 53 80 74 22 31 52 82 13 41 96 2 1 80 62 4 20 50 89 59 67 60 8 41 14 47 48 17 4 43 30 32


$unicoList = '';
for($i = 0; $i < $n; $i++){

	//espaço em branco para identificar números separadamente.
    $strAjust = ' '.$a[$i].' '; 
    
    if(strpos($unicoList, $strAjust) === false){
        $unicoList .= $strAjust;
    } else {
    	// caso exista remove o item existente
        $unicoList = str_replace($strAjust, '', $unicoList); 
    }
}

// simples trim para retirar espaços em branco
echo trim($unicoList); 
?>
