
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

# Listar arquivos pasta
ls
ls -l # listar com permissões

# Lista dos últimos comandos
history
history -c # apagar lista

#Criar arquivo
echo "Conteúdo do arquivo">nome.txt
echo ", complemento de texto.">>nome.txt # Adicionar ao que já existe

