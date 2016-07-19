
/*Connect*/
psql -h 127.0.0.1 -p 5900 -U username database

/*Restaurar base, no exemplo passando para outra em porta diferente */
pg_dump -U postgres -h 10.1.1.21 -p 5432 grupo1_pmalegrete 
psql -U postgres -h 10.1.1.21 -p 5434 -q grupo1_pmalegrete

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

/*Manipular schema*/
CREATE SCHEMA nameschema;
ALTER SCHEMA nameschema RENAME TO newname;
DROP SCHEMA nameschema; --cascade
ALTER TABLE nameschema.nametable SET SCHEMA nameschema_alter; --alterar tabela de um schema para outro
SET search_path TO schema_alter;

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

/*Clonar base para outro lugar*/
pg_dump -U postgres -h 127.0.0.1 -p 5432 databasenametest| psql -U postgres -h 127.0.0.1 -p 5434 -q databasenametest




