<?php

function exemplo_recursividade($tamanhoLateral, $etapa = 1){
        if($etapa <= 0 || $tamanhoLateral <= 0 || ($etapa > $tamanhoLateral))
                return false;

        $qtdEspaco = $tamanhoLateral-$etapa;
        $result = str_pad('', $qtdEspaco, ' ').str_pad('', $etapa, '#');

        if($tamanhoLateral > $etapa){
                $etapa++;
                $proxEtapa = exemplo_recursividade($tamanhoLateral, $etapa);
                if($proxEtapa !== false)
                        $result .= '<br>'.$proxEtapa;
                else
                        return false;
        }

        return $result;
}

echo "<pre>".exemplo_recursividade(6)."</pre>";
echo "<pre>".exemplo_recursividade(3)."</pre>";
echo "<pre>".exemplo_recursividade(0)."</pre>";
echo "<pre>".exemplo_recursividade(10)."</pre>";

?>