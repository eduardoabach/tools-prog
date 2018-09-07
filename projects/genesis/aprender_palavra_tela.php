<?php
   $retornar = $_POST['retornar']; //comportamento
   $local = $_POST['local']; // #listCadPalComp
?>
<div class="fechar" onclick="fecharJanela('#ensinar');">x</div>
<h3>Palavras</h3>
<input type="submit" name="submit" value="Cadastro" class="bttn" onclick="aprendaPalavraTela();">
<input type="submit" name="listar" value="Listar" class="bttn" onclick="listarPalavra();">
<div id="telaConteudoPalavra"></div>

<script>
   function aprendaPalavraTela(){
      $.ajax({
         url: "aprender_palavra_cadastro.php",
         type: "POST"
      }).done(function( html ) {
         $('#telaConteudoPalavra').html(html);
      });
   }
   function listarPalavra(retornar,local){
      var data = {retornar:retornar,local:local};
      $.ajax({
         url: "aprender_palavra_listar.php",
         type: "POST",
         data: data
      }).done(function( html ) {
         $('#telaConteudoPalavra').html(html);
      });
   }
   <?php if($retornar == 'comportamento'){ ?>
      listarPalavra('<?php echo $retornar;?>','<?php echo $local;?>');
   <?php } else {?>
      aprendaPalavraTela();
   <?php } ?>
</script>
