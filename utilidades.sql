
/*Manipular schema*/
CREATE SCHEMA nameschema;
ALTER SCHEMA nameschema RENAME TO newname;
DROP SCHEMA nameschema; --cascade
ALTER TABLE nameschema.nametable SET SCHEMA nameschema_alter; --alterar tabela de um schema para outro
SET search_path TO schema_alter;

--hash de um registro da tabela
SELECT tb.id, md5(CAST((tb.*) AS text)) FROM tb_teste AS tb LIMIT 10;

--json completo de um registro
SELECT tb.id, row_to_json(tb) FROM tb_teste AS tb LIMIT 10;

--criar view
CREATE VIEW nome_view AS SELECT * FROM tb_teste AS tb;

--Criar outra tabela com mesma estrutura, duplicando informações da original ou não
CREATE TABLE public.un_test as SELECT * FROM un_unico WHERE ctid is NULL;
CREATE TABLE public.un_test as SELECT * FROM un_unico;

--Deletar linhas duplicadas
DELETE FROM nometabela WHERE ctid NOT IN
	(SELECT max(ctid) FROM nometabela GROUP BY campoid,complementochave);

/* Mostrar campo nome que não estão no group by, concatenando com , */
SELECT string_agg(nome, ', '), count(1) FROM produtos GROUP BY categoria; 