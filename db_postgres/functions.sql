
-- DROP FUNCTION schema.data_extenso(date);
CREATE OR REPLACE FUNCTION schema.data_extenso(data_db date) RETURNS text AS
$$
declare
  meses_desc text[] := array['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'] ;
begin
  return extract(day from data_db)::text || ' de ' || meses_desc[(extract(month from data_db))] || ' de ' || extract(year from data_db)::text ;
end ;
$$
  LANGUAGE plpgsql IMMUTABLE STRICT


-------------------------------------

DO
$$
DECLARE
    row record;
    aux record;
BEGIN
    --se existem as duas tabelas, apenas a conf_gerar deve ficar
    EXECUTE 'SELECT count(*) as qtd FROM pg_catalog.pg_tables WHERE schemaname = ''public'' AND tablename in(''conf_gerar'',''conf_gerar_2'')' INTO aux;
    IF(aux.qtd = 2) THEN
    EXECUTE 'DROP TABLE public.conf_gerar_2;';
    END IF;

    FOR row IN SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public' AND (substr(tablename, 1, 3) IN ('conf_'))
    LOOP
    EXECUTE 'SELECT count(*) as qtd FROM pg_catalog.pg_tables WHERE schemaname = ''sistema'' AND tablename = ''' || quote_ident(row.tablename) || '''' INTO aux;
    IF(aux.qtd > 0) THEN
        EXECUTE 'DROP TABLE sistema.' || quote_ident(row.tablename) || ';';
    END IF;
    EXECUTE 'ALTER TABLE public.' || quote_ident(row.tablename) || ' SET SCHEMA sistema;';
    END LOOP;

    EXECUTE 'SELECT count(*) as qtd FROM pg_catalog.pg_tables WHERE schemaname = ''public'' AND (substr(tablename, 1, 3) IN (''conf_''))' into aux;
    IF(aux.qtd > 0) THEN
    UPDATE sistema.conf_params set status = 'P'; --Padrão
    ELSE
    UPDATE sistema.conf_params set status = 'N'; --Novo
    END IF;
END;
$$ LANGUAGE PLPGSQL;

-----------------------------------

DO
$$
DECLARE
    row record;
BEGIN
END;
$$ LANGUAGE PLPGSQL;

DO
$$
DECLARE
    row record;
BEGIN
    FOR row IN SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public' AND (substr(tablename, 1, 3) IN ('fg_'))
    LOOP
        EXECUTE 'ALTER TABLE public.' || quote_ident(row.tablename) || ' SET SCHEMA solucoesglobais;';
    END LOOP;
END;
$$ LANGUAGE PLPGSQL;

UPDATE solucoesglobais.cadcli set aposentadoria_multi = 'M' --P


-- funcional 2


DO
$$
DECLARE
    row record;
    aux record;
BEGIN
    --se existem as duas tabelas, apenas a un_cadcli deve ficar
    EXECUTE 'SELECT count(*) as qtd FROM pg_catalog.pg_tables WHERE schemaname = ''public'' AND tablename in(''un_cadcli'',''fg_clientes'')' INTO aux;
    IF(aux.qtd = 2) THEN
    EXECUTE 'DROP TABLE public.fg_clientes;';
    END IF;

    ALTER TABLE public.un_agencias RENAME TO fg_agencias;
    ALTER TABLE public.un_bairros RENAME TO fg_bairros;
    ALTER TABLE public.un_bancos RENAME TO fg_bancos;
    ALTER TABLE public.un_cadcli RENAME TO fg_clientes;
    ALTER TABLE public.un_cidades RENAME TO fg_cidades;
    ALTER TABLE public.un_ruas RENAME TO fg_ruas;
    ALTER TABLE public.un_unico RENAME TO fg_unico;

    FOR row IN SELECT tablename FROM pg_catalog.pg_tables WHERE schemaname = 'public' AND (substr(tablename, 1, 3) IN ('fg_'))
    LOOP
    EXECUTE 'SELECT count(*) as qtd FROM pg_catalog.pg_tables WHERE schemaname = ''solucoesglobais'' AND tablename = ''' || quote_ident(row.tablename) || '''' INTO aux;
    IF(aux.qtd > 0) THEN
        EXECUTE 'DROP TABLE solucoesglobais.' || quote_ident(row.tablename) || ';';
    END IF;
    EXECUTE 'ALTER TABLE public.' || quote_ident(row.tablename) || ' SET SCHEMA solucoesglobais;';
    END LOOP;

    EXECUTE 'SELECT count(*) as qtd FROM pg_catalog.pg_tables WHERE schemaname = ''public'' AND (substr(tablename, 1, 3) IN (''fg_''))' into aux;
    IF(aux.qtd > 0) THEN
    UPDATE solucoesglobais.cadcli set aposentadoria_multi = 'P'; --P
    ELSE
    UPDATE solucoesglobais.cadcli set aposentadoria_multi = 'M'; --P
    END IF;
END;
$$ LANGUAGE PLPGSQL;