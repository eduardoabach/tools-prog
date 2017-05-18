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

// ######################################

// PHP 5~7, Para uma melhor precisão pode usar time_nanosleep, aqui 2segundo e 100 milisegundos
$nano = time_nanosleep(2, 100000);
if ($nano === true) {
    echo "Esperou por 2 segundos e 100 milisegundos.";
} elseif ($nano === false) {
    echo "Falha na espera.";
} elseif (is_array($nano)) {
    $seconds = $nano['seconds'];
    $nanoseconds = $nano['nanoseconds'];
    echo "Interrompido por um sinal.";
    echo "Time remanescente: $seconds segundos, $nanoseconds nanosegundos.";
}