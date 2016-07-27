
/* Tamanho geral do database */
SELECT pg_catalog.pg_size_pretty(pg_database_size(current_database()));

/* Tamanho de uma tabela */
select pg_catalog.pg_size_pretty(pg_relation_size('nomeschema.nometabela'));

/* Lista de tamanho das tabela */
SELECT n.nspname as "Schema",
  c.relname as "Tabela",
  pg_catalog.pg_size_pretty(pg_table_size(c.oid)) as "Tamanho",
  pg_catalog.pg_size_pretty(pg_total_relation_size(c.oid)) as "Tamanho total"
FROM pg_catalog.pg_class c
LEFT JOIN pg_catalog.pg_namespace n ON n.oid = c.relnamespace
WHERE c.relkind IN ('r','')
      AND n.nspname <> 'pg_catalog'
      AND n.nspname <> 'information_schema'
      AND n.nspname !~ '^pg_toast'
      AND pg_catalog.pg_table_is_visible(c.oid)
      --AND pg_table_size(c.oid) > 1073741824 -- >1GB
ORDER BY pg_table_size(c.oid) DESC,1,2;