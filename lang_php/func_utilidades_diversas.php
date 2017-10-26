<?php

	function pr($val){
		print('<pre>');
		print_r($val);
		print('</pre>');
	}

	function getSaudacao(){
		$hour = date('Gi');
		return ($hour < 1200) ? 'Bom dia' : (($hour < 1800) ? 'Boa tarde' : 'Boa noite');
	}

	function getServerSO(){
		switch (true) {
            case stristr(PHP_OS, 'DAR'): return 'MAC';
            case stristr(PHP_OS, 'WIN'): return 'Windows';
            case stristr(PHP_OS, 'LINUX'): return 'Linux';
            case stristr(PHP_OS, 'FreeBSD'): return 'FreeBSD';
            default : return 'Desconhecido';
        }
	}

	function getServerDiretorio(){
		return getcwd();
	}

	function getServerUsoCpu(){
		$load = sys_getloadavg();
		return $load[0]; // array com cores, key zero é um total agrupado
	}
	
	function getClienteSO(){
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

	function getClienteNavegador(){
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


	function getClienteIdioma() {
		$idioma =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
		return $idioma;
	}

	function getClienteEngineNavegacao(){
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


?>