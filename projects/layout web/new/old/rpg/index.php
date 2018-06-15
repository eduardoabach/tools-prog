<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Eduardo Bach - Web Developer</title>
		<script type="text/javascript" defer src="jquery-1.10.2.min.js"></script>
	</head>
	<body>
		<div id="teste">
			<?php
			$raca = array();
			$raca[] = 'Meio Ork';
			$raca[] = 'Humano';
			$raca[] = 'Gnomo';
			$raca[] = 'Meio Elfo';
			$raca[] = 'Elfo';
			$raca[] = 'Anao';
			$raca[] = 'Hobbit';

			$classe = array();
			$classe[] = 'Barbaro';
			$classe[] = 'Bardo';
			$classe[] = 'Druida';
			$classe[] = 'Ladino';
			$classe[] = 'Monge';
			$classe[] = 'Paladino';
			$classe[] = 'Guerreiro';
			$classe[] = 'Caçador';
			$classe[] = 'Mago';
			$classe[] = 'Feiticeiro';

			$sexo = array();
			$sexo[] = 'Masculino';
			$sexo[] = 'Feminino';
			?>
			<script>
				function criarPersonagem(){
					var forSerial = $('#formDadosPerson').serialize();
					$.post('function.php',forSerial,
					function(response) {
						$("#personagemGerado").html(unescape(response));
					});
				}
			</script>

			<form  id="formDadosPerson" >
				<div class="optCriar">
					<label>Sexo:</label>
					<select name="sexo">
						<option value="">Aleatório</option>
						<?php foreach ($sexo as $opt) { ?>
							<option><?php echo $opt; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="optCriar">
					<label>Raça:</label>
					<select name="raca">
						<option value="">Aleatório</option>
						<?php foreach ($raca as $opt) { ?>
							<option><?php echo $opt; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="optCriar">
					<label>Classe:</label>
					<select name="classe">
						<option value="">Aleatório</option>
						<?php foreach ($classe as $opt) { ?>
							<option><?php echo $opt; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="optCriar">
					<label>Idade:</label>
					<input type="text" name="idade_min" value="16">até<input type="text" name="idade_max" value="55"/> anos
				</div>
				<div class="optCriar">
					<label>Peso:</label>
					<input type="text" name="peso_min" value="45">até<input type="text" name="peso_max" value="120"/>kg
				</div>
				<div class="optCriar">
					<label>Altura:</label>
					<input type="text" name="altura_min" value="100">até<input type="text" name="altura_max" value="220"/>cm
				</div>
			</form>

			<div onclick="criarPersonagem();">Gerar</div>
			<div id="personagemGerado"></div>
		</div>
	</body>
</html>