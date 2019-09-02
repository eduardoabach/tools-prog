#include <stdio.h>
#include <stdlib.h>
#include <signal.h>
#include <math.h>
#include <time.h>

long N_LIMIT = 6;
long N_LIMIT_LOOP = 100;

volatile sig_atomic_t stop = 0;
void stop_by_ctrl_c(int sig){
	printf("\n CTRL + C!\n");
	stop = 1;
}

void show_head(double percent_basic, double qtd_basic){
	printf("\n");
	printf("Ocorrência de números randômicos: \n\n");
	printf("Percentual individual média: %.3f(\%)\n", percent_basic);
	printf("Quantidade individual proporcional: %.3f\n", qtd_basic);
	printf("Loop: %dx\n", N_LIMIT_LOOP);
	printf("\n");
}

int get_random_number(){
	return rand() % N_LIMIT + 1;
}

double get_media(int n_list[]){
	double soma_results = 0;
	int i;
	for(i=0; i < N_LIMIT; i++){
		if(n_list[i] > 0){
			soma_results += (double)n_list[i] * (i+1);
		}
	}
	return soma_results / N_LIMIT_LOOP;
}

void text_list_result(int n_list[]){

	double percent_basic = (double)1 / (double)N_LIMIT * 100;
	double qtd_basic = (double)N_LIMIT_LOOP / (double)N_LIMIT;

	double media_arit_atingida = get_media(n_list);
	double media_arit_probab = (double)(N_LIMIT+1) / 2; // esse exemplo nao tem o Zero, portanto soma 1 na média
	double media_arit_diff = media_arit_atingida - media_arit_probab;
	double media_arit_diff_percent = media_arit_diff / media_arit_probab * 100;
	double desvio_quadrado_soma = 0;

	double percent = 0, diff_probabilidade = 0, diff_probabilidade_acumulada = 0;
	double soma_results = 0, soma_valor = 0, soma_numeros = 0;
	int n_atual = 0,  v_atual = 0;
	int n_moda_1 = 0, n_moda_2 = 0, n_moda_count = 0, n_moda_qtd = 0;

	show_head(percent_basic, qtd_basic);

	int i;
	for(i=0; i < N_LIMIT; i++){
		n_atual = i+1;
		v_atual = n_list[i];
		soma_valor += v_atual;
		soma_numeros += n_atual;

		double desvio = v_atual - qtd_basic;
		double desvio_quadrado = desvio * desvio;
		desvio_quadrado_soma += desvio_quadrado;

		if(n_moda_qtd > 0 && n_moda_qtd == v_atual){
			n_moda_count++;
			n_moda_2 = n_atual;
		} else if(n_moda_qtd < v_atual){
			n_moda_1 = n_atual;
			n_moda_count = 1;
			n_moda_qtd = v_atual;
		}

		soma_results += (double)v_atual * (double)n_atual;
		percent = (double)v_atual / (double)N_LIMIT_LOOP * 100;
		diff_probabilidade = percent - percent_basic;
		diff_probabilidade_acumulada += (double)diff_probabilidade;
		printf("%4d: %4d | %.3f(\%) | %.3f(\%) prob. | desvio: %.3f ^² %.3f\n", 
			n_atual, 
			v_atual, 
			percent, 
			diff_probabilidade,
			desvio,
			desvio_quadrado
		);
	}

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

	// Moda pode ter no máximo 2 ocorrências, caso contrário não se enquadra em moda
	if(n_moda_count == 1){
		printf("Moda: %d(%d)\n", n_moda_1, n_moda_qtd);
		printf("\n");
	} else if(n_moda_count == 2){
		printf("Moda Dupla: %d e %d (%d)\n", n_moda_1, n_moda_2, n_moda_qtd);
		printf("\n");
	}

	printf("\n");

	double desvio_quadrado_medio = desvio_quadrado_soma / N_LIMIT;
	double desvio_padrao = sqrt(desvio_quadrado_medio);
	double cvp = desvio_padrao / media_arit_atingida * 100;
	printf("Desvio: Soma dos desvios %.3f | Variância: %.3f | Desvio padrão: %.3f\n", 
		desvio_quadrado_soma,
		desvio_quadrado_medio,
		desvio_padrao
	);
	printf("Desvio padrão: quanto mais próximo de zero, menos homogênea é a distribuição dos valores.\n");
	printf("Um número alto significa uma aleatoriedade distribuída.\n");
	printf("O valor está na mesma unidade de medida da amostra, não é abstrato.\n");
	printf("\n");

	printf("CVP: %.3f(%)\n", cvp);
	printf("*CVP - Coeficiente de Variação de Person\n");
	printf("É um percentual da relação entre o desvio padrão e a média.\n");
	printf("Quanto menor o percentual, menor a variação, menos distribuida é a ocorrência dos valores.\n");
	printf("\n");


	double corr_l_x_quadr = soma_numeros * soma_numeros;
	double corr_l_y_quadr = soma_valor * soma_valor;
	double corr_l_b_x = corr_l_x_quadr - (corr_l_x_quadr / N_LIMIT);
	double corr_l_b_y = corr_l_y_quadr - (corr_l_y_quadr / N_LIMIT);
	double corr_l_b_result = corr_l_b_x * corr_l_b_y;

	double corr_l_a_result = soma_results - ((soma_valor * soma_numeros) / N_LIMIT);
	double corr_l_result = corr_l_a_result / corr_l_b_result;
	printf("Coeficiente de correlação linear de Person: %.8f\n", corr_l_result);
	printf("result a: %.3f\n", corr_l_a_result);
	printf("result b: %.3f\n", corr_l_b_result);
	printf("Número varia entre -1 e 1, onde:\n");
	printf("Um valor próximo de 1 é uma relação direta, quando X aumenta tem um impacto igual em Y.\n");
	printf("Um valor próximo de -1 é uma relação inversa, quando X aumenta, Y diminui.\n");
	printf("\n");

}

void text_clear(){
	printf("\033[H\033[J");
}

void make_list(){
	int n_rand = 0;
	int n_list[N_LIMIT+N_LIMIT];
	int n_loop = 0;

	text_clear();
	// for(int i=0; i < N_LIMIT; i++){
	// 	printf("y: %d | %d \n", i, n_list[i]);
	// }

	// printf("t1_: %d | %d \n", N_LIMIT, N_LIMIT_LOOP);

	while (!stop && n_loop < N_LIMIT_LOOP){
		n_loop++;
		n_rand = get_random_number();
		n_list[n_rand-1] = n_list[n_rand-1] + 1;

		// printf("x: %d | %d | %d \n", n_loop, n_rand, n_list[n_rand-1]);
	}


	// for(int i=0; i < N_LIMIT; i++){
	// 	printf("yy: %d | %d \n", i, n_list[i]);
	// }

	text_list_result(n_list);
}

int main(int argc, char *argv[]){
	if(argc > 1)
		N_LIMIT = strtol(argv[1], NULL, 10);
	if(argc > 2)
		N_LIMIT_LOOP = strtol(argv[2], NULL, 10);

	signal(SIGINT, stop_by_ctrl_c);
	srand(time(0));
	make_list();
	return 0;
}
