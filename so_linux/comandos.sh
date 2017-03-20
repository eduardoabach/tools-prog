
# Informações sobre o processador, arquitetura 32/64bits, tamanho do cache, núcleos, GHz...
lscpu

# Processos ativos
top

# Mata processo com pid 1234, o 9 é para forçar
kill -s 9 1234

# Memória ram e swap, total, uso, livre
free -h

# Mover arquivo
mv caminho_existente/pasta_exist caminho_destino/pasta_novo_nome

# Instalar
apt-get install aaa #debian, ubuntu
sudo yum install mysql-server #centos, fedora

# Manipular serviços
/etc/init.d/apache2 restart #debian, ubuntu
service httpd restart #centos, fedora

# Adicionar comando ao iniciar OS, editar arquivo como preferir, usando o nano no exemplo
nano /etc/rc.d/rc.local

#Agendar operações periodicas usando o crontab 
#seguindo a seguinte estrutura [minutos] [horas] [dias do mês] [mês] [dias da semana] [usuário] [comando] 
#Minutos: informe números de 0 a 59
#Horas: informe números de 0 a 23
#Dias do mês: informe números de 1 a 31
#Mês: informe números de 1 a 12
#Dias da semana: informe números de 0 a 7
#Usuário: é o usuário que vai executar o comando (não é necessário especificá-lo se o arquivo do próprio usuário) 
#arquivo fica em /etc/crontab, ou no contexto de user em /var/spool/cron
30 22 2,10 * * echo "Exemplo..." #A frase é exibida às 22 horas e 30 minutos, nos dias 2 e 10, em todos os meses e em todos os dias da semana. 

# verificar se esta iniciando com o sistema, (Centos?)
chkconfig httpd
# ativar na iniciação do sistema
chkconfig httpd on


# Listar arquivos pasta
ls
ls -l # listar com permissões

# Lista dos últimos comandos
history
history -c # apagar lista

#Criar arquivo
echo "Conteúdo do arquivo">nome.txt
echo ", complemento de texto.">>nome.txt # Adicionar ao que já existe

