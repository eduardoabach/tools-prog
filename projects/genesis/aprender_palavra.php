<?php
	include('function.php');

   $texto = $_POST['texto'];
   getPalavrasAprender($texto);
   echo "Palavras aprendidas senhor.";
?>
