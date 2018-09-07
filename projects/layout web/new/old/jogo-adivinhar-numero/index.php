<?php
include('../function.php');
include('../ia.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<? include('../head.php'); ?>
		
		<style>
			.msg {font-size:8pt; font-weight:bold;}
			.board {font-size:9pt; font-weight:bold;}
			.status {font-size:9pt; font-weight:bold;}
			.progress {font-size:8pt; font-weight:bold;}
			.success {font-size:14pt; font-weight:bold;}
			.but {font-size:8pt; font-weight:bold; height:24px; border:0px solid #cccccc; border-left:none; border-right:none;}
			.help {font-size:8pt; margin:0px; font-weight:bold;}
		</style>
		<script language="javascript" src="games.js"></script>
		<script>
			var gtarget, ghi, gtries, gtime, gintervalid;

			function toggleHelp(){
				if (butHelp.value == "Hide Help"){
					help.style.display = "none";
					butHelp.value = "Show Help";
				}else{
					help.style.display = "";
					butHelp.value = "Hide Help";
				}  
			}

			//random number between low and hi
			function rand(low,hi){
				return Math.floor((hi-low)*Math.random()+low); 
			}

			//random number between 1 and hi
			function r1(hi){
				return Math.floor((hi-1)*Math.random()+1); 
			}

			function showMessage(msgstr,classname){
				if (classname != null)
					fldStatus.innerHTML = "<span class=" + classname + ">" + msgstr + "</span>";
				else
					fldStatus.innerHTML = msgstr;
			}

			function stopGame(){
				fldGuess.value = "";
				showMessage('Jogo cancelado.');
				fldProgress.innerHTML = "";
				clearInterval(gintervalid);
				gintervalid=-1;
				fldHi.focus();
			}

			function startGame(){
				gtries = 0;
				gtime = 0;
				ghi = parseInt(fldHi.value);
				gtarget = rand(0,ghi);    
				showMessage("Eu escolhi um número entre 0 e " + ghi + "<br>Faça sua tentativa!");
				clearInterval(gintervalid);
				gintervalid = setInterval("tick()",1000);  
				tick();
				fldGuess.focus();
			}

			function tick(){
				gtime++;
				fldProgress.innerHTML = "Tentativas&nbsp;" + gtries + "&nbsp;&nbsp;&nbsp;&nbsp;Tempo:&nbsp;" + gtime + "&nbsp;segundos"
			}

			function checkGuess(){
				if (gintervalid == -1){
					alert("Selecione \"Novo Jogo\" para iniciar uma nova partida.");
					fldHi.focus();
					return;
				}

				if (fldGuess.value == ""){
					alert("Informe um número no campo.");
					fldGuess.focus();
					return;
				}

				//check if the number entered is proper
				var n = parseInt(fldGuess.value);

				if (isNaN(n)){
					alert("Número inválido.");
					fldGuess.focus();
					return;
				}

				//check range
				if (n < 0 || n > ghi){
					alert("Informe um número entre 0 e " + ghi + ".");
					fldGuess.focus();
					return;
				}

				fldGuess.value = n;

				gtries++;  

				if (n < gtarget){
					showMessage("Seu número  é MENOR");
					fldGuess.select();
					return;
				}
				if (n > gtarget){
					showMessage("Seu número  é MAIOR");
					fldGuess.select();
					return;
				}
				if (n == gtarget){
					stopGame();
					showMessage("Parabéns!<br>Você resolveu em " + gtries + " tentativas e " + gtime + " segundos!","success");
					return;
				}
			}

			toggleHelp();
			stopGame();
		</script>
		
	</head>
	<body>
		<? include('../menu.php'); ?>
		<div id="conteudo_page_atual">
			<div class="container tela-branca">
				<div class="sub_container conteudoPage">
					<div id="content">
						<div class="title">
							<h2>Adivinhar <span class="byline">número</span></h2>
						</div>
						
						<table class="board">
							<tbody>
								<tr>
									<td align="right" width="49%">Escolha o Nível:</td>
									<td align="center">
										<select class="board" id="fldHi" onkeypress="if (event.keyCode==13) startGame();">
											<script>
												var sel;
												for (var i=10;i<=1000000;i*=10){
													if (i==1000) sel=" selected "; else sel=" ";
													document.writeln("<option" + sel + "value='" + i + "'>" + i + "</option>");
												}
											</script>
										</select>
									</td>
									<td width="49%">
										<input class="but" type="button" value="Novo Jogo" id="butStart" onclick="startGame();">
									</td>
								</tr>

								<tr>	<td colspan="3" align="center"><div id="fldStatus" class="status"></div></td></tr>

								<tr>
									<td colspan="3" align="center"><div id="fldProgress" class="progress"></div></td>
								</tr>
								<tr>
									<td align="right" width="49%">Seu número: </td>
									<td align="center">
										<input class="board" type="text" size="10" id="fldGuess" onkeypress="if (event.keyCode==13) checkGuess();">
									</td>
									<td>
										<input class="but" type="button" value="Tentar!" onclick="checkGuess();">
									</td>
								</tr>
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</div>
		<? include('../rodape.php'); ?>
	</body>
</html>