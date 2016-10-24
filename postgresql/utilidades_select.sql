
-- hash de um registro da tabela
SELECT tb.id, md5(CAST((tb.*) AS text)) FROM tb_teste AS tb LIMIT 10;

-- json completo de um registro
SELECT tb.id, row_to_json(tb) FROM tb_teste AS tb LIMIT 10;

-- Idade, em anos
SELECT extract(year from age(p.data_nasc)) as idade FROM pessoas as p

-- Extrair ano, mês, dia de data
select extract(year from m.data) as comp_ajust from movimento as m limit 1
select extract(month from m.data) as comp_ajust from movimento as m limit 1
select extract(day from m.data) as comp_ajust from movimento as m limit 1

-- Números aos lados, estilo str_pad php
SELECT RPAD(numcol::text, 3, '0'), LPAD(numcol::text, 3, '0') FROM my_table

-- Contar quantidade de letras...
select length(cast ('125556' as text)); --out: 6

-- Mostrar campo nome que não estão no group by
SELECT string_agg(nome, ', '), count(1) FROM produtos GROUP BY categoria; 

-- Count simples, soma para contagem por situação em IF
select
	reg_m.id,
	reg_m.data_ini,
	reg_m.data_fim,
    count(reg_i.pessoa) as pessoas,
    sum(case when reg_i.situacao = 'P' then 1 else 0 end) as pendente,
    sum(case when reg_i.situacao = 'C' then 1 else 0 end) as concluido
from registro_mestre as reg_m
left join registro_item as reg_i on reg_i.id_reg_m = reg_m.id
where reg_m.id = 1
group by reg_m.id




