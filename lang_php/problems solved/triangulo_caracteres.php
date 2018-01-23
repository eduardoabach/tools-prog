<?php

$repeticoes = 6;
$simbolo = '#';

for($posHoriz = 1; $posHoriz <= $repeticoes; $posHoriz++){
	
	//estrutura lateralmente triangulo
	$linhaAt = null;
	for($posVert = 1; $posVert <= $posHoriz; $posVert++){
		// primeiro registro não tem espaço
		$linhaAt .= ($linhaAt == null) ? $simbolo : ' '.$simbolo;
	}

	echo $linhaAt.'<br>';
}


echo '<br><br>';


// VERSÃO DO LUCAS, muito boa e simples
$repet = 6;
$simb = '#';
$contador = 1;

for($content=$simb; $contador <= $repet; $content .= ' '.$simb){
	echo $content.'<br/>';
	$contador++;
}


?>