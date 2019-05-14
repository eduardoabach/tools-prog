
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Teste de Status</title>
        <style type="text/css">
            .status-verde{color: #3c763d;}
            .status-vermelho{color: #a94442;}
        </style>
    </head>
    <body>
            
    <?php

    function html_request_code(){
        return array(

            //[Informational 1xx]
            100=>"Continue",
            101=>"Switching Protocols",

            //[Successful 2xx]
            200=>"OK",
            201=>"Created",
            202=>"Accepted",
            203=>"Non-Authoritative Information",
            204=>"No Content",
            205=>"Reset Content",
            206=>"Partial Content",

            // [Redirection 3xx]
            300=>"Multiple Choices",
            301=>"Moved Permanently",
            302=>"Found",
            303=>"See Other",
            304=>"Not Modified",
            305=>"Use Proxy",
            306=>"(Unused)",
            307=>"Temporary Redirect",

            // [Client Error 4xx]
            400=>"Bad Request",
            401=>"Unauthorized",
            402=>"Payment Required",
            403=>"Forbidden",
            404=>"Not Found",
            405=>"Method Not Allowed",
            406=>"Not Acceptable",
            407=>"Proxy Authentication Required",
            408=>"Request Timeout",
            409=>"Conflict",
            410=>"Gone",
            411=>"Length Required",
            412=>"Precondition Failed",
            413=>"Request Entity Too Large",
            414=>"Request-URI Too Long",
            415=>"Unsupported Media Type",
            416=>"Requested Range Not Satisfiable",
            417=>"Expectation Failed",

            // [Server Error 5xx]
            500=>"Internal Server Error",
            501=>"Not Implemented",
            502=>"Bad Gateway",
            503=>"Service Unavailable",
            504=>"Gateway Timeout",
            505=>"HTTP Version Not Supported",
        );
    }

    function test_service_status($url=false){
        if(!$url)
            return false;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_USERAGENT, 'spider');
        curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $retcode;
    }

    function get_status_cor($status=''){
        return ($status == '200' || $status == 'Online') ? 'status-verde' : 'status-vermelho';
    }

    $listService = array(
        'Internet - Google' => 'http://www.google.com'
    );

    $listDB = array(
        'DB Test (192.168.1.10)' => "host=192.168.1.10 dbname=exemplo user=postgres password=postgres"
    );
    ?>

    <h4>Teste de Status <small> - <?=date('d/m/Y H:i:s')?></small></h4>

    <hr>

    <?php
    $listCode = html_request_code();
    foreach($listService as $name => $url){
        $status = test_service_status($url);
        $statusLayout = get_status_cor($status);
        echo "<div class='{$statusLayout}'><h4>{$name} - {$status} ".((isset($listCode[$status])) ? $listCode[$status] : '')."</h4></div>";
    }
    ?>

    <hr>

    <?php
    foreach($listDB as $name => $strConect){
        $connection = pg_connect($strConect);
        $status = 'Offline';

        if($connection) {
            pg_close($connection);
            $status = 'Online';
        } 

        $statusLayout = get_status_cor($status);
        echo "<div class='{$statusLayout}'><h4>{$name} - {$status}</h4></div>";
    }
    ?>

    </body>
</html>