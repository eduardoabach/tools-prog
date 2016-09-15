@echo off
set nome_rede_padrao=LANHORSE
set senha_rede_padrao=casapink
set versao_sistema=1.14

title Bloquear %versao_sistema%
cls

:menu
cls
echo Bloquear %versao_sistema%
echo.
echo Para bloquear uma pasta digite 'B'
echo Para desbloquear uma pasta digite 'D'
set /P opcao_menu=
goto menuV%ERRORLEVEL%

:menuV0
goto verificaMenu

:menuV1
goto menu

:verificaMenu

::vamos coletar a unidade
echo.
echo Digite a letra da unidade da sua pasta, C, D, E...
set /P unidade=
%unidade%:

::agora o caminho do arquivo para bloquear/liberar
echo.
echo Insira o caminho da pasta que deseja alterar.
echo Ex.: %unidade%:\temp\temp_outr
set /P opcao=

::vamos mover a posição do prompt para a parta que será alterada
cd %opcao%

::agora diferenciamos o bloqueio e desbloqueio
if %opcao_menu% == b goto executarBloquear
if %opcao_menu% == B goto executarBloquear
if %opcao_menu% == d goto executarDesbloquear
if %opcao_menu% == D goto executarDesbloquear
goto menu

:executarBloquear
echo será bloqueada a pasta %cd%, tem certeza que deseja continuar? S/N
set /P confirmar_bloqueio=
if %confirmar_bloqueio% == s (goto confirmadoBloquear) else if %confirmar_bloqueio% == S (goto confirmadoBloquear) else (goto menu)

:executarDesbloquear
echo será desbloqueada a pasta %cd%, tem certeza que deseja continuar? S/N
set /P confirmar_desbloqueio=
if %confirmar_desbloqueio% == s (goto confirmadoDesbloquear) else if %confirmar_desbloqueio% == S (goto confirmadoDesbloquear) else (goto menu)

:confirmadoDesbloquear
echo inicinado desbloqueio da pasta "%opcao%"
echo.
attrib %cd% -r -h
::excluir arquivo criado na pasta que estamos desbloqueando
erase /f /q desktop.ini
echo pasta desbloqueada!
goto desejaOutraOpcao

:confirmadoBloquear
echo inicinado proteção da pasta "%opcao%"
echo.

::criando arquivo que faz windows interpretar pasta como atalho para a lixeira
echo [.ShellClassInfo]>desktop.ini
echo CLSID={645FF040-5081-101B-9F08-00AA002F954E}>>desktop.ini
echo LocalizedResourceName=@%SystemRoot%\system32\shell32.dll,-8964>>desktop.ini
::importante a pasta ficar com atributo de somente leitura para exibir como atalho
attrib %cd% +r

echo pasta protegida!
goto desejaOutraOpcao

:desejaOutraOpcao
echo deseja fazer outra operação? S/N
set /P outra_operacao=
if %outra_operacao% == s (goto menu) else if %outra_operacao% == S (goto menu) else (exit)

