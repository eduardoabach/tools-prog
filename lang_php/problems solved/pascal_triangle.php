
<div style="text-align: center;">
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
                $linhaAt .= ($linhaAt == null) ? $valItem : ' | '.$valItem;
                
        }

        echo '| '.$linhaAt.' |<br>';
        $linhaOld = explode(' | ', $linhaAt);
}

?>
</div>

