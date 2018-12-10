
# Informações sobre o processador, arquitetura 32/64bits, tamanho do cache, núcleos, GHz...
lscpu

# Lista dos últimos comandos
history
history -c # apagar lista
#apaga a linha 15
history -d 15 
#mostra historico de forma mais completa, com data e hora
export HISTTIMEFORMAT='%F %T '
history

#remover as ultimas 10 linhas do arquivo bash_history
sed -e :a -e '$d;N;2,10ba' -e 'P;D' ~/.bash_history

#acesso remoto
ssh user@hostname
ssh user@hostname 'hostname; ifconfig; ls;' #executa lista de comandos em sequencia ao conectar, depois fecha conexão


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
# Infos mais completo
cat /etc/*release*

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

#Para abrir gerenciador de arquivos do linux ubuntu como root
sudo nautilus

#Lista o ip na rede
ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1'
ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*'

#Lista os macadress
ifconfig -a | awk '/^[a-z]/ { iface=$1; mac=$NF; next } /inet addr:/ { print iface, mac }'

#Listar dispositivos na rede, -a mostra nome e ip
arp -a

#?

scp -rf root@10.1.1.185:/usr/lib/jvm/java-1.7.0-openjdk-amd64 ./
cls


#ver arquivos e permissões
ls -palho

chown root.root java-7-openjdk-amd64/ -Rf

pwd

ll

sudo rm -r /var/lib/apt/lists/* -vf

htop


#adicionar um usuario
adduser nome_user

#remover um usuario, o -r remove o diretório
userdel -r vivek

#Transformar usuário em root, para funcionar deve estar logado no terminal como root
usermod -aG sudo nome_user

#desligar e reiniciar
poweroff
restart

# Mensagens dos drives do hardware, para conseguir o idVendor, idProduct, para usos de pesquisa de compatibilidade....
dmesg -T
