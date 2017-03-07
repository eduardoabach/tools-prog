<?php

$repeticoes = 6;
$simbolo = '#';
$linhaOld = null;

for($posHoriz = 1; $posHoriz <= $repeticoes; $posHoriz++){
	$linhaAt = null;

	//estrutura lateralmente triangulo
	for($posVert = 1; $posVert <= $posHoriz; $posVert++){
		// primeiro registro não tem espaço
		$linhaAt .= ($linhaAt == null) ? $simbolo : ' '.$simbolo;
	}

	echo $linhaAt.'<br>';
	$linhaOld = $linhaAt;
}

?>