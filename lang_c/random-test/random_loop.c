#include <stdio.h>
#include <stdlib.h>
#include <signal.h>

//1.000.000.000 1 Bilhão
#define N_LIMIT_LOOP 100000
#define N_LIMIT 10

volatile sig_atomic_t stop = 0;
void stop_by_ctrl_c(int sig){
	printf("\n CTRL + C!\n");
	stop = 1;
}

int main(void){
	signal(SIGINT, stop_by_ctrl_c);
	srand(time(0));  //random variando por momento de exec do prog
	do_loop();
	return 0;
}

void do_loop(){
	int n_rand;
	int n_list[] = { [0 ... N_LIMIT] = 0 };

	int n_loop = 0;
	while (!stop && n_loop < N_LIMIT_LOOP){
		n_loop++;
		n_rand = get_random_number();
		n_list[n_rand-1] = n_list[n_rand-1] + 1;
		// sleep(1);
	}

	text_clear();
	text_list_result(n_list);
	printf("Loop: %dx \n", n_loop);
}

int get_random_number(){
	return rand() % N_LIMIT + 1;
}

void text_list_result(int n_list[]){

	double percent_basic = (double)1 / (double)N_LIMIT * 100;
	double qtd_basic = (double)N_LIMIT_LOOP / (double)N_LIMIT;

	printf("\n");
	printf("Ocorrência de números randômicos: \n\n");
	printf("Percentual individual média: %.3f(\%)\n", percent_basic);
	printf("Quantidade individual proporcional: %.3f\n", qtd_basic);
	printf("\n");

	double percent, diff_probabilidade, diff_probabilidade_acumulada, soma_results = 0;
	int i, n_atual, n_moda, n_moda_qtd = 0;
	for(i=0; i < N_LIMIT; i++){
		n_atual = i+1;

		soma_results += (double)n_list[i] * (double)n_atual;
		percent = (double)n_list[i] / (double)N_LIMIT_LOOP * 100;
		diff_probabilidade = percent - percent_basic;
		diff_probabilidade_acumulada += (double)diff_probabilidade;
		printf("%4d: %4d | %.3f(\%) | %.3f(\%) prob.\n", n_atual, n_list[i], percent, diff_probabilidade);
	}

	double media_aritmetica_probab = (double)(N_LIMIT+1) / 2; // esse exemplo nao tem o Zero, portanto soma 1 na média
	double media_aritmetica_atingida = soma_results / N_LIMIT_LOOP;
	double media_aritmetica_diff = media_aritmetica_probab - media_aritmetica_atingida;

	printf("\n");
	printf("Soma dos Resultados: %.3f\n", soma_results);
	printf("Média Aritmética: %.3f / %.3f (%.3f)\n", media_aritmetica_atingida, media_aritmetica_probab, media_aritmetica_diff);
	printf("Diff Probabilidade Acumulada: %.6f\n", diff_probabilidade_acumulada);
	printf("\n");

}

void text_clear(){
	printf("\033[H\033[J");
	// system("clear"); // system("cls"); windows
}
