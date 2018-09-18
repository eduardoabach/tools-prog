<?php

class Colaborador extends Pessoa {
	public $remuneracao;

	function Colaborador($n, $i, $r){
		$this->remuneracao = $r;
		parent::Pessoa($n, $i);
	}

	function getInfo(){
		return $this->nome . ' - R$' . $this->remuneracao;
	}
}