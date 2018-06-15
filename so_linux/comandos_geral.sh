
# Informações sobre o processador, arquitetura 32/64bits, tamanho do cache, núcleos, GHz...
lscpu

history
history -c
history -d 15


# Processos ativos
top

# Mata processo com pid 1234, o 9 é para forçar
kill -s 9 1234

# Memória ram e swap, total, uso, livre
free -h

# Infos sobre armazenamento de arquivos, hds, tamanho, livre...
df -h

# Infos do sistema operacional, versão do kernel, nome do computador
uname -a

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

#fazer varredura em outro pc, portas disponiveis e os serviços ligados a elas, route...
apt-get install nmap
nmap -v -A www.siteexemplo.com.br

#buscar por ips na rede, vai ir de 192.168.1.1~...
sudo nmap -sP 192.168.1.0/24
#buscar portas
#-O (Habilita a detecção de SO), usar esse como padrão, sem a parte de versão(-sV) fica mais rápido
sudo nmap -sS -O -P0 -v hostname.domain
#-sV verificação de versão dos softwares dos serviços
sudo nmap -sS -sV -O -P0 -v hostname.domain
#-A faz o -sV e outras infos detalhadas
sudo nmap -sS -A -O -P0 -v hostname.domain
#Scan de algumas possiveis vulnerabilidades, pontos de interesse
sudo nmap -Pn --script vuln 127.0.0.1



#Lista o ip na rede
ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1'
ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*'

#Lista os macadress
ifconfig -a | awk '/^[a-z]/ { iface=$1; mac=$NF; next } /inet addr:/ { print iface, mac }'

#Listar dispositivos na rede, -a mostra nome e ip
arp -a


