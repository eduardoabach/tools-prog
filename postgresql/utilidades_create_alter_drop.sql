
-- Trocar o schema padrão
SET search_path TO schema_alter;

/*Manipular schema*/
CREATE SCHEMA nameschema;
ALTER SCHEMA nameschema RENAME TO newname;
DROP SCHEMA nameschema; --cascade
ALTER TABLE nameschema.nametable SET SCHEMA nameschema_alter; --alterar tabela de um schema para outro

-- Criar view
CREATE VIEW nome_view AS SELECT * FROM tb_teste AS tb;

-- Criar outra tabela com mesma estrutura, duplicando informações da original ou não
CREATE TABLE public.un_test AS SELECT * FROM un_unico WHERE ctid is NULL;
CREATE TABLE public.un_test AS SELECT * FROM un_unico;

