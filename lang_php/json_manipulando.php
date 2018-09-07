<?php

echo json_encode("teste");

// ###########################################################

$string = "minha string";
$fp = fopen('arquivo.json', 'w');
fwrite($fp, json_encode($string));
fclose($fp);   

// ###########################################################

$noticias = array(
array(
    "titulo" => "noticia 1",
    "corpo" => "corpo da noticia 1",
    "data" => "02/07/2014"
    ),

array(
    "titulo" => "noticia 2",
    "corpo" => "corpo da noticia 2",
    "data" => "02/07/2014"
),

array(
    "titulo" => "noticia 3",
    "corpo" => "corpo da noticia 3",
    "data" => "02/07/2014"
),

array(
    "titulo" => "noticia 4",
    "corpo" => "corpo da noticia 4",
    "data" => "02/07/2014"
)
);

echo json_encode($noticias);

// ###########################################################

 
// Atribui o conteúdo do arquivo para variável $arquivo
$arquivo = file_get_contents('cadastro.json');
 
// Decodifica o formato JSON e retorna um Objeto
$json = json_decode($arquivo);
 
// Loop para percorrer o Objeto
foreach($json as $registro):
    echo 'Código: ' . $registro->codigo . ' - Nome: ' . $registro->nome . ' - Telefone: ' . $registro->telefone . '<br>';
endforeach;


?>