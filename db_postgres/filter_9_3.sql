select 
	p.id_cargo,
	sum(p.salario) as salario_total,
	sum(case p.sexo when 'M' then p.salario else 0 end) as salario_homens,
	sum(case p.sexo when 'F' then p.salario else 0 end) as salario_mulheres
from pessoa as p
where p.id_setor = 3 --desenvolvimento
group by p.cargo

-----------------------------------------------------------------

select 
	p.id_cargo,
	sum(p.salario) as salario_total,
	sum(p.salario) filter(p.sexo = 'M') as salario_homens,
	sum(p.salario) filter(p.sexo = 'F') as salario_mulheres
from pessoa as p
group by p.id_cargo
