<?php 

function __autoload($class){
	$caminhoPadrao = '/controller/'; // exemplo...
	$autoloadPadraoPhp = false;

	if (!class_exists($class, $autoloadPadraoPhp)) {
		include($caminhoPadrao.$class);
    	if (!class_exists($class, $autoloadPadraoPhp)){
    		trigger_error("Erro ao carregar classe: $class", E_USER_WARNING);
    	}
    }
}

if (class_exists('MyClass')) {
    $myclass = new MyClass();
}
