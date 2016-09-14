
/* Endereço ip server do banco */
select inet_server_addr();

/*Database*/
SELECT current_database();

/*Tamanho em bytes do database*/
SELECT pg_catalog.pg_size_pretty(pg_database_size(current_database()));

/*Listar bases*/
SELECT datname FROM pg_database WHERE datistemplate = false ORDER BY datname;

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
SHOW search_path;
SHOW server_encoding;
SHOW server_version;
SHOW data_directory; /* diretório do database*/
SHOW log_timezone; /* Descobrir linguágem, país do database*/
SHOW TimeZone;
SHOW default_text_search_config;

/* Usuários e possivelmente um hash md5 de senha na coluna passwd */
select * from pg_shadow

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


