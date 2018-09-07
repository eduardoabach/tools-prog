<?php

echo strtoupper('Teste de 3 tenTATIvas.'); // TESTE DE 3 TENTATIVAS.
echo strtoupper('teste de 3 tentativas.'); // TESTE DE 3 TENTATIVAS.
echo strtoupper('TESTE DE 3 TENTATIVAS.'); // TESTE DE 3 TENTATIVAS.

echo strtolower('Teste de 3 tenTATIvas.'); // teste de 3 tentativas.
echo strtolower('teste de 3 tentativas.'); // teste de 3 tentativas.
echo strtolower('TESTE DE 3 TENTATIVAS.'); // teste de 3 tentativas.

echo ucfirst('Teste de 3 tenTATIvas.'); // Teste de 3 tenTATIvas.
echo ucfirst('teste de 3 tentativas.'); // Teste de 3 tentativas.
echo ucfirst('TESTE DE 3 TENTATIVAS.'); // TESTE DE 3 TENTATIVAS.

echo ucwords('Teste de 3 tenTATIvas.'); // Teste De 3 TenTATIvas.
echo ucwords('teste de 3 tentativas.'); // Teste De 3 Tentativas.
echo ucwords('TESTE DE 3 TENTATIVAS.'); // TESTE DE 3 TENTATIVAS.

$teste = 'Ana';
echo str_pad($teste, 10); // "Ana       "
echo str_pad($teste, 10, "=-", STR_PAD_LEFT); // "=-=-=-=Ana"
echo str_pad($teste, 10, "_", STR_PAD_BOTH); // "___Ana____"

echo substr('Ana Maria da Silva', 0, 10); //corta texto, "Ana Maria "
echo substr('Sábado', 0, 3); //corta texto, "Sá"
echo mb_substr('Sábado', 0, 3); //corta texto, "Sáb"

?>