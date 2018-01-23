

# Criar arquivo
echo "Conteúdo do arquivo">nome.txt
echo ", complemento de texto.">>nome.txt # Adicionar ao que já existe

# Encriptar de forma simples
gpg -c arquivo #vai pedir senha
gpg -d arquivo_encriptado.gpg #colocar a senha e retorna na tela resultado
gpg -d arquivo_encriptado.gpg>exemplo.pdf #cria o arquivo como resultado...

gpg2...
