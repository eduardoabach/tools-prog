
CREATE SCHEMA avaliador;
SET search_path TO avaliador;

create table crit (
	id serial  PRIMARY KEY,
	name varchar(80),
	description varchar(200),
	value_min integer not null default 0,
	value_max integer not null default 100,
	size integer not null default 50,
	desc_ref_min varchar(100),
	desc_ref_max varchar(100)
);

create table caract (
	id serial  PRIMARY KEY,
	name varchar(80),
	description varchar(200),
	size integer not null default 50
);

create table item (
	id serial  PRIMARY KEY,
	name varchar(80),
	description varchar(200)
);

create table item_crit (
	id serial PRIMARY KEY,
	id_item integer not null references item(id),
	id_crit integer not null references crit(id),
	value integer
);

create table item_caract (
	id serial PRIMARY KEY,
	id_item integer not null references item(id),
	id_caract integer not null references caract(id),
	status char(1) not null default '+'
);
