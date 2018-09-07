
select ('2012-01-01'::date + (n || ' days')::interval)::date calendar_date
from generate_series(0, 365) n;

--out: rows "2012-01-01", "2012-01-02", "2012-01-03"... "2012-12-31"