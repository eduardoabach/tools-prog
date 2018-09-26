<?php

include('core.php');

$data = $_POST;
$conn = getConection();
pg_query($conn, "INSERT INTO public.msg(sala, nick, msg) VALUES ('{$data[sala]}', '{$data[nick]}', '{$data[msg]}');");

jSucess('Mensagem enviada');

?>