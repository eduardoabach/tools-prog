<?php

// Ex: 1.254,23 ou 1254,23
function is_number_user($value){
   return preg_match('/^(-)?([0-9]{1,3})(\.*[0-9]{3})*(\,[0-9]{1,}){0,1}$/', $value);
}

// Ex: 1254.23
function is_number_db($value){
   return preg_match('/(^|-)\d*[0-9](\.\d*[0-9])?$/', $value);
}

function number_to_user($number, $decimals = 2, $default = 0){
	if(!is_null($number)){
		$valida = is_number_db($number);
		if(!$valida){
			if($default == ''){
		   		return $default;
			}
			$number = $default;
		}
	}

	return number_format($number, $decimals, ',', '.');
}

function number_to_db($number, $default = 0){
	if (!is_number_user($number)) {
		return $default;
	}

	return str_replace(',', '.', str_replace('.', '', trim($number)));
}

function mask_zero($valor, $qtd = 10){
	return str_pad($valor, $qtd, "0", STR_PAD_LEFT);
}

function get_apenas_numeros($value, $default = false){
	$value = preg_replace('/[^0-9]/', '', $value);

	if (!strlen($value)) {
		if ($default !== false) {
			return $default;
		}

		return false;
	}

	return $value;
}

function byte_to_human($numByte){
	if ($numByte < 1024) {
		return $numByte . " bytes";
	  
	} else if ($numByte < (1024 * 1024)) {
		$numByte = round($numByte / 1024, 1);
		return $numByte . " KB";

	} else if ($numByte < (1024 * 1024 * 1024)) {
		$numByte = round($numByte / (1024 * 1024), 1);
		return $numByte . " MB";

	} else {
		$numByte = round($numByte / (1024 * 1024 * 1024), 1);
		return $numByte . " GB";
	}
}

function get_moeda_extenso($number){
	if (!is_numeric($number)):
		return false;
	endif;

	$singular = array('centavo', 'real', 'mil', 'milhão', 'bilhão', 'trilhão', 'quatrilhão');
	$plural   = array('centavos', 'reais', 'mil', 'milhões', 'bilhões', 'trilhões', 'quatrilhões');

	$c   = array('', 'cem', 'duzentos', 'trezentos', 'quatrocentos', 'quinhentos', 'seiscentos', 'setecentos', 'oitocentos', 'novecentos');
	$d   = array('', 'dez', 'vinte', 'trinta', 'quarenta', 'cinquenta', 'sessenta', 'setenta', 'oitenta', 'noventa');
	$d10 = array('dez', 'onze', 'doze', 'treze', 'quatorze', 'quinze', 'dezesseis', 'dezesete', 'dezoito', 'dezenove');
	$u   = array('', 'um', 'dois', 'três', 'quatro', 'cinco', 'seis', 'sete', 'oito', 'nove');

	$z  = 0;
	$rt = '';

	$valor   = number_format($number, 2, '.', '.');
	$inteiro = explode('.', $valor);
	$cont    = count($inteiro);
	for ($i = 0; $i < $cont; $i++)
		for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
			$inteiro[$i] = '0' . $inteiro[$i];

	$fim = $cont - ($inteiro[$cont - 1] > 0 ? 1 : 2);

	for ($i = 0; $i < $cont; $i++) {
		$valor = $inteiro[$i];
		$rc    = (($valor > 100) && ($valor < 200)) ? 'cento' : $c[$valor[0]];
		$rd    = ($valor[1] < 2) ? '' : $d[$valor[1]];
		$ru    = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : '';

		$r = $rc . (($rc && ($rd || $ru)) ? ' e ' : '') . $rd . (($rd && $ru) ? ' e ' : '') . $ru;
		$t = $cont - 1 - $i;
		$r .= $r ? ' ' . ($valor > 1 ? $plural[$t] : $singular[$t]) : '';

		if ($valor == '000')
			$z++; 
		elseif ($z > 0)
			$z--;

		if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
			$r .= (($z > 1) ? ' de ' : '') . $plural[$t];
		if ($r)
			$rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? (($i < $fim) ? ', ' : ' e ') : ' ') . $r;
	}

	return ($rt ? $rt : 'zero');
}

// return boolean true / false;
function multiplos_5($val){
    $logVal = log($val, 5);
    return (!(strval($logVal) != strval(intval($logVal))) && $logVal > 0); // numero inteiro e maior que zero
}

// Uso: echo " [".fatorial(5)."]";
// exemplo: 5! = 5*4*3*2*1 = 120
function fatorial($num){
    if($num == 1){
        return 1;
    }
    
    //echo "($num * ".fact($num-1).") = ".$num * fact($num-1)."<br>";
    return $num * fatorial($num-1);
}

// fibonacci_base_custom(0,1,5) = 0,1, [ 1, 2, 3, 5, 8 ] = 8
// fibonacci_base_custom(0,1,10) = 0,1, [ 1, 2, 3, 5, 8, 13, 21, 34, 55, 89 ] = 89
// fibonacci_base_custom(13,23,3) = 13, 23, [ 36, 59, 95 ] = 95
function sequencia_fibonacci_base_custom($numAnterior, $numAtual, $qtdLoop=5, $numLoop=1){
    $fib = $numAnterior+$numAtual;
    
    if($numLoop == $qtdLoop)
        return $fib;
    return sequencia_fibonacci_base_custom($numAtual, $fib, $qtdLoop, ++$numLoop);
}

// sequencia_fibonacci(8) = 0, [ 1, 1, 2, 3, 5, 8, 13, 21] = 21
function sequencia_fibonacci($num){
    if($num == 0 || $num == 1)
        return $num;    
    return (sequencia_fibonacci($num-1) + fibonacci($num-2));
}

// menos performático por guardar resultados anteriores, mas interessante
// pode ter utilidade em algum momento
// sequencia_fibonacci_array(8) = 0, 1, 1, 2, 3, 5, 8, 13
function sequencia_fibonacci_array($numero = 0){
	if($numero < 0 || !is_int($numero))
        return "Informe um numero inteiro valido maior que 0 (zero)";

    $fibo = array(0,1);
    if($numero >= 2){
        for($i = 2; $i<$numero; $i++){
            $fibo[$i] = $fibo[$i-1]+$fibo[$i-2];
        }
    } 
    return implode(', ',$fibo);
}

// Dois elevado ao numero menos 1. Resulta sempre em um impar acima de 0
// Tem grande possibilidade de gerar primos na sequencia
// Sequencia_mersenne(4) = 0, [ 1, 3, 7, 15 ] = 15
// Sequencia_mersenne(7) = 0, [ 1, 3, 7, 15, 31, 63, 127 ] = 127
function sequencia_mersenne($potencia){
    return pow(2,$potencia) - 1;
}

// Descobre o maior divisor comum entre dois numeros
// mdc_euclides(5. 25) = 5
// mdc_euclides(14. 21) = 7
// mdc_euclides(212121212, 5642316) = 4
function mdc_euclides($a, $b){
    while($b != 0){
        //$q = $a / $b; // a mérito de interesse apenas, para ver o andamento
        $r = $a % $b;
        $a = $b;
        $b = $r;
    }
    return $a;
}

?>