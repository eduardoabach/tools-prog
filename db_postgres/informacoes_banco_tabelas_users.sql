

/* Versão do banco de dados */
SELECT version();

/* Endereço ip server do banco */
SELECT inet_server_addr();

/*Database*/
SELECT current_database();

/*Tamanho em bytes do database*/
SELECT pg_catalog.pg_size_pretty(pg_database_size(current_database()));

/*Listar bases*/
SELECT datname FROM pg_database WHERE datistemplate = false ORDER BY datname;

/*Alterar o schema atual*/
SET search_path TO nome_schema_padrao_desejado;

/*Nome do schema atual*/
show search_path;
SELECT catalog_name FROM information_schema.information_schema_catalog_name;
SELECT table_catalog FROM information_schema.tables LIMIT 1;

/*Listar Schemas existentes na base*/
SELECT table_schema 
FROM information_schema.tables 
WHERE table_schema not IN('information_schema', 'pg_catalog') 
GROUP BY table_schema
ORDER BY table_schema;

/*Listar tabelas e seus schemas*/
SELECT table_schema, table_name 
FROM information_schema.tables 
WHERE table_type = 'BASE TABLE' AND table_schema not IN('information_schema', 'pg_catalog')
ORDER BY table_schema, table_name; --table_type = 'VIEW'

/* Listar FOREIGN KEY(fks) de uma tabela */
SELECT
    tc.table_schema, 
    tc.constraint_name, 
    tc.table_name, 
    kcu.column_name, 
    ccu.table_schema AS foreign_table_schema,
    ccu.table_name AS foreign_table_name,
    ccu.column_name AS foreign_column_name
FROM 
    information_schema.table_constraints AS tc 
	JOIN information_schema.key_column_usage AS kcu 
		ON tc.constraint_name = kcu.constraint_name AND tc.table_schema = kcu.table_schema
	JOIN information_schema.constraint_column_usage AS ccu
		ON ccu.constraint_name = tc.constraint_name AND ccu.table_schema = tc.table_schema
WHERE tc.constraint_type = 'FOREIGN KEY' AND tc.table_name='nome_tabela';
/* OUTRA VERSÃO de consulta com esse objetivo */
select 
	att2.attname as "child_column", 
	cl.relname as "parent_table", 
	att.attname as "parent_column",
	conname
from
	(select 
	    unnest(con1.conkey) as "parent", 
	    unnest(con1.confkey) as "child", 
	    con1.confrelid, 
	    con1.conrelid,
	    con1.conname
	from 
	    pg_class cl
	    join pg_namespace ns on cl.relnamespace = ns.oid
	    join pg_constraint con1 on con1.conrelid = cl.oid
	where
	    cl.relname = 'al_movimento'
	    and ns.nspname = 'solucoesglobais'
	    and con1.contype = 'f'
	) con
	join pg_attribute att on att.attrelid = con.confrelid and att.attnum = con.child
	join pg_class cl on cl.oid = con.confrelid
	join pg_attribute att2 on att2.attrelid = con.conrelid and att2.attnum = con.parent

/*Listar triggers*/
SELECT 
	event_manipulation, 
	trigger_schema||'.'||trigger_name AS where_cond,
	event_object_catalog||'.'||event_object_schema||'.'||event_object_table AS destiny
FROM information_schema.triggers;

/*Listar usuários existens*/
SELECT * FROM pg_user;

/*Listar conexões do banco e suas orígens*/
SELECT datname,usename,client_addr,client_port FROM pg_stat_activity;

/*Parâmetros, pode usar select tabela ou show*/
select setting from pg_settings where name = 'port'
SHOW ALL;
SHOW port;
SHOW data_directory;
SHOW search_path;
SHOW server_encoding;
SHOW server_version;
SHOW data_directory; /* diretório do database*/
SHOW log_timezone; /* Descobrir linguágem, país do database*/
SHOW TimeZone;
SHOW default_text_search_config;

/* Usuários e possivelmente um hash md5 de senha na coluna passwd */
select * from pg_shadow
select * from pg_authid --mesma coisa pelo que me parece

/* Campo de identificação do sistema para cada linha da tabela [ctid], útil para tabelas sem pk(sinistro) */
SELECT ctid,* FROM un_unico ORDER BY ctid;

SELECT * FROM pg_user;
SELECT * FROM pg_views;
SELECT * FROM pg_tables ORDER BY schemaname, tablename;

SELECT table_schema 
FROM information_schema.tables 
WHERE table_schema not IN('information_schema', 'pg_catalog') 
GROUP BY table_schema
ORDER BY table_schema;

--show...
SELECT * FROM information_schema.sequences;
SELECT * FROM information_schema.pg_group;
SELECT * FROM information_schema.pg_indexes;
SELECT * FROM information_schema.parameters;
SELECT * FROM information_schema.attributes;

-- Lista as colunas da tabelas e seus tipos
SELECT column_name,data_type, table_schema
FROM information_schema.columns 
WHERE table_name = 'nome_da_tabela';

-- SEQUENCE, alterar e cunsultar
select pg_catalog.pg_get_serial_sequence('nome_schema.nome_tabela', 'codigo') --nome_sequence
select nextval('nome_schema.nome_sequence')
select pg_catalog.setval(
	pg_catalog.pg_get_serial_sequence('nome_schema.nome_tabela', 'codigo'), 
	(select codigo from nome_schema.nome_tabela order by codigo desc limit 1)+1
)