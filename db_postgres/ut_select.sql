
-- Paginação com LIMIT e OFFSET
SELECT coluna FROM tabela LIMIT 15 OFFSET 60; --15 itens, página 4 (15*4)

-- Fields com case
SELECT (case when campo_exemplo = 'teste' then 'result_1' else 'result_2' end) as teste_case_campo FROM tabela_exemplo

-- SUB SELECT
SELECT meses.cod, meses.mes, busca.*
FROM (values(1,'Jan'),(2,'Fev'),(3,'Mar')) as meses (cod,mes)
LEFT JOIN (
	SELECT 
		count(faa.cod) as faa_quantidade,
		count(faa_old.cod) as faa_quantidade_old,
		entidade.cod,
		entidade.nome,
		faa.mes,
		faa.ano,
		faa_old.ano as ano_old
	FROM (values(1,'ent1'),(2,'ent2')) as entidade (cod,nome)
	LEFT JOIN (
		values(1,1,1,2014),(2,1,2,2015),(3,2,1,2014),(4,2,1,2015),(5,2,2,2014)
		) as faa (cod,entidade,mes,ano) on faa.entidade = entidade.cod and faa.ano = 2015
	LEFT JOIN (
		values(1,1,1,2014),(2,1,2,2015),(3,2,1,2014),(4,2,1,2015),(5,2,2,2014)
		) as faa_old (cod,entidade,mes,ano) on faa_old.entidade = entidade.cod and faa_old.mes = faa.mes and faa_old.ano = 2014
	GROUP BY entidade.cod, entidade.nome, faa.mes, faa.ano, faa_old.mes, faa_old.ano
) as busca on busca.mes = meses.cod

-- hash de um registro da tabela
SELECT tb.id, md5(CAST((tb.*) AS text)) FROM tb_teste AS tb LIMIT 10;

-- json completo de um registro
SELECT tb.id, row_to_json(tb) FROM tb_teste AS tb LIMIT 10;

-- Data Atual
SELECT now();

-- Idade, em anos
SELECT extract(year from age(p.data_nasc)) as idade FROM pessoas as p

-- Extrair ano, mês, dia de data
SELECT extract(year from m.data) as comp_ajust FROM movimento as m LIMIT 1
SELECT extract(month from m.data) as comp_ajust FROM movimento as m FROM 1
SELECT extract(day from m.data) as comp_ajust FROM movimento as m FROM 1

-- Números aos lados, estilo str_pad php
SELECT RPAD(numcol::text, 3, '0'), LPAD(numcol::text, 3, '0') FROM my_table

-- Contar quantidade de letras...
SELECT length(cast ('125556' as text)); --out: 6
SELECT char_length(cast ('125556' as text)); --out: 6
SELECT strpos('algum no texto, continuação do texto.', 'text'); --out: 10

-- Manipulando string
SELECT lower('Tom'); --out: tom
SELECT upper('Tom'); --out: TOM
SELECT initcap('olá carlos'); --out: Olá Carlos
SELECT substring('Thomas' from 2 for 3); --out: hom
select SUBSTR('Teste de exemplo.', 1, 1); --out: T
select SUBSTR('Teste de exemplo.', 5, 9); --out: e de exem
SELECT lpad('Olá', 10, '.'); --out: .......Olá
SELECT rpad('Olá', 10, '.'); --out: Olá.......
SELECT ltrim('....Teste...', '.'); --out: Teste...
SELECT rtrim('....Teste...', '.'); --out: ....Teste
SELECT trim('....Teste...', '.'); --out: Teste
SELECT trim('(_@_)Teste(_@_)(_@_)', '(_@_)'); --out: Teste
SELECT repeat('Pg', 4); --out: PgPgPgPg
SELECT replace('um {aplic} padrão.', '{aplic}', 'teste'); --out: um teste padrão.
SELECT substr('2016-05-15', 9, 2); --out: 15

-- Delimitando valor entre string
SELECT split_part('abc(~@~)def(~@~)ghi(~@~)jkl', '(~@~)', 1) --out: abc
SELECT split_part('abc(~@~)def(~@~)ghi(~@~)jkl', '(~@~)', 2) --out: def
SELECT split_part('abc(~@~)def(~@~)ghi(~@~)jkl', '(~@~)', 3) --out: ghi
SELECT split_part('abc(~@~)def(~@~)ghi(~@~)jkl', '(~@~)', 4) --out: jkl
SELECT split_part('abc(~@~)def(~@~)ghi(~@~)jkl', '(~@~)', 5) --out: ''

-- Convert, Decode, Encode, Cript, Decript
SELECT convert_to('algum texto...', 'UTF8');
SELECT encode('teste', 'base64'); -- out: dGVzdGU=
SELECT decode('dGVzdGU=', 'base64'); -- out: teste
SELECT to_hex(255); --out: ff
select translate(upper('texto de exemplo.'), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 'CDEFGHIJKLMNOPQRSTUVWXYZAB2345678901'); --out: VGZVQ FG GZGORNQ.
select translate('VGZVQ FG GZGORNQ.', 'CDEFGHIJKLMNOPQRSTUVWXYZAB2345678901', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'); --out: TEXTO DE EXEMPLO.

-- Exibir caract UTF8 usando código
SELECT chr(65); --out: A
SELECT chr(66); --out: B

-- Mostrar campo nome que não estão no group by
SELECT string_agg(nome, ', '), count(1) FROM produtos GROUP BY categoria; 

-- Count simples, soma para contagem por situação em IF
SELECT
	reg_m.id,
	reg_m.data_ini,
	reg_m.data_fim,
    count(reg_i.pessoa) as pessoas,
    sum(case when reg_i.situacao = 'P' then 1 else 0 end) as pendente,
    sum(case when reg_i.situacao = 'C' then 1 else 0 end) as concluido
FROM registro_mestre as reg_m
LEFT JOIN registro_item as reg_i ON reg_i.id_reg_m = reg_m.id
WHERE reg_m.id = 1
GROUP BY reg_m.id

/* Soma simples, mostra 8099, repare que não tem problema somar um campo null */
SELECT SUM(valor) FROM (VALUES(1, 50),(2,48),(3,0),(4,null),(5, 8001)) as t(cod, valor);
/* CUIDADO ao somar valores com possível null, que vai mostrar null no result mesmo outros números existindo */
SELECT SUM(valor1 + valor2) FROM (VALUES(1, 50, 10),(2, 20, null)) as t(cod, valor1, valor2); /* resulta em 60, a segunda fica null*/
/* Usar COALESCE para evitar os possíveis null, ou claro ter um campo com "not null" default 0(zero) */
SELECT SUM(COALESCE(valor1,0) + COALESCE(valor2,0)) FROM (VALUES(1, 50, 10),(2, 20, null)) as t(cod, valor1, valor2);

/* Exibir data no formato usuário */
SELECT to_char(field_date, 'DD/MM/YYYY') from table1;
SELECT to_char(DATE '2016-01-01', 'DD/MM/YYYY');
