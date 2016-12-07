
-- Deletar linhas duplicadas
DELETE FROM nometabela WHERE ctid NOT IN
	(SELECT max(ctid) FROM nometabela GROUP BY campoid,complementochave);

-- Deletar registros seguindo lista de select
DELETE FROM tabela_exemplo WHERE tabela_exemplo.id IN(
	SELECT
		ajust.id
	FROM tabela_exemplo AS orig
	WHERE orig.id_historico = 2 AND ajust.valor > 0
)



