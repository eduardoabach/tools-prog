<?php
$numFrases = count($fraseList);
$numF = rand(0, $numFrases - 1);
$fraseAt = $fraseList[$numF];

$numVIsitas = $_COOKIE["num_visitas"];
$numVIsitas++;

$hoje = date('Y-m-d H:i:s');
$visitaUlt = $_COOKIE["visita_1"];
$visitaPeNult = $_COOKIE["visita_2"];
$visitaAntPeNul = $_COOKIE["visita_3"];

//$dataUlt = date("Y-m-d H:i:s", strtotime($visitaUlt));

setcookie("visita_1", $hoje);
setcookie("visita_2", $visitaUlt);
setcookie("visita_3", $visitaPeNult);
setcookie("num_visitas", $numVIsitas);

$fraseTempo = '';
$listaTempoAtual = array();
$diasUlt = diasEntreDatas($visitaUlt);
if ($diasUlt > 7) {
	$listaTempoAtual = $fraseTempAntigo;
} else if ($diasUlt > 1) {
	$listaTempoAtual = $fraseTempSemana;
} else {
	$horasUlt = horasEntreDatas($visitaUlt);
	if ($horasUlt > 1) {
		$listaTempoAtual = $fraseTempDia;
	} else {
		$minutosUlt = minutosEntreDatas($visitaUlt);
		if ($minutosUlt > 1) {
			$listaTempoAtual = $fraseTempMinuto;
		} else {
			$seg = segEntreDatas($visitaUlt);
			if ($seg == 0 && $visitaUlt == '' && $visitaPeNult == '' && $visitaAntPeNul == '')//primeiro acesso
				$listaTempoAtual = $fraseTempPri;
			else if ($seg < 3)
				$listaTempoAtual = $fraseTempF5;
			else
				$listaTempoAtual = $fraseTempSegundo;
		}
	}
}

$numFrases = count($listaTempoAtual);
$numF = rand(0, $numFrases - 1);
$fraseTempo = $listaTempoAtual[$numF];
?>