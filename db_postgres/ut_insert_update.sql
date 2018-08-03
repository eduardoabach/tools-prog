

-- Simples
INSERT INTO nome_tabela_exemplo (nome_coluna) VALUES ('Carlos');

-- Retornar id do novo registro
INSERT INTO nome_tabela_exemplo( nome, cpf) VALUES( 'Fulano de Tal', '03180405066') RETURNING id

-- Multiplos registros
INSERT INTO nome_tabela_exemplo (nome_coluna) VALUES 
('Carlos'),
('Maria'),
('Pedro'),
('Marcos'),
('Carla'),
('Cristina');


-- Simples
UPDATE tabela_exemplo SET campo_exemplo = 'texto', campo_2 = 42	WHERE id = 5

-- Com case no update
UPDATE tabela_exemplo 
SET quantidade_entrada = (
	CASE
		WHEN quantidade_entrada > 15 THEN quantidade_entrada - 15
		ELSE 0
	END)
WHERE id = 127664

-- Update apenas de registros seguindo lista em um select e formatando valores
UPDATE tabela_exemplo AS update_tb
	SET campo_exemplo = tb_filtro_exemplo.ajust_campo_exemplo,
		campo_exemplo2 = tb_filtro_exemplo.ajust_campo_exemplo2
	FROM
		(
			SELECT 
				orig.id, 
				orig.campo_exemplo AS orig_campo_exemplo, 
				orig.campo_exemplo2 AS orig_campo_exemplo2, 
				ajust.campo_exemplo AS ajust_campo_exemplo,
				ajust.campo_exemplo2 AS ajust_campo_exemplo2
			FROM tabela_exemplo AS orig
			LEFT JOIN tabela_exemplo AS ajust 
				ON ajust.matricula = orig.matricula 
				AND ajust.data = orig.data 
				AND ajust.valor > 0
				AND ajust.id_historico = 3
			WHERE orig.id_historico = 2 AND ajust.id > 0
		) AS tb_filtro_exemplo
	WHERE update_tb.id = tb_filtro_exemplo.id


