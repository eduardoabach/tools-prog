
/* Valores em geral simples*/
select * from (values(1, 50),(2,48),(3,0),(4,null),(5, 8001)) as t(cod, valor);

/* Meses simples */
select * from (values(1,'Jan'),(2,'Fev'),(3,'Mar')) as meses (cod,mes)


select meses.cod, meses.mes, busca.*
from (values(1,'Jan'),(2,'Fev'),(3,'Mar')) as meses (cod,mes)
left join (
	select 
		count(faa.cod) as faa_quantidade,
		count(faa_old.cod) as faa_quantidade_old,
		entidade.cod,
		entidade.nome,
		faa.mes,
		faa.ano,
		faa_old.ano as ano_old
	from (values(1,'ent1'),(2,'ent2')) as entidade (cod,nome)
	left join (
		values(1,1,1,2014),(2,1,2,2015),(3,2,1,2014),(4,2,1,2015),(5,2,2,2014)
		) as faa (cod,entidade,mes,ano) on faa.entidade = entidade.cod and faa.ano = 2015
	left join (
		values(1,1,1,2014),(2,1,2,2015),(3,2,1,2014),(4,2,1,2015),(5,2,2,2014)
		) as faa_old (cod,entidade,mes,ano) on faa_old.entidade = entidade.cod and faa_old.mes = faa.mes and faa_old.ano = 2014
	group by entidade.cod, entidade.nome, faa.mes, faa.ano, faa_old.mes, faa_old.ano
) as busca on busca.mes = meses.cod



