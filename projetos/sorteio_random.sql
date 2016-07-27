-- Ordena registros de forma aleatória, implementação de sorteio com registro de histórico e opção de não repetir beneficiados.

-- ordena registros de forma aleatória
select * from fg_funcionarios order by random() limit 1000;

-- limitando quantidade de registros por número random
-- flutua por volta do percentual usado do total de registros da tabela
select * from fg_funcionarios where random() < 0.5 order by random();

-----------------------------------------------------------------
-- aplicando a projeto de sorteios seguidos não repetindo pessoas
-- já premiadas antes


create table sorteio_participante (
	id	serial  PRIMARY KEY,
	nome	varchar(80)
);

create table sorteio_log (
	id		serial PRIMARY KEY,
	id_participante	integer not null references sorteio_participante(id),
	data_log	timestamp not null,
	id_sorteio 	char(5)
);

insert into sorteio_participante (nome) values ('Carlos'),('Maria'),('Pedro'),('Marcos'),('Carla'),('Cristina');
insert into sorteio_participante (nome) values ('Antonio'),('Moacir'),('Eduardo'),('Lucas'),('Ana'),('Liane');
insert into sorteio_participante (nome) values ('Gelson'),('Nelson'),('Vanessa'),('Patrícia'),('Amanda'),('Débora');

insert into sorteio_log (id_participante, data_log,id_sorteio) (
	select 
		id,now(), 'prim' as id_sorteio 
	from sorteio_participante as s_p
	where s_p.id not in(
		select s_l.id_participante from sorteio_log as s_l where s_l.id_sorteio in('ingo') 
		)
	order by random() 
	limit 3 -- quantidade de participante no resultado
);

insert into sorteio_log (id_participante, data_log,id_sorteio) (
	select 
		id,now(), 'seg' as id_sorteio 
	from sorteio_participante as s_p
	where s_p.id not in(
		select s_l.id_participante from sorteio_log as s_l where s_l.id_sorteio in('prim') 
		)
	order by random() 
	limit 10
);

-- o limite de 20 não vai ser atingido, os outros foram sorteados anteriormente
-- todos vão ter recebido algum prêmio, mas nunca no mesmo sorteio
insert into sorteio_log (id_participante, data_log,id_sorteio) (
	select 
		id,now(), 'ter' as id_sorteio 
	from sorteio_participante as s_p
	where s_p.id not in(
		select s_l.id_participante from sorteio_log as s_l where s_l.id_sorteio in('prim','seg') 
		)
	order by random() 
	limit 20
);

-- listar os sorteios de teste
select 
	s_l.id_sorteio,
	s_l.id_participante,
	s_p.nome
from sorteio_log as s_l
left join sorteio_participante as s_p on s_p.id = s_l.id_participante;
