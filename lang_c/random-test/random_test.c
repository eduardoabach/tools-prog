#include <stdio.h>
#include <stdlib.h>

int main(void)
{
	printListRandomNumber(10);
	return 0;
}

int printListRandomNumber(int n_qtd)
{
	printf("Gerando %d valores aleatorios:\n\n", n_qtd);

	int i;
	for (i = 0; i < n_qtd; i++)
	{
		printf("%d \n", getRandomNumber());
	}
}

int getRandomNumber()
{
	return rand() % 100;
}
