<?php

function is_year($year){
	return preg_match('/^\d{4}$/', $year) && $year > 1799 && $year < 2501;
}

function is_month($month){
	return preg_match('/^\d{1,2}$/', $month) && $month > 0 && $month < 13;
}

function get_dia_da_semana($date, $extenso = false){
	$day = date('w', strtotime($date));
	if($extenso === true)
 		$day = get_days_week($day);
	return $day;
}

/* $time = H:i:s / hh:mm:ss */
function add_minutes($time, $minutes = 1){
	$time = strtotime($time);
	return date("H:i:s", strtotime('+'.$minutes.' minutes', $time));
}

/* $time = H:i:s / hh:mm:ss */
function sub_minutes($time, $minutes = 1){
	$time = strtotime($time);
	return date("H:i:s", strtotime('-'.$minutes.' minutes', $time));
}

function add_days($date, $days = 1){
	$date = new DateTime($date);
	if($days)
		$date->add(new DateInterval('P' . $days . 'D'));
	return $date->format('Y-m-d');
}

function sub_days($date, $days = 1){
	$date = new DateTime($date);
	if($days)
		$date->sub(new DateInterval('P' . $days . 'D'));
	return $date->format('Y-m-d');
}

function add_years($date, $years = 1){
	$date = new DateTime($date);
	if($years)
		$date->add(new DateInterval('P' . $years . 'Y'));
	return $date->format('Y-m-d');
}

function sub_years($date, $years = 1){
	$date = new DateTime($date);
	if($years)
		$date->sub(new DateInterval('P' . $years . 'Y'));
	return $date->format('Y-m-d');
}

function data_ultimo_dia_mes($date = null, $show_date = false){
	$formtRetorno = ($show_date === true) ? 'Y-m-t' : 't';
	return (is_null($date)) ? date($formtRetorno) : date($formtRetorno, strtotime($date)); // para ver a data atual basta omitir o segundo parâmetro
}

function hora_atual(){
	return date('G:i:s');
}

function data_hora_atual(){
	return date('Y-m-d H:i:s');
}

function is_date_user($date){
	if(is_array($date))
		return false;

	$valida = preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $date);
	if(!$valida)
		return false;

	list($d, $m, $a) = explode('/', $date);
	$valida = checkdate($m, $d, $a);
	if(!$valida)
		return false;

	return true;
}

function is_date_db($date){
	if(is_array($date))
		return false;

	$valida = preg_match('/^\d{4}\-\d{1,2}\-\d{1,2}$/', $date);
	if(!$valida)
		return false;

	list($a, $m, $d) = explode('-', $date);
	if(!checkdate($m, $d, $a))
		return false;

	return true;
}

function is_timestamp($timestamp){
	$valida = preg_match('/^(\d{4})\-(\d{2})\-(\d{2})\s([0-1][0-9]|[2][0-3])(:([0-5][0-9])){1,2}$/', $timestamp);
	if(!$valida)
		return false;

	list($date, $time) = explode(' ', $timestamp);
	if(!is_date_db($date))
		return false;

	return true;
}

function slice_timestamp($timestamp){
	if (!is_timestamp($timestamp))
		return false;

	list($date, $hour) = explode(' ', $timestamp);

	return (object)array(
		'date' => $date,
		'hour' => $hour
	);
}

function get_timestamp_date($timestamp){
	if(!is_timestamp($timestamp))
 		return false;

	return slice_timestamp($timestamp)->date;
}

function get_timestamp_hour($timestamp){
	if(!is_timestamp($timestamp))
 		return false;

	return slice_timestamp($timestamp)->hour;
}

/* Y-m-d H:i:s */
function segundos_entre_datas($data1, $data2){
	retunr strtotime($data1) - strtotime($data2);
}

/* Y-m-d H:i:s */
function horas_entre_datas($data1, $data2){
	$tempoSegundos = segundos_entre_datas($data1, $data2);
	return round($tempoSegundos / 3600, 0);
}

/* Y-m-d H:i:s */
function minutos_entre_datas($data1, $data2){
	$tempoSegundos = segundos_entre_datas($data1, $data2);
	return round($tempoSegundos / 60, 0);
}

// Usar quando for necessária precisão de horas, minutos, segundos
// quando for simplesmente para dias ou maiores usar dias_entre_datas()
// melhorar essa function, agregar sub valores para montar string composta completa
// objetivo: 5 meses, 2 dias, 4 horas, 25 minutos e 1 segundo.
function tempoEntreDatas($data1, $data2) {
	$ts = segundos_entre_datas($data1, $data2);
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
	return $val.' '.$unidade;
}


function data_hora_resumo($timestamp, $use_gmt = false){
	if (is_string($timestamp)) {
		$timestamp = strtotime($timestamp);
	}

	$now = ($use_gmt) ? mktime() : time();
	$diff = $now - $timestamp;
	$day_diff = floor($diff / 86400);

	if ($day_diff < 0) {
		return 'agora';
	}

	if ($diff < 60) {
		return 'agora';
	} else if ($diff < 120) {
		return '1 minuto atrás';
	} else if ($diff < 3600) {
		return floor($diff / 60) . ' minutos atrás';
	} else if ($diff < 7200) {
		return '1 hora atrás';
	} else if ($diff < 86400) {
		return floor($diff / 3600) . ' horas atrás';
	} else if ($day_diff == 1) {
		return 'ontem';
	} else if ($day_diff < 7) {
		return $day_diff . " dias atrás";
	} else {
		return ceil($day_diff / 7) . ' semanas atrás';
	}

}

// get_dias_uteis_entre_datas(date_create('2017-01-01'), date_create('2017-02-01'));
// get_dias_uteis_entre_datas(date_create(date('Y-m-01')), date_create(date('Y-m-t')));
function get_dias_uteis_entre_datas(DateTime $dataInicial, DateTime $dataFinal){
	$diasUteis = 0;
	while ($dataInicial->format('Y-m-d') <= $dataFinal->format('Y-m-d')) {
		if (!in_array($dataInicial->format('w'), array(0, 6))) {
			$diasUteis++;
		}
		$dataInicial->add(new DateInterval('P1D'));
	}

	return $diasUteis;
}

function timestamp_to_user($timestamp){
	if(!is_timestamp($timestamp))
		return false;

	$slice = slice_timestamp($timestamp);
	return sprintf('%s %s', date_to_user($slice->date), $slice->hour);
}

function date_to_user($date, $default = null){
	$valida = is_date_db($date);

	if (!$valida) {
		if (is_timestamp($date)) {
			$slice = slice_timestamp($date);
			$date  = $slice->date;
		} else {
			return $default;
		}
	}

	list($a, $m, $d) = explode('-', $date);
	$valida = checkdate($m, $d, $a);
	if (!$valida) 
		return $default;

	return sprintf('%s/%s/%d', $d, $m, $a);
}

function date_to_db($date, $default = null){
	$valida = preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date);
	if (!$valida)
		return $default;

	list($d, $m, $a) = explode('/', $date);
	$valida = checkdate($m, $d, $a);

	if (!$valida)
		return $default;

	return sprintf('%d-%s-%s', $a, $m, $d);
}

function dias_entre_datas($date1, $date2){
	$diff = date_diference($date1, $date2);
	return $diff->days;
}

function meses_entre_datas($date1, $date2){
	$diff = date_diference($date1, $date2);
	return (($diff->y * 12) + $diff->m);
}

function anos_entre_datas($date1, $date2){
	$diff = date_diference($date1, $date2);
	return $diff->y;
}

function data_dif_atual_descricao($timestamp, $use_gmt = false){
	if(is_string($timestamp)){
		$timestamp = strtotime($timestamp);
	}

	$now = ($use_gmt) ? mktime() : time();
	$diff = $now - $timestamp;
	$day_diff = floor($diff / 86400);

	return tempo_dif_data_descricao($day_diff);
}

function tempo_dif_data_descricao($tempoDiff){
	if($tempoDiff < 0){ //negativo, deve estar invertido
	  return 'agora';
	}

	if ($tempoDiff < 60){
	  return 'menos de 1 minuto';
	} else if ($tempoDiff < 120) {
	  return '1 minuto atrás';
	} else if ($tempoDiff < 3600) {
	  return floor($tempoDiff / 60) . ' minutos atrás';
	} else if ($tempoDiff < 7200) {
	  return '1 hora atrás';
	} else if ($tempoDiff < 86400) {
	  return floor($tempoDiff / 3600) . ' horas atrás';
	} else if ($tempoDiff == 1) {
	  return 'ontem';
	} else if ($tempoDiff < 7) {
	  return $tempoDiff . " dias atrás";
	} else {
	  return ceil($tempoDiff / 7) . ' semanas atras';
	}
}

function date_diference($date1, $date2){
	if($date1 <= $date2){
		if (strlen($date1) <= 10)
			$date1 .= ' 00:00:00';
		if(strlen($date2) <= 10)
			$date2 .= ' 23:59:59'; 

	} else {
		if(strlen($date1) <= 10)
			$date1 .= ' 23:59:59';
		if(strlen($date2) <= 10)
			$date2 .= ' 00:00:00';
	}

	$date1 = new DateTime($date1);
	$date2 = new DateTime($date2);
	$diff  = $date1->diff($date2);
	return $diff;
}

// formato 20151231
function str_to_date($string){
	if(!empty($string) && strlen($string) == 8) {
		$ano = substr($string, 0, 4); // 2015
		$mes = substr($string, 4, 2); // 12
		$dia = substr($string, 6, 2); // 31

		$date = $ano.'-'.$mes.'-'.$dia;
		if(is_date_db($date)) {
			return $date;
		}
	}

	return false;
}

/**
* Recebe dois arrays de faixas de datas, faz a intersecção das datas e retorna array com range resultante
* Datas no formato americano / banco dados
* Date Range exemplo: array('inicio'=>'2016-01-01','fim'=>'2016-03-15')
* @param $dateRange array
* @param $dataRangeIntersection array
* @return $dateRange array ou boolean FALSE
* @author Eduardo Bach
*/
function date_intersection($dateRange, $dataRangeIntersection){
	//deve ser informado o início e o fim para ser válida a regra
	if(isset($dateRange['inicio']) && isset($dateRange['fim']) && isset($dataRangeIntersection['inicio']) && isset($dataRangeIntersection['fim'])) {
		$inicioInterc = ($dateRange['inicio'] >= $dataRangeIntersection['inicio'] && $dateRange['inicio'] <= $dataRangeIntersection['fim']);
		$fimInterc    = ($dateRange['fim'] >= $dataRangeIntersection['inicio'] && $dateRange['fim'] <= $dataRangeIntersection['fim']);
		$dataDentro   = ($inicioInterc || $fimInterc);

		if($dataDentro) {
			$result           = array();
			$result['inicio'] = ($dateRange['inicio'] < $dataRangeIntersection['inicio']) ? $dataRangeIntersection['inicio'] : $dateRange['inicio'];
			$result['fim']    = ($dateRange['fim'] > $dataRangeIntersection['fim']) ? $dataRangeIntersection['fim'] : $dateRange['fim'];

			return $result;
		}
	}

	return false;
}

/**
* Recebe uma lista em array() de periodos de datas para serem unidos
* Entrada:
* array(
*      '0' => array('inicio'=>'2000-01-01', 'fim'=>'2000-06-05')
*      '1' => array('inicio'=>'2000-04-01', 'fim'=>'2000-08-10')
*      '2' => array('inicio'=>'2000-12-01', 'fim'=>'2001-01-20')
*      '3' => array('inicio'=>'2001-01-01', 'fim'=>'2001-02-01')
*      '4' => array('inicio'=>'2001-10-08', 'fim'=>'2001-11-15')
* )
* Saída:
* array(
*      '0' => array('inicio'=>'2000-01-01', 'fim'=>'2000-08-10')
*      '2' => array('inicio'=>'2000-12-01', 'fim'=>'2001-02-01')
*      '4' => array('inicio'=>'2001-10-08', 'fim'=>'2001-11-15')
* )
* @param $listaRangeDatas array
* @return $dateRangeDatas array
* @author Eduardo Bach
 */
function date_union($listaRangeDatas = array()){
    //para casos onde o range de datas faca dentro de outro, portanto irrelevante
    $removerList = array(); // $removerList[$keyItem_remover] = $keyItem_absorveu_conteudo_do_excluido;
    
    foreach($listaRangeDatas as $keyItem => $item){
                
        // essa verificação é feita para não comparar novamente registros já unidos com outros
        $keyItemOk = $keyItem;
        $itemOk = $item;
        if(array_key_exists($keyItem, $removerList)){
                $keySubstituir = $removerList[$keyItem];
                if(array_key_exists($keySubstituir, $listaRangeDatas)){
                        $itemOk = $listaRangeDatas[$keySubstituir];
                        $keyItemOk = $keySubstituir;
                }
        }
                
        //passa para verificar datas com intersecção e unir elas
        foreach($listaRangeDatas as $keyItemComparar => $itemComparar){
                        
            // essa verificação é feita para não comparar novamente registros já unidos com outros
            $keyItemCompararOk = $keyItemComparar;
            $itemCompararOk = $itemComparar;
            if(array_key_exists($keyItemComparar, $removerList)){
                    $keySubstituir = $removerList[$keyItemComparar];
                    if(array_key_exists($keySubstituir, $listaRangeDatas)){
                            $itemCompararOk = $listaRangeDatas[$keySubstituir];
                            $keyItemCompararOk = $keySubstituir;
                    }
            }
                        
            // nao deve comparar o range de datas com ele mesmo
            if($keyItemOk <> $keyItemCompararOk){
                    
                $diasDist_ItemIni_ItemCompIni = fg_dias_dif_data($itemOk['inicio'], $itemCompararOk['inicio']);
                $diasDist_ItemFim_ItemCompIni = fg_dias_dif_data($itemOk['fim'], $itemCompararOk['inicio']);
                $diasDist_ItemIni_ItemCompFim = fg_dias_dif_data($itemOk['inicio'], $itemCompararOk['fim']);
                $diasDist_ItemFim_ItemCompFim = fg_dias_dif_data($itemOk['fim'], $itemCompararOk['fim']);

                //fim item loop é depois do início do comparado, portanto tem potencial para unir algo
                if($diasDist_ItemFim_ItemCompIni <= 0){

                    //fim item loop esta dentro da faixa do item comparado
                    if($diasDist_ItemFim_ItemCompFim >= 0){

                        //verificar se item loop inicia antes do comparado, caso sim deve unir, porque inicia antes e termina dentro do periodo comparado
                        if($diasDist_ItemIni_ItemCompIni > 0){

                            //inicio do ausente e antes do item, portanto podemos unir o inicio deste ausente com o que existe, aumentando ele
                            //Ex: item loop 01/01/2000 ~ 15/01/2000, comparando com 10/01/2000 ~ 20/01/2000 = 01/01/2000 ~ 20/01/2000
                            $listaRangeDatas[$keyItemOk] = array('inicio'=>$itemOk['inicio'], 'fim'=>$itemCompararOk['fim']);
                            $removerList[$keyItemCompararOk] = $keyItemOk;
                           
                        // o início do item loop é depois ou no mesmo dia do item comparado, pela cadeia de if anterior o fim do item loop também é antes do fim comparado
                        // isso faz o item do loop estar dentro do item comparado, portanto irrelevante, unido dentro do atual
                        } else {
                            $removerList[$keyItemOk] = $keyItemCompararOk;
                        }

                    //fim do item do loop é depois do item comparado
                    } else if($diasDist_ItemFim_ItemCompFim < 0){

                        if($diasDist_ItemIni_ItemCompIni <= 0){
                                
                            //caso o início do item do loop esteja dentro da faixa do item, mas neste caso o fim é depois, comparado deve unir
                            if($diasDist_ItemIni_ItemCompFim >= 0){
                                //Ex: item loop 10/01/2000 ~ 25/01/2000, comparando com 05/01/2000 ~ 10/01/2000 = 05/01/2000 ~ 25/01/2000
                                $listaRangeDatas[$keyItemOk] = array('inicio'=>$itemCompararOk['inicio'], 'fim'=>$itemOk['fim']);
                                $removerList[$keyItemCompararOk] = $keyItemOk;
                                    
                            }

                        // o início do item loop é antes do item comparado, pela cadeia de if anterior o fim do item loop também é depois do fim comparado
                        // isso faz o item comparado estar dentro do item loop, portanto irrelevante, unido dentro do atual
                        } else if($diasDist_ItemIni_ItemCompIni > 0){
                            $removerList[$keyItemCompararOk] = $keyItemOk;
                        }
                    }
                        
                } // IF dias diff entre fim do item loop e data início do item comparação
                    
            } // IF comparacao key item valido
                        
        } // FOREACH  itens comparacao
                
    } // FOREACH itens
        
    // Limpar keys unidas e irrelevantes
    foreach($removerList as $keyRemove => $valRemove){
            unset($listaRangeDatas[$keyRemove]);
    }
        
    return $listaRangeDatas;
}


?>