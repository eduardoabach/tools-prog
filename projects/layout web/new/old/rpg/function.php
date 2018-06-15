<?php
	function gerarItens($tipo='armas',$qtdMaxGerar=1,$qtdFixaGerar=false,$info=array()){
		include "itens.php";
		if($tipo == '' || $tipo == 'armas'){
			$listItem = $itemArmas;
		}
		
		if($qtdFixaGerar)	
			$numItens = $qtdMaxGerar;
		else
			$numItens = random($qtdMaxGerar, 1);
		
		if(isset($info['qtd_cada_item_fixa']) && $info['qtd_cada_item_fixa'] > 0){
			$qtdFixa = $info['qtd_cada_item_fixa'];
		} else {
			$qtdFixa = 0;
		}
		
		$numItensColetados = 0;
		$numeroItens = count($listItem);
		$return = array();
		
		
		for (;$numItensColetados < $numItens;) {
			$itemRand = random($numeroItens-1,0);
			$ite = $listItem[$itemRand];
			$itemSubRand = random(count($ite['sub'])-1,0);
			$it = $ite['sub'][$itemSubRand];

			$percAt = random(100, 0,2);
			$percIt = $it['perc'];
			if($percIt > 0 && $percAt < $percIt){
				if($qtdFixa > 0)
					$qtd = $qtdFixa;
				else if(!isset($it['qtd']) || $it['qtd'] == 1)
					$qtd = 1;
				else
					$qtd = random($it['qtd'], 1);

				$itemMont = '('.$qtd.') '.$ite['nome'];
				if($it['nome'] != '')
					$itemMont .= ', '.$it['nome'];
				
				$precoAt = 0;
				if(isset($it['pr']) && $it['pr'] > 0){
					$precoAt = $it['pr'];
				}elseif(isset($it['pr_min']) && $it['pr_min'] > 0 && isset($it['pr_max']) && $it['pr_max'] > 0){
					$precoAt = random($it['pr_max'],$it['pr_min']);
				}
				if($precoAt > 0){
					$unidadeAt = 'PO';
					if(isset($it['un']))
						$unidadeAt = $it['un'];
					$precoAt .= ' '.$unidadeAt;
					$itemMont .= ' '.$precoAt;
				}
				
				$return[] = $itemMont;
				$numItensColetados++;
			}
		}
		return $return;
	}
	
	function gerarPersonagem($dados){
		include "pdj.php";

		$per = array();
		if ($dados['sexo'] == '')
			$per['sexo'] = random($sexo);
		else
			$per['sexo'] = $dados['sexo'];


		if ($dados['raca'] == '')
			$per['raca'] = random($raca);
		else
			$per['raca'] = $dados['raca'];

		if ($dados['classe'] == '')
			$per['classe'] = random($classe);
		else
			$per['classe'] = $dados['classe'];

		if ($dados['idade_min'] == '')
			$dados['idade_min'] = 16;
		if ($dados['idade_max'] == '')
			$dados['idade_max'] = 60;
		$per['idade'] = random($dados['idade_min'], $dados['idade_max']);


		if ($dados['altura_min'] == '')
			$dados['altura_min'] = 100;
		if ($dados['altura_max'] == '')
			$dados['altura_max'] = 200;
		$per['altura'] = random($dados['altura_min'], $dados['altura_max']);


		if ($dados['peso_min'] == '')
			$dados['peso_min'] = 45;
		if ($dados['peso_max'] == '')
			$dados['peso_max'] = 120;
		$per['peso'] = random($dados['peso_min'], $dados['peso_max']);

		$numCaract = random(2, 1);
		for ($i = 0; $i <= $numCaract; $i++)
			$per['caract'][] = random($carac);

		$per['itens'] = gerarItens('armas',3);

		$return = tratarExibPer($per);
		return $return;
	}

	function tratarExibPer($per) {
		$str = '';
		$brk = '<br>';
		$str .= 'Sexo: ' . $per['sexo'] . $brk;
		$str .= 'Raça: ' . $per['raca'] . $brk;
		$str .= 'Classe: ' . $per['classe'] . $brk;
		$str .= 'Idade: ' . $per['idade'] . ' anos' . $brk;
		$str .= 'Altura: ' . $per['altura'] . ' cm' . $brk;
		$str .= 'Peso: ' . $per['peso'] . ' kg' . $brk;
		$str .= 'Características:' . $brk;
		foreach ($per['caract'] as $car) {
			$str .= $car . $brk;
		}

		$str .= 'Itens:' . $brk;
		foreach ($per['itens'] as $car) {
			$str .= $car . $brk;
		}
		return $str;
	}

	function random($limit = 0, $init = 0,$precisao=0) {
		$return = '';
		if($precisao == 2){
			$limit *= 100;
			$init *= 100;
		}

		if (is_array($limit)) {
			$count = count($limit);
			$return = $limit[rand(0, $count - 1)];
		} else if (is_numeric($limit)) {
			$return = rand($init, $limit);
		}

		if($precisao == 2){
			$return /= 100;
		}

		return $return;
	}

	$dados = $_POST;
	$personagem = gerarPersonagem($dados);
	echo $personagem;
?>