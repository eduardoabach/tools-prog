<textarea rows="20" cols="50" id="textAprenderFrase">Insira seu texto aqui...</textarea><br>
<input type="submit" name="submit" value="Aprenda" class="bttn" onclick="aprendaFrase();">

<script>
   function aprendaFrase(){
      var texto = $('#textAprenderFrase').val();
      $.ajax({
         url: "aprender_frase.php",
         type: "POST",
         data: { texto: texto }
      }).done(function( msg ) {
         alert(msg);
      });
   }
</script>
