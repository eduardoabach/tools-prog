
# Informações sobre o processador, arquitetura 32/64bits, tamanho do cache, núcleos, GHz...
lscpu

# Processos ativos
top

# Mata processo com pid 1234, o 9 é para forçar
kill -s 9 1234

# Memória ram e swap, total, uso, livre
free -h

# Infos sobre armazenamento de arquivos, hds, tamanho, livre...
df -h

# Instalar
apt-get install aaa #debian, ubuntu
yum install mysql-server #centos, fedora
yum install php-pgsql

# Manipular serviços
/etc/init.d/apache2 restart #debian, ubuntu
service httpd restart #centos, fedora

# Adicionar comando ao iniciar OS, editar arquivo como preferir, usando o nano no exemplo
nano /etc/rc.d/rc.local

# verificar se esta iniciando com o sistema, (Centos?)
chkconfig httpd
# ativar na iniciação do sistema
chkconfig httpd on

# Lista dos últimos comandos
history
history -c # apagar lista

# Mostrar calendário
cal 2017
cal 2016
cal -hj 2017 #mostra dias em contagem total do ano

# Medir tempo de comando
time ls
time git status

# árvore de processos em execucao, PID...
pstree
pstree -hlp
