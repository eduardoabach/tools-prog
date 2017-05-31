
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

# Trabalhando com branchs
# os comites e alterações no branch ficam nele
# ao trocar, volta a situação do anterior
git branch # lista de existentes
git checkout -b nome_nome_exemplo # para criar um novo branch chamado 'nome_nome_exemplo'
git branch -d nome_nome_exemplo # exclui o branch
git checkout dev # vai para o branch dev
git add item_alterado_exemplo.php
git commit -m "Exemplo alteracao branch dev"
git push # fecha ciclo da alteração no branch, mas o master nao tem ela ainda

# Branch merge direto com o master, este é mais perigoso, mas para projetos simplórios até pode ser usado
git checkout master #ir para o master para posterior pull atualizando
git pull # atualizar o master, para garantir que o merge esteja sincrono com as ultimas atualizacoes de todos 
git merge dev # em caso de conflito vai ser complicado, pois deve resolver e os outros usuários do master vao ter de esperar
#por esse motivo nao é recomendado para projetos maiores, com mais pessoas, maior complexidade e fluxo de trabalho
git push # tudo resolvido, mandar alteracao para todos

# Branch merge no segmento, depois merge com o master, esse procedimento é mais recomendado
git checkout master #ir para o master para posterior pull atualizando
git pull # atualizar o master, para garantir que o merge esteja sincrono com as ultimas atualizacoes de todos 
git checkout dev #voltamos para o dev, todo vai ser feito nele, protegendo o fluxo de trabalho e integridade do master
git merge master # verificar caso existam conflitos, parte fica no branch de alteracao, protegendo o master
git checkout master #com os merge resolvido voltamos para o master
git pull # atualizar novamente o master, aqui alguem pode ter sincronizado antes de vc, caso sim vale repetir o merge master...
git merge dev # enfim a alteraao chega no master, caso tenha feito tudo correto, nada vai dar errado aqui :)
git push # tudo resolvido, mandar alteracao para todos


# Caso: precisa sobrescrever um branch por outro, que agora é o prioritário e correto
# Estrutura: master(foi alterado por engado depois do dev, incorreto), dev(é o que está correto)
git checkout dev
git merge -s ours master # passa a ser prioritário sobre master, '-s ours' é o encurtamento de '--strategy=ours'
git checkout master
git merge dev


# Outras situações
git log
git log --name-only
git checkout -f
git checkout -f 2ab16512207e7b943e4dc1fd2d1176a1d438 # voltar todo projeto para esse momento, não precisa de pull, nada
git revert --no-edit 2ab16512207e7b943e4dc1fd2d1176a1d438 # desfazer a alteracao

#ferramentas
sudo apt install gitk
gitk&