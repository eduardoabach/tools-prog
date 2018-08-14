<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>title</title>
		<!--  <link rel="stylesheet" href="style.css">  -->
		<!-- <script src="script.js"></script> -->
	</head>
	<body>
    	<script>
    		navigator.getUserMedia = navigator.webkitGetUserMedia || navigator.getUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
            window.URL = window.URL || window.webkitURL;

            var self = this;
            var camera = contentImage.find('#camera').get(0);
            var foto_preview = contentImage.find('#foto_preview').get(0);
            var foto_tirada = contentImage.find('#foto_tirada').get(0);
            
            contentImage.find('#inicio').click(function (e) {
                    e.preventDefault();
                    if (!navigator.getUserMedia) {
                            App.alerta('É preciso autorizar o navegador para acessar o device.');
                            return false;
                    }
                    
                    navigator.getUserMedia({audio: false, video: true}, function (stream) {
                            foto_ativo = true;
                            contentImage.find('#tirar').enable();
                            
                            if (window.URL) {
                                    camera.src = window.URL.createObjectURL(stream);
                            } else {
                                    camera.src = stream; // Opera.
                            }

                            camera.onerror = function (e) {
                                    stream.stop();
                            };
                            setTimeout(function () {
                                    foto_preview.width = camera.width;
                                    foto_preview.height = camera.height;
                            }, 50);
                    }, function (e) {
                            var msg = 'Nenhuma câmera conectada.';
                            if (e.code == 1) {
                               msg = 'Acesso à câmera negado pelo usuário.';
                            }
                            App.alerta(msg);
                    });
            });
            
            contentImage.find('#tirar').click(function (e) {
                    e.preventDefault();
                    foto_preview.getContext('2d').drawImage(camera, 0, 0, 235, 175);
                    var img = document.getElementById('foto_tirada');
                    foto_tirada.src = foto_preview.toDataURL('image/webp');
                    contentImage.find('#salvar').enable();
                    contentImage.find('#atualizar_unico').enable();
            });
            
            var formImg = contentImage.find('#form-imagem');
            formImg.validate({
                    submitHandler: function (form) {
                            self.SalvarRecadImg(form, {
                                    success: function () {
                                            //implementar
                                    }
                            });
                    }
            });
            
            contentImage.find('#salvar').click(function (e) {
                    e.preventDefault();
                    var foto_tirada_src = foto_tirada.src;
                    contentImage.find('#foto_salvar').val(foto_tirada_src);
                    formImg.submit();
            });
		
    	</script>
	</body>
</html>