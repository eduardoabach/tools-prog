<?php
ini_set("soap.wsdl_cache_enabled", "0"); // vamos evitar que o arquivo WSDL seja colocado no cache
$WsSOAP = new SoapClient("serv_bcb/FachadaWSSGS.wsdl");
$ParametroPesquisa = "getUltimoValorXML";

$moedList = array(
	'1' => 'Dólar (venda)',
	'10813' => 'Dólar (compra)',
	'21619' => 'Euro (venda)',
	'21620' => 'Euro (compra)',
	'21621' => 'Iene (venda)',
	'21622' => 'Iene (compra)',
	'21623' => 'Libra esterlina (venda)',
	'21624' => 'Libra esterlina (compra)',
	'21625' => 'Franco Suíço (venda)',
	'21626' => 'Franco Suíço (compra)',
	'21627' => 'Coroa Dinamarquesa (venda)',
	'21628' => 'Coroa Dinamarquesa (compra)',
	'21629' => 'Coroa Norueguesa (venda)',
	'21630' => 'Coroa Norueguesa (compra)',
	'21631' => 'Coroa Sueca (venda)',
	'21632' => 'Coroa Sueca (compra)',
	'21633' => 'Dólar Australiano (venda)',
	'21634' => 'Dólar Australiano (compra)',
	'21635' => 'Dólar Canadense (venda)',
	'21636' => 'Dólar Canadense (compra)'
);

// 21774 População

foreach($moedList as $cod => $it){
	$Moeda = "1406";
	$respostWS = $WsSOAP->$ParametroPesquisa($cod); 

	if ($respostWS){
		$loadWS = simplexml_load_string($respostWS);
		$nome = str_replace('Taxa de câmbio - Livre - ','',utf8_decode($loadWS->SERIE->NOME));
		// $uniade = $loadWS->SERIE->UNIDADE;
		$valor = $loadWS->SERIE->VALOR;
		$dataRef = $loadWS->SERIE->DATA->DIA.'/'.$loadWS->SERIE->DATA->MES.'/'.$loadWS->SERIE->DATA->ANO;
		echo "$nome: R$ $valor ($dataRef)<br>";
	} else {
		//echo 'Falha ao abrir XML do BCB.';
	}
}



