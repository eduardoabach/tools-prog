
-- Partindo da data atual, gera lista de datas adicionando 7 dias até terminar o ciclo dentro de 355 dias
SELECT current_date + s AS dates FROM generate_series(0,355,7) AS s;

