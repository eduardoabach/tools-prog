<?php
// Hora atual
echo date('h:i:s') . "\n";

// Dorme por 10 segundos
sleep(10); // funciona para segundos fechados, decimais não, para isso usar usleep

// Acorde!
echo date('h:i:s') . "\n";

// ######################################
    
// hora atual
echo date('h:i:s') . "\n";
    
// espera 0,2 segundos, portanto 200ms
usleep(200000); // trabalha com milionésimos de segundos, então ($segundos * 1000000)
    
// de volta!
echo date('h:i:s') . "\n";