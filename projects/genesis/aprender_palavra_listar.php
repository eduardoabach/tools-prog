<?php
   $retornar = $_POST['retornar']; //comportamento
   $local = $_POST['local']; // #listCadPalComp

	include('function.php');
   $lista = listarPalavra();
?>
<table>
   <thead>
      <tr>
         <th>Cod</th>
         <th>Nome</th>
      </tr>
   </thead>
   <tbody>
      <?php foreach($lista as $palavra){ ?>
         <tr <?php if($retornar=='comportamento'){ ?>onclick="compAddPal(this);"<?php } ?> >
            <td class="idPl"><?php echo utf8_encode($palavra['id']); ?></td>
            <td class="nomePl"><?php echo utf8_encode($palavra['nome']); ?></td>
         </tr>
      <?php } ?>
   </tbody>
</table>
<script>
   function compAddPal(e){
      var local = '<?php echo $local;?>';
      var id = $(e).children('.idPl').html();
      var nome = $(e).children('.nomePl').html();
      addPlComp(id,nome,local);
   }
</script>