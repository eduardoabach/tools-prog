@echo off
set nome_rede_padrao=LANHORSE
set senha_rede_padrao=casapink
set versao_sistema=1.0

title Criar Rede Wifi %versao_sistema%
cls

:menu
cls
echo #############################################################################
echo ##########################      Criar Rede %versao_sistema%     ##########################
echo #############################################################################
echo.
echo Para criar uma rede digite 'C'
echo Para desativar uma rede digite 'D'
set /P opcao_menu=
goto menuV%ERRORLEVEL%

:menuV0
goto verificaMenu

:menuV1
set opcao_menu = C
goto verificaMenu

:verificaMenu
if %opcao_menu% == C goto nomeRede
if %opcao_menu% == D goto pararRede
goto menu

:nomeRede
cls
echo insira o nome da rede que deseja criar.
echo caso queira %nome_rede_padrao% ingore essa etapa
set /P nome_rede=
goto redeV%ERRORLEVEL%

:redeV0
goto verificaSenha

:redeV1
set nome_rede = %nome_rede_padrao%
goto verificaSenha

:verificaSenha
cls
echo insira a senha para a rede.
echo caso queira %senha_rede_padrao% ingore essa etapa
set /P senha_rede=
goto senhaV%ERRORLEVEL%

:senhaV0
goto criarRede

:senhaV1
set senha_rede = %nome_rede_padrao%
goto criarRede

:criarRede
cls
echo.
echo configurando sistema da rede...
echo %nome_rede% key=%senha_rede%
netsh wlan set hostednetwork mode=allow ssid=%nome_rede% key=%senha_rede%
echo iniciando rede
netsh wlan start hostednetwork
color 20
echo concluido
pause>null
goto menu

:pararRede
echo parando rede...
netsh wlan stop hostednetwork
color 40
echo concluido
pause>null
goto menu


