<?
//fatoração

function fatoracao_numeros_primos($numOrig){
        $primos = array(2,3,5,7,11,13,17,19,23,29,31,37,41,43,47,53,59,61,67,71,73,79,83,89,97,101,103,107,109,113,127,131,137,139,149);
        $listFatoracao = array();
        $terminou = 'Lista de números primos insuficiente.';

        $numFat = $numOrig;
        foreach($primos as $primo){
                if($primo>$numOrig){
                        $numFat = 1;
                        $terminou = 'Erro na fotaração.';
                        break;
                }

                for(;gmp_div_r($numFat,$primo) === 0;){ // resto da divisao, zero significa divisao perfeita
                        $listFatoracao[$primo] = (isset($listFatoracao[$primo]))?$listFatoracao[$primo]+1:1;
                        $numFat = gmp_strval(gmp_div_q($numFat,$primo)); // divide inteiros
                }

                if($numFat == 1){
                        $terminou = true;
                        break;
                }
        }
        
        if($terminou === true)
                return $listFatoracao;
        return $terminou;
}

function fatorar_raiz_quadrada($numOrig){
        $result = '';
        $fatoracao = fatoracao_numeros_primos($numOrig);
        
        if(is_array($fatoracao) && count($fatoracao) > 0){
                $resultFatNumero = 0;
                $resultFatRaiz = array();
                
                foreach($fatoracao as $fator => $qtd){
                        if($qtd > 1){
                                $agrupamentoPares = gmp_div_q($qtd, 2); // divide por dois, simples, retorna inteiro
                                $resultPares = $fator * gmp_strval($agrupamentoPares); // os pares são tirados da raiz quadrada, portanto numeros normais no resultado;
                                $resultFatNumero = ($resultFatNumero > 0) ? $resultFatNumero*$resultPares : $resultPares;

                                $restoImpar = gmp_div_r($qtd, 2);
                                if($restoImpar > 0){
                                        $resultFatRaiz[] = "raiz quadrada(".gmp_strval($fator).")"; 
                                }
                        } else {
                                $resultFatRaiz[] = "raiz quadrada($fator)"; 
                        }
                }
                
                if($resultFatNumero > 0){
                        $result = $resultFatNumero;
                }
                
                if(count($resultFatRaiz) > 0){
                        $resultFatRaiz = implode(' * ',$resultFatRaiz);
                        if($result != '') // caso exista numerico, multiplicar por este
                                $result .= ' * ';
                        
                        $result .= $resultFatRaiz;
                }
        } else {
                $result = "<b>$fatoracao<b><br>";
        }
        
        return $result;
}

$numOrig = 1992;
$fatoracao = fatorar_raiz_quadrada($numOrig);
echo "raiz quadrada de $numOrig: $fatoracao";

?>