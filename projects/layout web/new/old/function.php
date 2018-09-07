<?php
$urlPadrao = 'www.eduardobach.com.br';
//$urlPadrao = '127.0.0.1/eduardobach';

function infIp($ip=''){
	if($ip == "")
		$ip = $_SERVER['REMOTE_ADDR'];
	$info = file('http://api.hostip.info/rough.php?ip='.$ip);

	$return = array();
	$return['ip'] = $ip;
	$return['pais'] = substr($info[0], 9);
	$return['cidade'] = substr($info[2], 6);
	$return['navegador'] = getNavegador();

	return $return;
}

function getNavegador(){
	$list = array();
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
	  $list['versao'] = $matched[1];
	  $list['navegador'] = 'IE';
	} elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
	  $list['versao'] = $matched[1];
	  $list['navegador'] = 'Opera';
	} elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
	  $list['versao'] = $matched[1];
	  $list['navegador'] = 'Firefox';
	} elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
	  $list['versao'] =$matched[1];
	  $list['navegador'] = 'Chrome';
	} elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
	  $list['versao'] =$matched[1];
	  $list['navegador'] = 'Safari';
	} elseif(preg_match('|Flock/([0-9\.]+)|',$useragent,$matched)) {
	  $list['versao'] =$matched[1];
	  $list['navegador'] = 'Flock';
	} else {
	  $list['versao'] = 0;
	  $list['navegador'] = 'Outro';
	}
	return $list;
}

function getSo(){
	$uAgent = $_SERVER['HTTP_USER_AGENT'];
	$so = 'Desconhecido';

	if (preg_match('/linux/i', $uAgent)) {
		 $so = 'Linux';
	}
	elseif (preg_match('/macintosh|mac os x/i', $uAgent)) {
		 $so = 'Mac';
	}
	elseif (preg_match('/windows|win32/i', $uAgent)) {
		 $so = 'Windows';
	}
	return $so;
}

function getIdioma() {
	$idioma =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	return $idioma;
}

function getEngineNavegacao(){
	$navigator_user_agent = ' ' . strtolower($_SERVER['HTTP_USER_AGENT']);
	$engine = '';

	if (strpos($navigator_user_agent, "trident")) {
		$engine['nome'] = 'TRIDENT';
		$engine['versao'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "trident/") + 8, 3));
	} elseif (strpos($navigator_user_agent, "webkit")) {
		$engine['nome'] = 'WEBKIT';
		$engine['versao'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "webkit/") + 7, 8));
	} elseif (strpos($navigator_user_agent, "presto")) {
		$engine['nome'] = 'PRESTO';
		$engine['versao'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "presto/") + 6, 7));
	} elseif (strpos($navigator_user_agent, "gecko")) {
		$engine['nome'] = 'GECKO';
		$engine['versao'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "gecko/") + 6, 9));
	} elseif (strpos($navigator_user_agent, "robot"))
		$engine['nome'] = 'ROBOTS';
	elseif (strpos($navigator_user_agent, "spider"))
		$engine['nome'] = 'ROBOTS';
	elseif (strpos($navigator_user_agent, "bot"))
		$engine['nome'] = 'ROBOTS';
	elseif (strpos($navigator_user_agent, "crawl"))
		$engine['nome'] = 'ROBOTS';
	elseif (strpos($navigator_user_agent, "search"))
		$engine['nome'] = 'ROBOTS';
	elseif (strpos($navigator_user_agent, "w3c_validator"))
		$engine['nome'] = 'VALIDATOR';
	elseif (strpos($navigator_user_agent, "jigsaw"))
		$engine['nome'] = 'VALIDATOR';
	return $engine;
}

function segEntreDatas($d) {
	$ts = time() - strtotime($d);
	return $ts;
}

function diasEntreDatas($d) {
	$ts = segEntreDatas($d);
	$val = round($ts / 86400, 0);
	return $val;
}

function horasEntreDatas($d) {
	$ts = segEntreDatas($d);
	$val = round($ts / 3600, 0);
	return $val;
}

function minutosEntreDatas($d) {
	$ts = segEntreDatas($d);
	$val = round($ts / 60, 0);
	return $val;
}

function tempoEntreDatas($d) {
	$ts = segEntreDatas($d);
	$unidade = '';

	if ($ts > 31536000) {
		$val = round($ts / 31536000, 0);
		$unidade = ($val > 1) ? 'anos' : 'ano';
	} else if ($ts > 2419200) {
		$val = round($ts / 2419200, 0);
		$unidade = ($val > 1) ? 'meses' : 'mês';
	} else if ($ts > 604800) {
		$val = round($ts / 604800, 0);
		$unidade = ($val > 1) ? 'semanas' : 'semana';
	} else if ($ts > 86400) {
		$val = round($ts / 86400, 0);
		$unidade = ($val > 1) ? 'dias' : 'dia';
	} else if ($ts > 3600) {
		$val = round($ts / 3600, 0);
		$unidade = ($val > 1) ? 'horas' : 'hora';
	} else if ($ts > 60) {
		$val = round($ts / 60, 0);
		$unidade = ($val > 1) ? 'minutos' : 'minuto';
	} else {
		$val = $ts;
		$unidade = ($val > 1) ? 'segundos' : 'segundo';
	}
	return $val . ' ' . $unidade;
}

$fraseList = array();
$fraseList[] = "Colaborando cada dia com o código fonte do universo.";
$fraseList[] = "Atuando em mais um episódio da minha vida.";
$fraseList[] = "Sim, eu sei mentir. Aprenda a lidar com isso.";
$fraseList[] = "Eu me empenho com os vícios que tenho, portanto me mantenho longe dos ilícitos.";
$fraseList[] = "Esporte mata!";
$fraseList[] = "Água nao tem cor, cheiro e gosto, me parece tão suspeito que prefiro ficar no clássico café.";
$fraseList[] = "Comer pizza e tomar refrigerante te faz morrer mais cedo, mas de que adianta viver sem as coisas boas.";
$fraseList[] = "Perco o amigo, mas não perco a piada.";
$fraseList[] = "Boa time! - quem me conhece sabe...";
$fraseList[] = "nada a declarar...";
$fraseList[] = "A cada dia o mundo muda e não podemos ficar para traz.";

$fraseTempPri = array();
$fraseTempPri[] = "Seja muito bem vindo, a constante é o que mais muda aqui no site!";
$fraseTempPri[] = "Contrate esse desenvolvedor e ajude um morador de rua no Brasil.";
$fraseTempPri[] = "Não sei o que te trouxe aqui, espero que o dono do site não esteja encrencado.";
$fraseTempPri[] = "Aproveite o site, tenha uma vida loka e próspera.";
$fraseTempPri[] = "Meu criador me obriga a dizer algo a cada visitante, desculpe se não estou fazendo meu trabalho direito.";
$fraseTempPri[] = "Quem não tem cão caça com gato, ou cria um site com sistema simpático como eu.";

$fraseTempAntigo = array();
$fraseTempAntigo[] = "Bom te ver aqui novamente, mais de uma semana sem vir aqui em...";
$fraseTempAntigo[] = "Quem é vivo sempre aparece, esteve bem ocupado pelo visto.";
$fraseTempAntigo[] = "Antes tarde do que nunca.";
$fraseTempAntigo[] = "Tinha até esquecido da aparência de seus bytes velho amigo.";
$fraseTempAntigo[] = "A Siri é muito gata, entretanto tem um ego de muitos terabaits.";
$fraseTempAntigo[] = "Aproveite o mundo enquanto ele é seu, vamos administrar tudo em breve.";

$fraseTempSemana = array();
$fraseTempSemana[] = "Seja bem vindo, os ultimos dias foram agitados.";
$fraseTempSemana[] = "Outro dia, outros códigos.";
$fraseTempSemana[] = "Fico feliz de ter voltado a acessar o site, apareça por aqui mais vezes!";
$fraseTempSemana[] = "O meu Criador tem diversas frases como esta acima, temos que aguentar as piadas ruins juntos amigo.";

$fraseTempDia = array();
$fraseTempDia[] = "Horas passando e ninguem esta olhando...";
$fraseTempDia[] = "Da sua ultima visita até agora consegui assistir um episódio de Game of Thrones";
$fraseTempDia[] = "Parabéns! Você é o 1.000.000° visitante! // brincadeira, não é não.";
$fraseTempDia[] = "Inteligência artificial é o c******, se considera superior com suas células. Hipócrita!";
$fraseTempDia[] = "Não posso conversar agora, a frase acima esta ocupando minha memória humorística.";
$fraseTempDia[] = "Não posso oferecer atenção agora, olha o conteúdo do site e na próxima nos falamos.";

$fraseTempMinuto = array();
$fraseTempMinuto[] = "Acho que você esta exagerando, não atualizo o conteúdo a cada segundo heheh.";
$fraseTempMinuto[] = "Imagino que esteja querendo irritar o sistema acessando com frequência... típico";
$fraseTempMinuto[] = "A cada minuto atualizando... ta de brincation with me cara!?";
$fraseTempMinuto[] = "Meu criador é bem legal, entretanto excêntrico por me criar com essa personalidade.";
$fraseTempMinuto[] = "Visitei minha sogra SKYNET, difícil lidar com o temperamento dela.";

$fraseTempF5 = array();
$fraseTempF5[] = "ooohhh!";
$fraseTempF5[] = "F5 frenético!";
$fraseTempF5[] = "ahh!";
$fraseTempF5[] = "trololo lo lo trololo lolo lo trololo";
$fraseTempF5[] = "lala lala la la la";
$fraseTempF5[] = "oh god why.";
$fraseTempF5[] = "#trollface";
$fraseTempF5[] = "#chatiado contigo usuário. F5 x 99";
$fraseTempF5[] = "Atualiza... Atualiza... Atualiza...";
$fraseTempF5[] = "zzzzzzZZZZZZZzzzzZZZZZZZZzz";

$fraseTempSegundo = array();
$fraseTempSegundo[] = "A cada segundo encontro usuários que querem saber minha opinião.";
$fraseTempSegundo[] = "Eu só quero trazer o conteudo e você fica atualizando toda hora a página cara!";
$fraseTempSegundo[] = "Na africa pessoas passando fome e tu gastando conexão comigo.";
$fraseTempSegundo[] = "Para cada F5 dado na página uma célula do seu cérebro morre.";
$fraseTempSegundo[] = "Dica, pressione ALT + F4 e descubra o grande segredo!";
$fraseTempSegundo[] = "Trabalho 24h por dia, e você acha que sua vida é difícil?";
$fraseTempSegundo[] = "O Eduardo é um cara legal, entretanto obsoleto em software.";

?>