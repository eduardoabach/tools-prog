
/*Alterar o schema atual*/
SET search_path TO nome_schema_padrao_desejado;

-- Paginação com LIMIT e OFFSET
SELECT coluna FROM tabela LIMIT 15 OFFSET 60; --15 itens, página 4 (15*4)

-- ctid é uma coluna de identificação usada pelo banco de dados, 
-- pode ser usada para identificar registros em tabelas sem chave primária única
SELECT ctid, * from movimentos limit 10


-- Fields com case
SELECT (case when campo_exemplo = 'teste' then 'result_1' else 'result_2' end) as teste_case_campo FROM tabela_exemplo

-- WHERE com count, apenas número maior que x, usando sub select
-- nesse exemplo, procurando por rg duplicados
SELECT * FROM (
	SELECT count(*) as qtd, rg
	FROM pessoas 
	GROUP BY rg
) as tb WHERE tb.qtd > 1

-- Where com case
SELECT * FROM tabela_exemplo 
WHERE codigo IS NOT NULL
    AND (
        CASE
            WHEN m.tipo = 'E' AND m.movimento_estornado IS NOT NULL THEN m.movimento_estornado::varchar
            WHEN m.tipo = 'E' THEN n.nro_nota::varchar
            WHEN m.tipo = 'S' AND m.talao_saida_s_requisicao IS NOT NULL THEN m.talao_saida_s_requisicao::varchar
            WHEN m.tipo = 'S' THEN m.cod_requisicao::varchar
            ELSE NULL
        END
    ) IS NOT NULL

-- Order crescente normal, mas com os valores NULL primeiro
SELECT nome, data_inscricao FROM tabela_exemplo ORDER BY data_inscricao NULLS FIRST

-- Order de um varchar, mas focando na ordem numérica
SELECT * FROM tabela_exemplo ORDER BY NULLIF(regexp_replace(nome_coluna_varchar, '\D', '', 'g'), '')::int

-- SUB SELECT, tabelas simuladas usando values
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

-- CASE
SELECT
	CASE extract(month from TIMESTAMP '2016-10-21') 
		WHEN 1 THEN 'janeiro'
		WHEN 2 THEN 'fevereiro'
		WHEN 3 THEN 'março'
		WHEN 4 THEN 'abril'
		WHEN 5 THEN 'maio'
		WHEN 6 THEN 'junho'
		WHEN 7 THEN 'julho'
		WHEN 8 THEN 'agosto'
		WHEN 9 THEN 'setembro'
		WHEN 10 THEN 'outubro'
		WHEN 11 THEN 'novembro'
		WHEN 12 THEN 'dezembro'
              ELSE ''
	END as dt_mes_texto, -- out: 'outubro'
	CASE 
		WHEN 50 < 10  THEN 'A'
		WHEN 20 = 21 THEN 'B'
		WHEN (10+10) = 20 THEN 'C'
              ELSE 'D'
	END as test -- out: c
	CASE WHEN 55>1 THEN 1 ELSE 0 END

-- hash de um registro da tabela
SELECT tb.id, md5(CAST((tb.*) AS text)) FROM tb_teste AS tb LIMIT 10;

-- json completo de um registro
SELECT tb.id, row_to_json(tb) FROM tb_teste AS tb LIMIT 10;

-- Data Atual
SELECT now();

/* Exibir data no formato usuário */
SELECT to_char(field_date, 'DD/MM/YYYY') from table1;
SELECT to_char(DATE '2016-01-01', 'DD/MM/YYYY');
SELECT to_char(fild_timestamp, 'HH:MI:SS - DD/MM/YYYY');
select to_char(current_timestamp, 'YYYY-MM-DD');
select to_char(current_timestamp, 'HH:MI:SS');

-- Idade, em anos
SELECT extract(year from age(p.data_nasc)) as idade FROM pessoas as p
SELECT extract(year from age(CURRENT_DATE, '1991-04-01'))

-- Dias entre datas
SELECT TIMESTAMP '2010-01-20' - TIMESTAMP '1990-05-28'

-- Subtrair tempo de uma data com número ou field variável, dias, meses, anos
SELECT TIMESTAMP '2018-11-15' - (5 || ' days')::interval --out: "2018-11-10 00:00:00"
SELECT TIMESTAMP '2018-11-15' - (20 || ' months')::interval --out: "2017-03-15 00:00:00"

-- Extrair ano, mês, dia de data
SELECT extract(year from m.data) as comp_ajust FROM movimento as m LIMIT 1
SELECT extract(month from m.data) as comp_ajust FROM movimento as m FROM 1
SELECT extract(day from m.data) as comp_ajust FROM movimento as m FROM 1
SELECT extract(month from TIMESTAMP '2016-10-21') --out: 10
SELECT extract(day from TIMESTAMP '2016-10-10' - TIMESTAMP '2016-01-21') --out: 263
SELECT extract(day from m.data - now()) FROM movimento as m FROM 1

-- Números aos lados, estilo str_pad php
SELECT RPAD(numcol::text, 3, '0'), LPAD(numcol::text, 3, '0') FROM my_table

-- Contar quantidade de letras...
SELECT length(cast ('125556' as text)); --out: 6
SELECT length('AAA'); -- out 3
SELECT length(' A '); -- out 3
SELECT length('1A '); -- out 3
SELECT length('1A'); -- out 2
SELECT length(''); -- out 0
SELECT length(null); -- out null
SELECT length('1A') > 0; -- out true
SELECT length('0') > 0; -- out true (1)
SELECT length('') > 0; -- out false
SELECT length(null) > 0; -- out null
SELECT null IS NOT NULL AND length(null) > 0; -- out false, usar esse.
SELECT char_length(cast ('125556' as text)); --out: 6
SELECT strpos('algum no texto, continuação do texto.', 'text'); --out: 10
SELECT strpos('algum no texto, continuação do texto.', 'algum'); --out: 1
SELECT strpos('algum no texto, continuação do texto.', 'teste'); --out: 0

-- Manipulando string
SELECT lower('Tom'); --out: tom
SELECT upper('Tom'); --out: TOM, maiúsculas
SELECT initcap('olá carlos'); --out: Olá Carlos, captalizar
SELECT substring('Thomas' from 2 for 3); --out: hom
SELECT SUBSTR('Teste de exemplo.', 1, 1); --out: T
SELECT SUBSTR('Teste de exemplo.', 5, 9); --out: e de exem
SELECT SUBSTR('2016-05-15', 9, 2); --out: 15, pegar parte de string
SELECT lpad('Olá', 10, '.'); --out: .......Olá
SELECT rpad('Olá', 10, '.'); --out: Olá.......
SELECT ltrim('....Teste...', '.'); --out: Teste...
SELECT rtrim('....Teste...', '.'); --out: ....Teste
SELECT trim('....Teste...', '.'); --out: Teste
SELECT trim('(_@_)Teste(_@_)(_@_)', '(_@_)'); --out: Teste
SELECT repeat('Pg', 4); --out: PgPgPgPg, loop em string
SELECT replace('um {aplic} padrão.', '{aplic}', 'teste'); --out: um teste padrão. substituir parte de string

-- Concatenar, unir strings, atenção para a diferença da function concat e os simples || com valores nulos.
-- Concat está disponível depois do postgres versão 9.1
SELECT concat('a', 'b') --out:ab
SELECT concat('a', 'b', 'c') --out:abc
SELECT concat('a', null, 'c') --out:ac
SELECT 'a' || 'b' --out:ab
SELECT 'a' || 'b' || 'c' --out:abc
SELECT 'a' || null || 'c' --out: null
SELECT 'c ' || COALESCE(null,'') || COALESCE(' de.','') --out: "c  de." pode usar em substituicao ao concat() em versoes mais antigas, || com COALESCE


-- Delimitando valor entre string
SELECT split_part('abc(@)def(@)ghi(@)jkl', '(@)', 1) --out: abc
SELECT split_part('abc(@)def(@)ghi(@)jkl', '(@)', 2) --out: def
SELECT split_part('abc(@)def(@)ghi(@)jkl', '(@)', 3) --out: ghi
SELECT split_part('abc(@)def(@)ghi(@)jkl', '(@)', 4) --out: jkl
SELECT split_part('abc(@)def(@)ghi(@)jkl', '(@)', 5) --out: ''

-- Formatar CPF e CNPJ
SELECT to_char( regexp_replace(cpf::text, '[^0-9]', '', 'gi')::numeric, '000"."000"."000"-"00')
SELECT to_char( regexp_replace(cnpj::text, '[^0-9]', '', 'gi')::numeric, '00"."000"."000"/"0000"-"00')

-- Limpar formatação CPF
SELECT translate(translate('555.444.666-77', '-', ''), '.','') --out 55544466677

-- Convert, Decode, Encode, Cript, Decript
SELECT convert_to('algum texto...', 'UTF8');
SELECT encode('teste', 'base64'); -- out: dGVzdGU=
SELECT decode('dGVzdGU=', 'base64'); -- out: teste
SELECT to_hex(255); --out: ff
SELECT translate(upper('texto de exemplo.'), 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 .,', '?DEFGHIJKLMNOPQRSTUVWXYZAB2345678901C~!'); --out: "VGZVQCFGCGZGORNQ~"
SELECT translate('VGZVQCFGCGZGORNQ~', '?DEFGHIJKLMNOPQRSTUVWXYZAB2345678901C~!', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 .,'); --out: "TEXTO DE EXEMPLO."

-- Exibir caract UTF8 usando código
SELECT chr(65); --out: A
SELECT chr(66); --out: B
SELECT chr(161); --out: ¢
SELECT chr(165); --out: ¥
SELECT chr(181); --out: µ
SELECT chr(208); --out: Ð

-- Mostrar campo string que não está no group by, agrupando eles em um row
-- reunir vários registros, ao estilo de uso do SUM
-- pode usar o DISTINCT para ignorar duplicados
SELECT string_agg(fabricante, ', ') as fabricantes_disponiveis, sum(qtd) as estoque FROM produtos GROUP BY categoria; 
SELECT string_agg(DISTINCT fabricante, ', ') as fabricantes_disponiveis, sum(qtd) as estoque FROM produtos GROUP BY categoria; 

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

-- Acumular valor por dia, soma por criterio composto
SELECT
    dia,
    caixa,
    valor_entrada,
    SUM( valor_entrada ) OVER ( PARTITION BY caixa ORDER BY dia ) AS saldo
FROM (
    SELECT ARRAY_TO_ROW( ARRAY[ 1, 2, 3 ] ) AS dia,
           ARRAY_TO_ROW( ARRAY[ 1, 1, 2 ] ) AS caixa,
           ARRAY_TO_ROW( ARRAY[ 100, 500, 99 ] ) AS valor_entrada
) AS caixa 

--arredondar número para baixo
SELECT floor(5) --out: 5
SELECT floor(5.4) --out: 5
SELECT floor(5.5) --out: 5
SELECT floor(5.9) --out: 5
SELECT floor(5.9999) --out: 5

--arredondar número para cima
SELECT ceil(5) --out: 5
SELECT ceil(5.00001) --out: 6
SELECT ceil(5.1) --out: 6
SELECT ceil(5.5) --out: 6
SELECT ceil(5.9999) --out: 6

--arredondar número na regra normal
SELECT round(5) --out: 5
SELECT round(5.00001) --out: 5
SELECT round(5.1) --out: 5
SELECT round(5.499999) --out: 5
SELECT round(5.55555,3) --out: 5.556
SELECT round(5.55555,1) --out: 5.6
SELECT round(5.5) --out: 6
SELECT round(5.500001) --out: 6
SELECT round(5.9999) --out: 6

-- maior número
SELECT greatest(0, 5) --out: 5 // bom para evitar números negativos, ou apenas maiores que X
SELECT greatest(0, -5) --out: 0

-- menor número
SELECT least(5, 100, 8.8) --out 5
SELECT least(5, 0, -1, 0.9) --out -1
SELECT least(5, 0, -1, -1.01) --out -1.01

-- Replace para NULL quando valor for igual ao segundo parametro
SELECT NULLIF (1, 1); -- return NULL
SELECT NULLIF (1, 0); -- return 1
SELECT NULLIF ('A', 'B'); -- return A
SELECT NULLIF ('A', 'A'); -- return NULL
SELECT NULLIF ('', ''); -- return NULL


-- TESTES GERAIS ------------------

SELECT null = null; -- null
SELECT '' = null; -- null
SELECT 10 = null; -- null
SELECT false = null; -- null
SELECT true = null; -- null

SELECT null is null; -- true
SELECT '' is null; -- false
SELECT 10 is null; -- false
SELECT false is null; -- false
SELECT true is null; -- false

SELECT null > 0; -- null
SELECT 4 > null; -- null

SELECT '4'::int > 0; -- true
SELECT '4'::int = 4; -- true
SELECT '5' > '4'; -- true
SELECT '5' > '4,55'; -- true
SELECT '5' > '4.55'; -- true
SELECT '5,11' > '4.55'; -- true
SELECT 5.11 > '4.55'; -- true
SELECT 5.11 > '4.55'; -- true
SELECT 5.11 > '0'; -- true
SELECT 5.11 > ''; -- erro
SELECT 5.11 > ''::int; -- erro

---------------------------------

-- Usar campo string / varchar / text como um campo integer
SELECT NULLIF(REGEXP_REPLACE(null, '[^[:digit:]]*', '', 'g'), '')::integer --null
SELECT NULLIF(REGEXP_REPLACE('teste', '[^[:digit:]]*', '', 'g'), '')::integer --null
SELECT NULLIF(REGEXP_REPLACE('asd@!ad 55. as\da#+!@s.', '[^[:digit:]]*', '', 'g'), '')::integer -- out 55
SELECT NULLIF(REGEXP_REPLACE('5487', '[^[:digit:]]*', '', 'g'), '')::integer --5487

-- Apenas letras de uma string
SELECT REGEXP_REPLACE('_A.BC12345xy.z_','[^[:alpha:]]','','g'); --out "ABCxyz"
SELECT REGEXP_REPLACE('_A.BC12345xy.z_','[[:alpha:]]','','g'); --out "_.12345._" (remove apenas as letras, o oposto)
-- Apenas numeros de uma string
SELECT REGEXP_REPLACE('_A.BC12345xy.z_','[^[:digit:]]','','g'); --out "12345"
SELECT REGEXP_REPLACE('_A.BC12345xy.z_','[[:digit:]]','','g'); --out "_A.BCxy.z_" (remove apenas os numeros, o oposto)


---------------------------------

/* Soma simples, mostra 8099, repare que não tem problema somar um campo null */
--out: 8099, 2024.750000, 0, 8001
SELECT sum(valor), avg(valor), min(valor), max(valor) FROM (VALUES(1, 50),(2,48),(3,0),(4,null),(5, 8001)) as t(cod, valor);
/* CUIDADO ao somar valores com possível null, que vai mostrar null no result mesmo outros números existindo */
SELECT sum(valor1 + valor2) FROM (VALUES(1, 50, 10),(2, 20, null)) as t(cod, valor1, valor2); /* resulta em 60, a segunda fica null*/
/* Usar COALESCE para evitar os possíveis null, ou claro ter um campo com "not null" default 0(zero) */
SELECT sum(COALESCE(valor1,0) + COALESCE(valor2,0)) FROM (VALUES(1, 50, 10),(2, 20, null)) as t(cod, valor1, valor2);

/* Distinct, para limitar registros com certa característica repetida*/
/* Exemplo: Última compra de vários usuários */
SELECT 
	DISTINCT ON (id_comprador) id, id_comprador, data, valor_total
FROM compras
ORDER BY id_comprador, data DESC, valor_total, id;

/* Montar um select com todos os campos de uma tabela, menos uma lista de campos. Útil para monstar um insert para duplicar reigistro*/
SELECT 'SELECT ' || array_to_string(ARRAY(SELECT 'f' || '.' || c.column_name
        FROM information_schema.columns As c
            WHERE table_name = 'nome_tabela'  and schema = 'public'
            AND  c.column_name NOT IN('id')
    ), ',') || ' FROM public.nome_tabela as t' As sqlstmt


SELECT * FROM pg_indexes 
	WHERE tablename = 'nome_tabela' 
	and schemaname = 'nome_schema' 