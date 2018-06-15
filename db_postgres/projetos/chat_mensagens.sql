
CREATE TABLE chat(
	id serial,
	tm timestamp default current_timestamp,
	msg text,
	nick varchar(100)
);

INSERT INTO chat(msg, nick) VALUES('outro teste, momento...', 'bot2')
SELECT * FROM chat
SELECT 
	nick, 
	TO_CHAR(tm, 'HH:MI:SS - DD/MM/YYYY') as tm_h,
	msg
from chat
order by tm