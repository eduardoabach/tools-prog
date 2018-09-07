<?php
	include('function.php');
   $frase = $_POST['frase'];
?>
<div class="vocediz"><small><?=date("d/m H:i")?></small> Você: <?=$frase?></div>
<?php
   $roboNome = getNomeBot();
   $resp = buscarResposta($frase);
   //d/m/y H:i:s
?>
<div class="progdiz"><small><?=date("d/m H:i")?></small> <?php echo $roboNome?>: <?=utf8_encode($resp)?></div>