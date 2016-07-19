
/*Listar bases*/
SELECT datname FROM pg_database WHERE datistemplate = false order by datname;

/*Nome do schema atual*/
show search_path;
SELECT catalog_name FROM information_schema.information_schema_catalog_name;
SELECT table_catalog FROM information_schema.tables limit 1;

/*Listar Schemas existentes na base*/
SELECT table_schema 
FROM information_schema.tables 
where table_schema not in('information_schema', 'pg_catalog') 
group by table_schema
order by table_schema;

/*Listar tabelas e seus schemas*/
SELECT table_schema, table_name 
FROM information_schema.tables 
where table_type = 'BASE TABLE' and table_schema not in('information_schema', 'pg_catalog')
order by table_schema, table_name; --table_type = 'VIEW'

/*Listar triggers*/
SELECT 
	event_manipulation, 
	trigger_schema||'.'||trigger_name as where,
	event_object_catalog||'.'||event_object_schema||'.'||event_object_table as destiny
FROM information_schema.triggers;

SELECT * FROM pg_user;

/*Parâmetros*/
SHOW ALL;
SHOW log_timezone;
SHOW TimeZone;
SHOW port;
SHOW search_path;
SHOW server_encoding;
SHOW server_version;


SELECT 
	event_manipulation, 
	trigger_schema||'.'||trigger_name as where,
	event_object_catalog||'.'||event_object_schema||'.'||event_object_table as destiny
FROM information_schema.triggers;


SELECT * FROM pg_user;
SELECT * FROM pg_views;
SELECT * FROM pg_tables order by schemaname, tablename;

SELECT table_schema 
FROM information_schema.tables 
where table_schema not in('information_schema', 'pg_catalog') 
group by table_schema
order by table_schema;

SELECT * FROM information_schema.tables;

SELECT * FROM pg_settings;

--show ls

SELECT * FROM information_schema.tables;
SELECT * FROM information_schema.sequences;
SELECT * FROM information_schema.pg_group;
SELECT * FROM information_schema.pg_user;
SELECT * FROM information_schema.pg_views;
SELECT * FROM information_schema.pg_tables;
SELECT * FROM information_schema.pg_indexes;
SELECT * FROM information_schema.pg_settings;
SELECT * FROM information_schema.parameters;
SELECT * FROM information_schema.attributes;


