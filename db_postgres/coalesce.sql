
select COALESCE(null,null,3); -- 3
select COALESCE(4,null,1); -- 4
select COALESCE(1,null,4); -- 1
select COALESCE(1,null,4,null); -- 1
select COALESCE(null,1,null,4,null); -- 1
