<?php 

/* ------------------- CONFIG ------------------- */

// Aceita jpg, gif, png
//$tipoImagem = 'gif';
//$tipoImagem = 'jpg';
$tipoImagem = 'png';

//Qualidade varia de 0~100
$nomeArquivo = null;
$qualidade = 100; // somente jpg
// pode ser 1~5.
$fontSize = 5;

/* ------------------- EXEC ------------------- */

// Usando utf8, o padrão do imagestring() é latin...
setlocale(LC_MONETARY, 'en_GB.UTF-8'); 

$imagem = imagecreate(240,140);
// O imagecolorallocate() pela primeira vez, assume essa cor como fundo da imagem
imagecolorallocate($imagem, 166, 0, 0);
// Cor do Texto, cores em RGB
$texto = imagecolorallocate($imagem, 255, 255, 255);

// imagestring() escreve texto, posição varia em X e Y.
imagestring($imagem, $fontSize, 10, 30, 'Texto 1', $texto);
imagestring($imagem, $fontSize, 50, 80, 'Bem simples.', $texto);

if ($tipoImagem == 'gif' && function_exists("imagegif")) {
    header("Content-type: image/gif");
    imagegif($imagem, $nomeArquivo);
} elseif ($tipoImagem == 'jpg' && function_exists("imagejpeg")) {
    header("Content-type: image/jpeg");
    imagejpeg($imagem, $nomeArquivo, $qualidade);
} elseif ($tipoImagem == 'png' && function_exists("imagepng")) {
    header("Content-type: image/png");
    imagepng($imagem);
} else {
    die("Não tem suporte ao tipo de imagem ".$tipoImagem);
}

// Limpar a memória utilizada
imagedestroy($imagem);
?>
