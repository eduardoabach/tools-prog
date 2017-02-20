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



?>