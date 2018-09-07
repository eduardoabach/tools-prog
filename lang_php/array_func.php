<?php

   function object2array($data){
	if (is_array($data) || is_object($data)):
		$result = array();
		foreach ($data as $key => $value):
			$result[$key] = object2array($value);
		endforeach;

		return $result;
	endif;

	return $data;
   }

	/**
	 * $text = "Este é um exemplo: este texto, e este vão ser explodidos. Este outro | este também :)";
	 * $exploded = multiexplode(array(",",".","|",":"),$text);
	 * Array (
	 *   [0] => Este é um exemplo
	 *   [1] => este texto
	 *   [2] => e este vão ser explodidos
	 *   [3] => Este outro
	 *   [4] => este também
	 *   [5] => )
	 * )
	 */
	function multiexplode($delimiters, $string){
		$ready  = str_replace($delimiters, $delimiters[0], $string);
		$launch = explode($delimiters[0], $ready);
		return $launch;
	}

?>