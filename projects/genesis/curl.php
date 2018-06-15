<?php
   $ch = curl_init();
   // informar URL e outras funções ao CURL
   curl_setopt($ch, CURLOPT_URL, "http://www.google.com.br/");
   curl_setopt($ch, CURLOPT_USERAGENT, 'G.E.N.E.S.I.S Spider 1.0');
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   // Acessar a URL e retornar a saída
   $output = curl_exec($ch);
   // liberar
   curl_close($ch);
   // Imprimir a saída
   echo $output;
?>
