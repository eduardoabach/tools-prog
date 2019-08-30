#include <stdio.h>
#include <stdlib.h>
#include <signal.h>
#include <time.h>

long N_LIMIT = 12;
long N_LIMIT_LOOP = 10000; //1000000000 //1.000.000.000 1 Bilhão

volatile sig_atomic_t stop = 0;
void stop_by_ctrl_c(int sig){
	printf("\n CTRL + C!\n");
	stop = 1;
}

void do_loop();
int get_random_number();
void text_list_result();
void text_clear();

int main(int argc, char *argv[]){

	if(argc > 1){
		N_LIMIT = strtol(argv[1], NULL, 10);
	}

	if(argc > 2){
		N_LIMIT_LOOP = strtol(argv[2], NULL, 10);
	}

	signal(SIGINT, stop_by_ctrl_c);
	srand(time(0));  //random variando por momento de exec do prog
	do_loop();
	return 0;
}

void do_loop(){
	int n_rand;
	int n_list[N_LIMIT];
	
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

	double media_arit_probab = (double)(N_LIMIT+1) / 2; // esse exemplo nao tem o Zero, portanto soma 1 na média
	double media_arit_atingida = soma_results / N_LIMIT_LOOP;
	double media_arit_diff = media_arit_probab - media_arit_atingida;
	double media_arit_diff_percent = media_arit_diff / media_arit_probab * 100;


	printf("\n");
	printf("Soma dos Resultados: %.3f\n", soma_results);
	printf(
		"Média Aritmética: %.3f / %.3f | %.3f = %.3f(%) \n", 
		media_arit_atingida, 
		media_arit_probab, 
		media_arit_diff, 
		media_arit_diff_percent
	);
	printf("Diff Probabilidade Acumulada: %.6f\n", diff_probabilidade_acumulada);
	printf("\n");

}

void text_clear(){
	printf("\033[H\033[J");
	// system("clear"); // system("cls"); windows
}
