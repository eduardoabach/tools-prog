
# Criar arquivo
echo "Conteúdo do arquivo">nome.txt
echo ", complemento de texto.">>nome.txt # Adicionar ao que já existe

# Listar arquivos pasta
ls
ls -l # listar com permissões
ll # listar com permissões

# tamanho arquivos
du -sh #tamanho da pasta atual
du -h #lista arquivos da pasta, h para tamanho mais legível

# Deletar aquivo, para pastas deve usar o -r
rm arquivo.txt
rm /var/arquivo.txt
rm /var/teste_folder/ -r

# Mover arquivo
mv caminho_existente/pasta_exist caminho_destino/pasta_novo_nome

# Copiar arquivo
cp -Rp dir1 dir2

# Copiar para rede
scp -rp dir1 user@hostname:/tmp/.

# Infos sobre armazenamento de arquivos, hds, tamanho, livre...
df -h

# Descobrir a codificação, text enconde
file -bi /etc/fileexamplename.txt
