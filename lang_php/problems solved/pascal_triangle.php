<?php

// Minha resolução, usando array da ultima linha
// No meu posso basear o triangulo em quanquer número inicial
$repeticoes = 15;
$numIni = 1;
$linhaOld = array();

for($posHoriz = 1; $posHoriz <= $repeticoes; $posHoriz++){
        $linhaAt = null;

        //estrutura lateralmente triangulo
        for($posVert = 1; $posVert <= $posHoriz; $posVert++){
                
                $valItem = $numIni;
                if($posHoriz != 1){
                        $keyArrA = $posVert-2;
                        $keyArrB = $posVert-1;
                        $valA = (isset($linhaOld[$keyArrA])) ? $linhaOld[$keyArrA] : 0;
                        $valB = (isset($linhaOld[$keyArrB])) ? $linhaOld[$keyArrB] : 0;
                        $valItem = $valA+$valB;
                }
                
                // primeiro número da linha não tem espaço
                $linhaAt .= ($linhaAt == null) ? $valItem : ' '.$valItem;
                
        }

        echo $linhaAt.'<br>';
        $linhaOld = explode(' ', $linhaAt);
}

?>



<?php  
 
// Solução que encontrei na web, matematicamente com fatoração
// É fixo com número inicial 1.
function factorial($n){
    return ($n < 2) ? 1 : $n * factorial($n-1);
}

function pascal($n){
    for($posHoriz=0; $posHoriz<$n; $posHoriz++){
        for($posVert=0; $posVert<($posHoriz+1); $posVert++){
            echo factorial($posHoriz) / (factorial($posVert) * factorial($posHoriz - $posVert));
            echo " ";
        }
        
        echo "<br>";
    }
}
pascal(15);
?>
