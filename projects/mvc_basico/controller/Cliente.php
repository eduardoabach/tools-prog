<?php

class Cliente extends Pessoa {
	public $limite;

	function Cliente($n, $i=null, $l=null){
		$this->limite = $l;
		parent::Pessoa($n, $i);
	}

	function getInfo(){
		return $this->nome . ' - Limite R$' . $this->limite;
	}
}