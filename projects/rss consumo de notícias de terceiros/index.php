<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>RSS Notícias</title>
		<!--  <link rel="stylesheet" href="style.css">  -->
		<!-- <script src="script.js"></script> -->
	</head>
	<body>
    	<?php
			$listRss = array(
			   array('nome'=>'Google News - Mundo','link'=>'https://news.google.com/news/rss/headlines/section/topic/WORLD?ned=pt-BR_br&gl=BR&hl=pt-BR'),
			   array('nome'=>'Google News - Brasil','link'=>'https://news.google.com/news/rss/headlines/section/topic/NATION.pt-BR_br/Brasil?ned=pt-BR_br&hl=pt-BR&gl=BR'),
			   array('nome'=>'Google News - Rio Grande do Sul','link'=>'https://news.google.com/news/rss/search/section/q/rio%20grande%20do%20sul/rio%20grande%20do%20sul?hl=pt-BR&gl=BR&ned=pt-BR_br'),
			    
			//    array('nome'=>'G1 - Geral','link'=>'http://pox.globo.com/rss/g1/'),
			//    array('nome'=>'G1 - Mundo','link'=>'http://pox.globo.com/rss/g1/mundo/'),
			//    array('nome'=>'G1 - Brasil','link'=>'http://pox.globo.com/rss/g1/brasil/'),
			//    array('nome'=>'G1 - Rio Grande do Sul','link'=>'http://pox.globo.com/rss/g1/rs/rio-grande-do-sul/'),
			//    array('nome'=>'G1 - Economia','link'=>'http://pox.globo.com/rss/g1/economia/'),
			//    
			//    array('nome'=>'Diário Gaúcho - Últimas Notícias','link'=>'http://diariogaucho.clicrbs.com.br/rs/ultimas-noticias-rss/'),
			//    array('nome'=>'Diário Gaúcho - Dia-a-dia','link'=>'http://diariogaucho.clicrbs.com.br/rs/dia-a-dia/ultimas-noticias-rss/'),
			//    
			//    array('nome'=>'Infomoney - Ações e Índices','link'=>'http://www.infomoney.com.br/mercados/acoes-e-indices/rss'),
			//    array('nome'=>'Infomoney - Bitcoin','link'=>'http://www.infomoney.com.br/mercados/bitcoin/rss'),
			//    array('nome'=>'Infomoney - Startups','link'=>'http://www.infomoney.com.br/negocios/startups/rss'),
			    
			//    array('nome'=>'Olhar Digital','link'=>'https://olhardigital.com.br/rss/'),
			//    
			//    array('nome'=>'TechCrunch','link'=>'http://feeds.feedburner.com/TechCrunch/'),
			    
			);


			foreach($listRss as $itRss){
			    $feed = file_get_contents($itRss['link']);
			    $rss = new SimpleXmlElement($feed);

			    echo "<hr><h1>{$itRss['nome']}</h1><br>";
			//    print_r('<pre>');
			//    print_r($rss);
			//    print_r('</pre>');

			    foreach($rss->channel->item as $it) {
			        $dataAjust = date("d/m/Y H:i:s", strtotime($it->pubDate));
			        echo "$dataAjust<br>";
			        echo "<a href='$it->link'>$it->title</a><br>";
			//        if($it->description)
			//            echo $it->description;
			    }
			}

    	?>
	</body>
</html>