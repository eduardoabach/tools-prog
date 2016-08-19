
/*Manipular schema*/
CREATE SCHEMA nameschema;
ALTER SCHEMA nameschema RENAME TO newname;
DROP SCHEMA nameschema; --cascade
ALTER TABLE nameschema.nametable SET SCHEMA nameschema_alter; --alterar tabela de um schema para outro
SET search_path TO schema_alter;

-- Criar view
CREATE VIEW nome_view AS SELECT * FROM tb_teste AS tb;

-- Criar outra tabela com mesma estrutura, duplicando informações da original ou não
CREATE TABLE public.un_test AS SELECT * FROM un_unico WHERE ctid is NULL;
CREATE TABLE public.un_test AS SELECT * FROM un_unico;

-- hash de um registro da tabela
SELECT tb.id, md5(CAST((tb.*) AS text)) FROM tb_teste AS tb LIMIT 10;

-- json completo de um registro
SELECT tb.id, row_to_json(tb) FROM tb_teste AS tb LIMIT 10;

-- Mostrar campo nome que não estão no group by
SELECT string_agg(nome, ', '), count(1) FROM produtos GROUP BY categoria; 

-- Update apenas de registros seguindo lista em um select e formatando valores
UPDATE tabela_exemplo AS update_tb
	SET campo_exemplo = tb_filtro_exemplo.ajust_campo_exemplo,
		campo_exemplo2 = tb_filtro_exemplo.ajust_campo_exemplo2
	FROM
		(
			SELECT 
				orig.id, 
				orig.campo_exemplo AS orig_campo_exemplo, 
				orig.campo_exemplo2 AS orig_campo_exemplo2, 
				ajust.campo_exemplo AS ajust_campo_exemplo,
				ajust.campo_exemplo2 AS ajust_campo_exemplo2
			FROM tabela_exemplo AS orig
			LEFT JOIN tabela_exemplo AS ajust 
				ON ajust.matricula = orig.matricula 
				AND ajust.data = orig.data 
				AND ajust.valor > 0
				AND ajust.id_historico = 3
			WHERE orig.id_historico = 2 AND ajust.id > 0
		) AS tb_filtro_exemplo
	WHERE update_tb.id = tb_filtro_exemplo.id

-- Deletar linhas duplicadas
DELETE FROM nometabela WHERE ctid NOT IN
	(SELECT max(ctid) FROM nometabela GROUP BY campoid,complementochave);

-- Deletar registros seguindo lista de select
DELETE FROM tabela_exemplo WHERE tabela_exemplo.id IN(
	SELECT
		ajust.id
	FROM tabela_exemplo AS orig
	WHERE orig.id_historico = 2 AND ajust.valor > 0
)



