<textarea rows="20" cols="50" id="textAprenderPalavra">Insira seu texto aqui...</textarea><br>
<input type="submit" name="submit" value="Aprenda" class="bttn" onclick="aprendaPalavra();">

<script>
   function aprendaPalavra(){
      var texto = $('#textAprenderPalavra').val();
      $.ajax({
         url: "aprender_palavra.php",
         type: "POST",
         data: { texto: texto }
      }).done(function( msg ) {
         alert(msg);
      });
   }
</script>
