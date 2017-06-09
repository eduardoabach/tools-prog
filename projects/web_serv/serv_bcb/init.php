<?php

//Criar aqui objeto para chamada

ini_set("soap.wsdl_cache_enabled", "0"); // vamos evitar que o arquivo WSDL seja colocado no cache

$ParametroPesquisa = "getUltimoValorXML";
$Moeda = "21623";
// 1 	Dólar (venda)
// 10813 	Dólar (compra)
// 21619 	Euro (venda)
// 21620 	Euro (compra)
// 21621 	Iene (venda)
// 21622 	Iene (compra)
// 21623 	Libra esterlina (venda)
// 21624 	Libra esterlina (compra)
// 21625 	Franco Suíço (venda)
// 21626 	Franco Suíço (compra)
// 21627 	Coroa Dinamarquesa (venda)
// 21628 	Coroa Dinamarquesa (compra)
// 21629 	Coroa Norueguesa (venda)
// 21630 	Coroa Norueguesa (compra)
// 21631 	Coroa Sueca (venda)
// 21632 	Coroa Sueca (compra)
// 21633 	Dólar Australiano (venda)
// 21634 	Dólar Australiano (compra)
// 21635 	Dólar Canadense (venda)
// 21636 	Dólar Canadense (compra)




$WsSOAP = new SoapClient("FachadaWSSGS.wsdl");
$ResultadoPesquisaWS = $WsSOAP->$ParametroPesquisa($Moeda); 
 
if ($ResultadoPesquisaWS){
	$CotacaoMoedaWS = simplexml_load_string($ResultadoPesquisaWS);
	$NomeMoeda = utf8_decode($CotacaoMoedaWS->SERIE->NOME);
	$uniadeMoeda = $CotacaoMoedaWS->SERIE->UNIDADE;
	$ValorMoeda = $CotacaoMoedaWS->SERIE->VALOR;
	$DiaCotacaoMoeda = $CotacaoMoedaWS->SERIE->DATA->DIA;
	$MesCotacaoMoeda = $CotacaoMoedaWS->SERIE->DATA->MES;
	$AnoCotacaoMoeda = $CotacaoMoedaWS->SERIE->DATA->ANO;
	echo "$NomeMoeda<br>
		Valor: $1 equivale à R$ $ValorMoeda 
		<br> Dia da Cotação: $DiaCotacaoMoeda/$MesCotacaoMoeda/$AnoCotacaoMoeda ";
} else {
	echo 'Falha ao abrir XML do BCB.';
}
