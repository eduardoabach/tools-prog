
CREATE TABLE public.msg(
	id SERIAL,
	nick CHARACTER VARYING(50) NOT NULL,
	msg CHARACTER VARYING(200) NOT NULL,
	sala CHARACTER VARYING(6) NOT NULL default 'home',
	data timestamp default current_timestamp,
	PRIMARY KEY (id)
)

CREATE OR REPLACE FUNCTION public.MSG_NOTIFY() RETURNS trigger AS
$BODY$
BEGIN
	PERFORM pg_notify(NEW.sala, row_to_json(NEW)::text);
	RETURN new;
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE COST 100;


CREATE TRIGGER msg_aviso
AFTER INSERT
ON public.msg
FOR EACH ROW
EXECUTE PROCEDURE public.MSG_NOTIFY();

--DROP TRIGGER msg_aviso ON public.msg;
--DROP FUNCTION public.MSG_NOTIFY()

/* INSERT INTO public.msg(msg) VALUES ('teste 1'); */