<?php
date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream\n\n");

while (true) {
  $curDate = date('H:i:s d/m/Y');
  echo 'data: Teste de msd ' . $curDate . "\n\n";

  while (ob_get_level() > 0) {
    ob_end_flush();
  }
  flush();

  //sleep(1); // não tem suporte a segundos parciais, usar usleep()
  // usleep(500000); //0.5s
  usleep(rand(250000,3000000));
}