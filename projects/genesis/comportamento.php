<?php
	include('function.php');

?>
<div class="fechar" onclick="fecharJanela('#comportamento');">x</div>
<h3>Comportamento</h3>
<style>
   .boxComp{
      border: 2px solid #5555cc;
      width: 300px;
      min-height: 300px;
      margin-left: 3px;
   }
   .topBoxComp{
      width: 100%;
      height: 20px;
      background-color: #aaaaee;
      text-align: center;
      color: #ffffff;
      font-size: 16px;
   }
   .optBuscComp{
      float: right;
      display: inline-block;
      width: 20px;
      height: 20px;
      cursor: pointer;
      background-image: url("img/buscar.png");
      background-repeat: no-repeat;
      background-position: center;
      background-size: 15px;
      background-color: #5555cc;

      -webkit-border-radius: 0px 0px 0px 30%;
      -moz-border-radius: 0px 0px 0px 30%;
      border-radius: 0px 0px 0px 30%;
   }
   .optAddComp{
      float: right;
      display: inline-block;
      width: 20px;
      height: 20px;
      cursor: pointer;
      background-image: url("img/add.png");
      background-repeat: no-repeat;
      background-position: center;
      background-size: 15px;
      background-color: #5555cc;

      -webkit-border-radius: 0px 0px 0px 30%;
      -moz-border-radius: 0px 0px 0px 30%;
      border-radius: 0px 0px 0px 30%;
   }
   .gpPalComp{
      border: 2px solid #cccccc;
      display: inline-block;
      padding: 3px;
      margin: 3px 0px 0px 3px;
      min-height: 30px;
      width: 250px;
   }
   .itPlComp{
      display: inline-block;
      padding: 3px;
      margin: 3px 0px 0px 3px;
      background-color: #5555cc;
   }
</style>
<div>
   <form name="comportamentoForm" id="comportamentoForm">
      <div id="telaPartComp">
         Nome Ação:<input type="text" name="data[acao][nome]">
         <input type="submit" value="Aprenda" class="bttn">
      </div>
      <div id="telaPartPal" class ="boxComp" style=" float: left;">
         <div class="topBoxComp">Palavras <div class="optAddComp" id="addGpPalComp" onclick="addGpPalavraComp();"></div></div>
         <div id="listCadPalComp"></div>
      </div>
      <div id="telaPartFrase" class ="boxComp" style="float: right;">
         <div class="topBoxComp">Frases<div class="optBuscComp"></div></div>
      </div>
   </form>
   <div id="buscaPalavraComp" class="blocoT" style="display: none;"></div>
</div>
<script>
   function buscarPalavraComp(e){
      var idGp = $(e).attr('cod');
      abrirAprenderPalavra('comportamento','#'+idGp);
   }
   function addGpPalavraComp(){
      var id = '#addGpPalComp';
      var cod = $(id).attr('cont');
      if(cod == undefined)
         cod = 1;
      else
         cod++;
      $(id).attr('cont',cod);

      html = "<div class='gpPalComp' id='gpPalComp"+cod+"'><div class='optBuscComp' cod='gpPalComp"+cod+"' onclick='buscarPalavraComp(this);'></div></div>";
      $('#listCadPalComp').append(html);
   }
   function addPlComp(id,nome,local){
      var html = "<div class='itPlComp'><input type='hidden' name='data[gp]["+local+"][palavra]["+id+"]' value='"+id+"'>"+nome+"</div>";
      $(local).append(html);
   }
   addGpPalavraComp();
</script>