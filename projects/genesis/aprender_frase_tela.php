<div class="fechar" onclick="fecharJanela('#ensinarF');">x</div>
<h3>Ensinar Frase</h3>
<input type="submit" name="submit" value="Cadastro" class="bttn" onclick="aprendaFraseTela();">
<input type="submit" name="listar" value="Listar" class="bttn" onclick="listarFrases();">
<div id="telaConteudoFrase"></div>

<script>
   function aprendaFraseTela(){
      $.ajax({
         url: "aprender_frase_cadastro.php",
         type: "POST"
      }).done(function( html ) {
         $('#telaConteudoFrase').html(html);
      });
   }
   function listarFrases(){
      $.ajax({
         url: "aprender_frase_listar.php",
         type: "POST"
      }).done(function( html ) {
         $('#telaConteudoFrase').html(html);
      });
   }
   aprendaFraseTela();
</script>
