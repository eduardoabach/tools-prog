#Definimos a variável
SRC=main.c

all: teste
	@echo "Minha mensagem final"
teste: teste.o main.o 
	@echo "Minha mensagem ao gerar projeto..."
	# O compilador faz a ligação entre os dois objetos
	gcc -o teste teste.o main.o
#-----> Distancia com o botão TAB ### e não com espaços
teste.o: teste.c
	gcc -o teste.o -c teste.c -W -Wall -ansi -pedantic
main.o: $(SRC) teste.h
	gcc -o main.o -c $(SRC) -W -Wall -ansi -pedantic
clean:
	rm -rf *.o
mrproper: clean
	rm -rf teste