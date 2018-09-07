<?php
   function getNomeBot(){
      return 'Genesis';
   }

   function query($sql,$tipo=''){
      $mysqli = new mysqli('127.0.0.1', 'root', 'root', 'genesis');
      if (mysqli_connect_errno()) {
          printf("Conexao falhou: %s\n", mysqli_connect_error());
          exit();
      }

      $dados = array();
      $result = $mysqli->query($sql);
      if($tipo != 'insert'){
         while($row = $result->fetch_array()){
            $dados[] = $row;
         }
         $result->free();
         $mysqli->close();
      }
      return $dados;
   }

	function getMessage($dados){
		if (isset($dados['msg'])) {
			$usermessage = $dados['msg'];
			$default = FALSE;
		 } else {
			$usermessage = 'Conectado!';
			$default = TRUE;
		 }
         $htmlcharacters = array("<", ">", "&amp;", "&lt;", "&gt;", "&");
         $usermessage = str_replace($htmlcharacters, "", $usermessage);
         $msg = stripslashes($usermessage);
		 return $msg;
	}

   function criterioArray($listCrit){
      $sql = '';
      foreach($listCrit as $crit){
         if($sql)
            $sql .= ' and ';
         else
            $sql .= 'where ';
         $sql .= $crit;
      }
      return $sql;
   }

   function buscarPalavras($frase){
      $listPal = explode(' ',$frase);
      $listIn = implode("','",$listPal);
      $sql = "select nome,id from palavras where nome in('$listIn')";
      $dados = query($sql);

      $lista = array();
      foreach($dados as $inf){
         $lista[] = $inf['id'];
      }

      return $lista;
   }

   function buscarAcoes($listIdPal){
      $listSqlPal = implode("','",$listIdPal);

      $criterio =array();
      $criterio[] = "pa.pal_id in('$listSqlPal')";
      $criterioSql = criterioArray($criterio);

      $sql = "
         select
            fa.acao_id,
            count(*) precisao
         from
            gp_frases_acoes fa
         left join
            gp_palavras_acoes pa on pa.frase_acao_id = fa.id
         $criterioSql
         group by
            fa.acao_id
         order by
            precisao";
      $dados = query($sql);
      $list = array();
      $list[] = $dados[0]['acao_id'];
      return $list;
   }

   function listarFrase(){
      $sql = "select f.id,f.texto from frases f order by f.id desc";
      $dados = query($sql);
      return $dados;
   }

   function listarPalavra(){
      $sql = "select p.id,p.nome from palavras p order by p.id desc";
      $dados = query($sql);
      return $dados;
   }

   function buscarFrase($listIdAcoes){
      $listSql = implode("','",$listIdAcoes);

      $criterio =array();
      $criterio[] = "raf.acao_id in('$listSql')";
      $criterioSql = criterioArray($criterio);
      $sql = "
         select
            f.id,
            f.texto,
            count(*) precisao
         from
            frases f
         left join
            relacao_acao_frases raf on raf.frase_id = f.id
         $criterioSql
         group by
            f.id
         order by
            precisao";
      $dados = query($sql);
      return $dados[0]['texto'];
   }

   function buscarResposta($frase){
      $listIdPal = buscarPalavras($frase);
      $listIdAcoes = buscarAcoes($listIdPal);
      $frase = buscarFrase($listIdAcoes);
      return $frase;
   }

   function inserirPalavras($nome){
      query("insert into palavras(nome) values('$nome')",'insert');
   }

   function aprenderFrase($frase){
      query("insert into frase(nome) values('$frase')",'insert');
   }

   function getPalavrasTxt($caminho){
      $ponteiro = fopen ($caminho,"r");
      while (!feof ($ponteiro)) {
         $linha = fgets($ponteiro,4096);
         getPalavrasAprender($linha);
      }
      fclose($ponteiro);
   }

   function retirarCaractEspec($palavra){
      $a = strtr($palavra, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ", "aaaaeeiooouucAAAAEEIOOOUUC");
      return $a;
   }

   function retirarCaract($S){
      $C = array('.',',','<','>',':',';','!','?','/','\\','|','#','*',"'",'"','[',']','{','}','(',')');
      return str_replace($C,' ',$S);
   }

   function palavraIgnorar(){
      $pl = array('a','as','e','es','i','o','os','u','us','um','uns','uma','umas','ele','eles','ela','elas',
          'de','des','da','das','do','dos','di','se','so','em','na','nas','no','nos',
          'que','quem','aquem','qual','aqual','quais','esse','este','estes','esta','estas');
      return $pl;
   }

   function getPalavrasAprender($texto){
      $pl = palavraIgnorar();
      $lista = explode(' ',$texto);
      foreach($lista as $pal){
         $strTrat = strtoupper(trim(retirarCaract(retirarCaractEspec($pal))));
         if(strlen($strTrat) > 1){
            if(!in_array($strTrat, $pl))
               inserirPalavras(utf8_decode(trim(retirarCaract($pal))));
         }
      }
   }

   function infIp($ip=''){
      if($ip == "")
         $ip = $_SERVER['REMOTE_ADDR'];
      $info = file('http://api.hostip.info/rough.php?ip='.$ip);

      $return = array();
      $return['ip'] = $ip;
      $return['pais'] = substr($info[0], 9);
      $return['cidade'] = substr($info[2], 6);
      $return['navegador'] = getNavegador();

      return $return;
   }

   function getNavegador(){
      $list = array();
      $useragent = $_SERVER['HTTP_USER_AGENT'];
      if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
        $list['versao'] = $matched[1];
        $list['navegador'] = 'IE';
      } elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
        $list['versao'] = $matched[1];
        $list['navegador'] = 'Opera';
      } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
        $list['versao'] = $matched[1];
        $list['navegador'] = 'Firefox';
      } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
        $list['versao'] =$matched[1];
        $list['navegador'] = 'Chrome';
      } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
        $list['versao'] =$matched[1];
        $list['navegador'] = 'Safari';
      } elseif(preg_match('|Flock/([0-9\.]+)|',$useragent,$matched)) {
        $list['versao'] =$matched[1];
        $list['navegador'] = 'Flock';
      } else {
        $list['versao'] = 0;
        $list['navegador'] = 'Outro';
      }
      return $list;
   }

   function getSo(){
      $uAgent = $_SERVER['HTTP_USER_AGENT'];
      $so = 'Desconhecido';

      if (preg_match('/linux/i', $uAgent)) {
          $so = 'Linux';
      }
      elseif (preg_match('/macintosh|mac os x/i', $uAgent)) {
          $so = 'Mac';
      }
      elseif (preg_match('/windows|win32/i', $uAgent)) {
          $so = 'Windows';
      }
      return $so;
   }

   function getIdioma() {
      $idioma =substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
      return $idioma;
   }

   function getEngineNavegacao(){
      $navigator_user_agent = ' ' . strtolower($_SERVER['HTTP_USER_AGENT']);
      $engine = '';

      if (strpos($navigator_user_agent, "trident")) {
         $engine['nome'] = 'TRIDENT';
         $engine['versao'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "trident/") + 8, 3));
      } elseif (strpos($navigator_user_agent, "webkit")) {
         $engine['nome'] = 'WEBKIT';
         $engine['versao'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "webkit/") + 7, 8));
      } elseif (strpos($navigator_user_agent, "presto")) {
         $engine['nome'] = 'PRESTO';
         $engine['versao'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "presto/") + 6, 7));
      } elseif (strpos($navigator_user_agent, "gecko")) {
         $engine['nome'] = 'GECKO';
         $engine['versao'] = floatval(substr($navigator_user_agent, strpos($navigator_user_agent, "gecko/") + 6, 9));
      } elseif (strpos($navigator_user_agent, "robot"))
         $engine['nome'] = 'ROBOTS';
      elseif (strpos($navigator_user_agent, "spider"))
         $engine['nome'] = 'ROBOTS';
      elseif (strpos($navigator_user_agent, "bot"))
         $engine['nome'] = 'ROBOTS';
      elseif (strpos($navigator_user_agent, "crawl"))
         $engine['nome'] = 'ROBOTS';
      elseif (strpos($navigator_user_agent, "search"))
         $engine['nome'] = 'ROBOTS';
      elseif (strpos($navigator_user_agent, "w3c_validator"))
         $engine['nome'] = 'VALIDATOR';
      elseif (strpos($navigator_user_agent, "jigsaw"))
         $engine['nome'] = 'VALIDATOR';
      return $engine;
   }
?>