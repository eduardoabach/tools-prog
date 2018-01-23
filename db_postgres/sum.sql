
/* Soma simples, mostra 8099, repare que não tem problema somar um campo null */
select sum(valor) from (values(1, 50),(2,48),(3,0),(4,null),(5, 8001)) as t(cod, valor);

/* CUIDADO ao somar valores com possível null, que vai mostrar null no result mesmo outros números existindo */
select sum(valor) + null + 5 from (values(1, 50),(2,48),(3,0),(4,null),(5, 8001)) as t(cod, valor); /* vai mostrar null*/
select sum(valor1 + valor2) from (values(1, 50, 10),(2, 20, null)) as t(cod, valor1, valor2); /* resulta em 60, a segunda fica null*/