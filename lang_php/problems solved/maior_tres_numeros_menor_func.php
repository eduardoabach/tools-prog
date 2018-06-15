<?php
// retorne o maior numero, 3 operacoes, passa sempre por 2
function test($a, $b, $c){
	if($a > $b){
		if($a > $c)
			return $a;
		else return $c;
	} else {
		if($b > $c)
			return $b;
		else return $c;
	}
}

// retorne o maior numero, 2 operacoes, passa sempre por 2, 1 var
function test($a, $b, $c){
	$test = ($a > $b) ? $a : $b;
	return ($test > $c) ? $test : $c;
}


// retorne o maior numero, 2 operacoes, passa sempre por 2, 0 novas var
function test($a, $b, $c){
	return ($c > (($a > $b) ? $a : $a=$b) ) ? $c : $a;
}