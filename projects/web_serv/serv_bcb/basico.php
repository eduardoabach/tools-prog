<?php
ini_set("soap.wsdl_cache_enabled", "0"); // vamos evitar que o arquivo WSDL seja colocado no cache
$WsSOAP = new SoapClient("serv_bcb/FachadaWSSGS.wsdl");
$ParametroPesquisa = "getUltimoValorXML";

$moedList = array(
	'1' => 'Dólar (v)',
	'10813' => 'Dólar (c)',
	'21633' => 'Dólar Australiano (v)',
	'21634' => 'Dólar Australiano (c)',
	'21635' => 'Dólar Canadense (v)',
	'21636' => 'Dólar Canadense (c)',
	'21619' => 'Euro (v)',
	'21620' => 'Euro (c)',
	'21623' => 'Libra esterlina (v)',
	'21624' => 'Libra esterlina (c)',
	'21621' => 'Iene (v)',
	'21622' => 'Iene (c)',
	'21625' => 'Franco Suíço (v)',
	'21626' => 'Franco Suíço (c)',
	'21627' => 'Coroa Dinamarquesa (v)',
	'21628' => 'Coroa Dinamarquesa (c)',
	'21629' => 'Coroa Norueguesa (v)',
	'21630' => 'Coroa Norueguesa (c)',
	'21631' => 'Coroa Sueca (v)',
	'21632' => 'Coroa Sueca (c)'
);

// 21774 População

foreach($moedList as $cod => $it){
	$respostWS = $WsSOAP->$ParametroPesquisa($cod); 

	if ($respostWS){
		$loadWS = simplexml_load_string($respostWS);
		// $nome = str_replace('Taxa de câmbio - Livre - ','',utf8_decode($loadWS->SERIE->NOME));
		// $uniade = $loadWS->SERIE->UNIDADE;
		$valor = $loadWS->SERIE->VALOR;
		$dataRef = $loadWS->SERIE->DATA->DIA.'/'.$loadWS->SERIE->DATA->MES.'/'.$loadWS->SERIE->DATA->ANO;
		echo "$it: R$ $valor ($dataRef)<br>";
	} else {
		//echo 'Falha ao abrir XML do BCB.';
	}
}



