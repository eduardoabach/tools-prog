<?php
	include('../function.php');
	include('../ia.php');

	$inf = infIp();
	$so = getSo();
	$engine = getEngineNavegacao();
	$idioma = getIdioma();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<? include('../head.php'); ?>
	</head>
	<body>
		<? include('../menu.php'); ?>
		<div id="conteudo_page_atual">
			
			
			<div class="container tela-branca">
				<div class="sub_container conteudoPage">
					<div id="content">
						<div class="title">
							<h2>Big <span class="byline">Brother</span> esta observando você</h2>
						</div>
						<p>Os dados que seu navegador de internet fornece ao acessar um site podem revelar algumas informações, abaixo trago alguns exemplos:</p>
						
						Ip: <?php echo $inf['ip']?><br>
						Sistema Operacional: <?php echo $so?><br>
						Navegador: <?php echo $inf['navegador']['navegador']?><br>
						Versão Navegador: <?php echo $inf['navegador']['versao']?><br>
<!--						Engine Navegador: <?php echo $engine['nome']?><br>
						Versão Engine: <?php echo $engine['versao']?><br>-->
						Idioma: <?php echo $idioma?><br>
						País: <?php echo $inf['pais']?><br>
						Cidade: <?php echo $inf['cidade']?><br>
					</div>
				</div>
			</div>
			
		</div>
		<? include('../rodape.php'); ?>
	</body>
</html>