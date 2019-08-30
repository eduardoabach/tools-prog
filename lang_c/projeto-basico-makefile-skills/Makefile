
# $@    Nome da regra. 
# $<    Nome da primeira dependência 
# $^ 	Lista de dependências
# $? 	Lista de dependências mais recentes que a regra.
# $* 	Nome do arquivo sem sufixo

#Definimos a variável

CC=gcc
CFLAGS=-W -Wall -ansi -pedantic
EXEC=teste
OBJ=teste.o main.o

all: $(EXEC)

#Não coloquei a variável OBJ para que possam entender as variáveis internas. 
#Se entenderam podem colocar $(OBJ) no lugar de teste.o main.o
teste: teste.o main.o
# $@ = teste:
# $^ = teste.o main.o
	$(CC) -o $@ $^ 

# teste.o:teste.c
%.o: %.c
	$(CC) -o $@ -c $< $(CFLAGS)

main.o: main.c teste.h
	$(CC) -o $@ -c $< $(CFLAGS)

.PHONY: clean mrproper

clean: 
	rm -rf *.o
	@echo "Compilaçao pronta"

mrproper: clean
	rm -rf $(EXEC)
