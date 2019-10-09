
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

# Debian / Ubuntu, pacotes, atualizações, desinstalar...
apt-get update
apt-get upgrade
apt-get install
apt-get --purge remove postgresql postgresql-doc postgresql-common
apt-get autoremove

# Listar pacotes instalados
dpkg -l | grep NOME_BUSCA
apt list --installed | grep NOME_BUSCA

# ----------------------------------------------------------------------------------

## FEDORA ##

sudo dnf search openjdk
sudo dnf install java-11-openjdk.x86_64

# Fedora, install de um arquivo .rpm
sudo dnf localinstall sample_file.rpm

#Ubuntu / fedora

apt update 				dnf check-update
apt upgrade 			dnf upgrade
apt dist-upgrade 		dnf system-upgrade
apt install 			dnf install
apt remove 				dnf remove
apt-cache search 		dnf search

# ----------------------------------------------------------------------------------

# Manipular serviços
/etc/init.d/apache2 restart
service apache2 restart
service httpd restart
service postgresql restart

# Verificar status de serviço
systemctl status apache2

# Verifica status de um modulo
a2enmod php7.2
# Desativa um modulo
a2dismod php7.2


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


# ----------------------------------------------------------------------------

#Ping mostrando a hora, util para guardar em arquivo de log
ping 8.8.8.8 | while read pong; do echo "$(date): $pong"; done


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

# -----------------------------------------------------------------------------

#Para abrir gerenciador de arquivos do linux ubuntu como root
sudo nautilus

#htop, monitor de processos, gasto de processador e memória ram
apt-get install htop
htop


#Lista o ip na rede
ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*' | grep -v '127.0.0.1'
ifconfig | grep -Eo 'inet (addr:)?([0-9]*\.){3}[0-9]*' | grep -Eo '([0-9]*\.){3}[0-9]*'

#Lista os macadress
ifconfig -a | awk '/^[a-z]/ { iface=$1; mac=$NF; next } /inet addr:/ { print iface, mac }'

#Desativar/Ativar uma interface de rede
ifconfig enp3s0 down
ifconfig enp3s0 up

#outra forma de pegar o macadress
ip link show

#Listar dispositivos na rede, -a mostra nome e ip
arp -a

#?
scp -rf root@10.1.1.185:/usr/lib/jvm/java-1.7.0-openjdk-amd64 ./
cls


#ver arquivos e permissões
ls -palho

#Lista informações sobre arquivos, permissoes, dono, data modifi...
ll

# Descobrir a codificação, text enconde
file -bi /etc/fileexamplename.txt

#Alterar dono/grupo de arquivo, R é recursivo e f silencioso
chown root.root java-7-openjdk-amd64/ -Rf

#Equivalente ao cd do windows, onde mostra o caminho do diretório atual
pwd

# remove arquivos dentro de diretório
# r é recursive, f é force e não pergunta, v é verbose e explica o que está em andamento
sudo rm -r /var/lib/apt/lists/* -vf

#Alterar titulo da janela do terminal, equivalente ao windows: title "Teste de titulo..."
PROMPT_COMMAND='echo -en "\033]0;New terminal title\a"'

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

# --------------------------------------------------------

# Curl post com json de parametro
curl -H "Content-Type: application/json; charset=utf-8" --request POST --data @ex_2.json http://10.10.10.10:8080/api/receive/

# --------------------------------------------------------

#Docker
service docker start

#Docker run aplication, with Dockerfile
sudo docker-compose build && sudo docker-compose up

#Docker run image, for example 'Redis'
sudo docker run -it -p 6379:6379 redis

# --------------------------------------------------------

#Random, numero randomico entre 1~10
shuf -i 1-10 -n 1

