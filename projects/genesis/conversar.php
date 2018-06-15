<div class="fechar" onclick="fecharJanela('#telaConversa');">x</div>
<div style="float: left;">
   <h3>Conversar</h3>
   <div id="conteudoConversa">
   </div>
   <input type="text" id="textUser" name="msg" size="30" class="text">
</div>
<div style="float: right; width: 200px;">
   <img src="img/processar.gif" width="200px" />
</div>

<script>
   $('#textUser').on('keyup', function(e) {
      if (e.which == 13 || e.which == 9) {
         e.preventDefault();
         falar();
      }
   });

   function falar(){
      var texto = $('#textUser').val();
      $.ajax({
         url: "pergunta.php",
         type: "POST",
         data: { frase: texto }
      }).done(function( msg ) {
         $("#conteudoConversa").append(msg);
         $("#conteudoConversa").scrollTop(99999);

         $('#textUser').val('');
         $('#textUser').focus();
      });
   }
</script>