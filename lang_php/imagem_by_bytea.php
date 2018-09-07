<?php
	function create_image_from_bytea($bytea, Array $options = array()){
		$defaults = array(
			'largura'                  => 100,
			'altura'                   => 100,
			'qualidade'                => 100,
			'mostrar_propriedades'     => false,
			'class'                    => '',
			'render_tamanho_parametro' => false //Exibe a imagem no tamanho passo por parâmetro
		);

		$configs = (object)array_merge($defaults, $options);
		$src     = imagecreatefromstring(pg_unescape_bytea($bytea));
		$width   = imagesx($src);
		$height  = imagesy($src);

		$escala = min($configs->largura / $width, $configs->altura / $height);
		// Se a imagem é maior que o permitido, encolhe ela!
		if ($escala < 1) {
			$configs->largura = floor($escala * $width);
			$configs->altura  = floor($escala * $height);
		}

		$img = imagecreatetruecolor($configs->largura, $configs->altura);
		imagecopyresampled($img, $src, 0, 0, 0, 0, $configs->largura, $configs->altura, $width, $height);

		ob_start();
		imagejpeg($img, null, $configs->qualidade);
		imagedestroy($img);

		$imagem = ob_get_contents();
		ob_clean();
		ob_end_flush();
		
		// Retorna a imagem com a altura e largura passada pelo parâmentro($options)
		if ($configs->render_tamanho_parametro == true) {
			$htmlLargura = 'width="'.$options['largura'].'"';
			$htmlAltura = 'height="'.$options['altura'].'"';
			return '<img '.$htmlLargura.' '.$htmlAltura." src=\"data:image/jpg;base64,".base64_encode($imagem)."\">";
		}

		return vsprintf('<img %s %s src="data:image/jpg;base64,%s">', array(
			($configs->mostrar_propriedades ? sprintf('width="%s" height="%s"', $width, $height) : ''),
			(count($configs->class) ? sprintf('class="%s"', $configs->class) : ''),
			base64_encode($imagem)
		));
	}
?>