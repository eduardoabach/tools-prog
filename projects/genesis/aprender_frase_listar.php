<?php
	include('function.php');
   $lista = listarFrase();
?>
<table>
   <thead>
      <tr>
         <th>Cod</th>
         <th>Descrição</th>
      </tr>
   </thead>
   <tbody>
      <?php foreach($lista as $frase){ ?>
         <tr>
            <td><?php echo utf8_encode($frase['id']); ?></td>
            <td><?php echo utf8_encode($frase['texto']); ?></td>
         </tr>
      <?php } ?>
   </tbody>
</table>