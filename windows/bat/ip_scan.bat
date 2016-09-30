@echo off
set segmento_inicial=10.1.1
set /a endereco_inicial=2
set /a endereco_final=254
set versao_sistema=1.0

title Buscar Ip Ping Rede %versao_sistema%
cls

:menu
cls
echo #############################################################################
echo ####################      Buscar Ip Ping Rede %versao_sistema%     ######################
echo #############################################################################

echo.
echo Segmento Inicial da busca: %segmento_inicial%
echo Endereço Inicial:  %segmento_inicial%.%endereco_inicial%
echo Endereço Final:  %segmento_inicial%.%endereco_final%
echo ---------------------------------------------------------------------
echo Escolha a letra para iniciar busca ou alterar configurações
echo [S] Alterar segmento inicial
echo [I] Alterar endereço inicial
echo [F] Alterar endereço final

pause

:fazerBusca
FOR /L %i in (2,1,254) DO ping 10.1.1.%i;

pause