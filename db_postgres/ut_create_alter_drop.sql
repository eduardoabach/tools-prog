
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

-- Colunas com regras de validação, CHECK
CREATE TABLE products (
    product_no integer NOT NULL,
    name text NOT NULL,
    price numeric NOT NULL CHECK (price > 0)
);
CREATE TABLE products_2 (
    product_no integer,
    name text,
    price numeric,
    CHECK (price > 0),
    discounted_price numeric,
    CHECK (discounted_price > 0),
    CONSTRAINT valid_discount CHECK (price > discounted_price)
);

-- Criar tabela
CREATE TABLE nome_tabela (
    id serial,
    id_outra_tabela integer,
    tipo numeric(2,0) /* 00 ~ 99 */
);

ALTER TABLE nome_tabela ADD COLUMN id_outra_tabela integer references nome_outra_tabela(id);
ALTER TABLE nome_tabela ADD COLUMN data_pericia date;
ALTER TABLE nome_tabela ADD COLUMN observacao text;

ALTER TABLE nome_tabela ADD COLUMN tipo character varying(1);
COMMENT ON COLUMN nome_tabela.tipo IS 'Tipo: P - Pendente, C - Concluído';

ALTER TABLE nome_tabela ADD CONSTRAINT nome_tabela_nome_campo_key UNIQUE (nome_campo);

ALTER TABLE nome_tabela ADD CONSTRAINT nome_tabela_pkey PRIMARY KEY (id);

ALTER TABLE your_table DROP CONSTRAINT constraint_name;

ALTER TABLE nome_tabela ALTER COLUMN tipo SET DEFAULT 'P';

ALTER TABLE nome_tabela ADD COLUMN remuneracao numeric(6,2);
ALTER TABLE nome_tabela ALTER COLUMN remuneracao TYPE numeric(8,4);