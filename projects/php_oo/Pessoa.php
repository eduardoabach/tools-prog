<?php

class Pessoa {
	public $nome;
	public $idade;

	function Pessoa($n, $i=null){
		$this->nome = $n;
		$this->idade = $i;
	}

	function getSobrenome(){
		return array_pop(explode(' ', $this->nome));
	}

	function getInfo(){
		return $this->nome . (($this->idade > 0) ? ' - '.$this->idade.' anos' : '' );
	}
}