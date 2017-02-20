<?php

	function pr($val){
		print('<pre>');
		print_r($val);
		print('</pre>');
	}

	function get_saudacao(){
		$hour = date('Gi');
		return ($hour < 1200) ? 'Bom dia' : (($hour < 1800) ? 'Boa tarde' : 'Boa noite');
	}

	function get_server_cpu_usage(){
		$load = sys_getloadavg();
		return $load[0]; // array com cores, zero é um total
	}

?>