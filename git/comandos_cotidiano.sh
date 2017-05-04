
# Início de projeto
git init
git remote add origin https://github.com/eduardoabach/repositorio.git
git pull origin master

# Processo de trabalho normal
git status
git add pasta/arquivo
git commit -m "#21 O que foi feito nos arquivos envolvidos..."
git pull
git push

# Outras situações
git log
git log --name-only
git checkout -f
git checkout -f 2ab16512207e7b943e4dc1fd2d1176a1d438 # voltar todo projeto para esse momento
git revert --no-edit 2ab16512207e7b943e4dc1fd2d1176a1d438 # desfazer a alteracao


#ferramentas
sudo apt install gitk
gitk&