
select null = null; -- null
select '' = null; -- null
select 10 = null; -- null
select false = null; -- null
select true = null; -- null

select null is null; -- true
select '' is null; -- false
select 10 is null; -- false
select false is null; -- false
select true is null; -- false

select null > 0; -- null
select 4 > null; -- null

select '4'::int > 0; -- true
select '4'::int = 4; -- true
select '5' > '4'; -- true
select '5' > '4,55'; -- true
select '5' > '4.55'; -- true
select '5,11' > '4.55'; -- true
select 5.11 > '4.55'; -- true
select 5.11 > '4.55'; -- true
select 5.11 > '0'; -- true
select 5.11 > ''; -- erro
select 5.11 > ''::int; -- erro
