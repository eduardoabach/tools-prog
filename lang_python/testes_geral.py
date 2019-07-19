#! /usr/bin/env python

# rodando o exemplo_metodo aqui teria um erro, ainda nao foi definido
# exemplo_metodo("test message param")

def exemplo_metodo(msg):
	print('msg: ' + msg)

# criar esse def sem nenhuma linha funcional dentro gera um erro
# def do_nothing_but_exists(godParticle):
	
def get_things():
	return ['array','of','things']

def calc_simple():
	return 1+1

def calc_hipotenusa(lado_a, labo_b):
	return ((lado_a**2) + (labo_b**2)) ** 0.5

def calc_hipotenusa_quadrado(lado):
	return calc_hipotenusa(lado, lado)

def show_msg_list(list):
	msg = ''
	for it in list:
		msg += " it(%s)"%(it)

	print('Msg list: ' + msg)

def show_title():
	print(
		'''
			Teste de string com multiplas linhas
			-Sub linha...
		'''
	)

def test_is_cor_azul(cor):
	return bool(cor == 'azul')

def test_numero_maior(num_a, num_b):
	return bool(num_a > num_b)

def test_valid_string(text):
	return bool(text and text.strip())

def test_destria(mao_esquerda, mao_direita):
	if not isinstance(mao_esquerda, bool) or not isinstance(mao_direita, bool):
		return False

	destria = ( 'destro' if mao_direita and not mao_esquerda else
				'canhoto' if mao_esquerda and not mao_direita else
				'ambidestro' if mao_esquerda and mao_direita else
				'desastre' )

	''' A forma acima usa ternário para reduzir o exemplo abaixo
	destria = 'desastre'
	if mao_direita and not mao_esquerda:
		destria = 'destro'
	elif mao_esquerda and not mao_direita:
		destria = 'canhoto'
	elif mao_esquerda and mao_direita:
		destria = 'ambidestro'
	'''

	''' 
		Não é uma boa prática manter código desativado comentado com as 3 aspas, 
		ela é usada para documentação... o ideal é comentar cada linha com '#'
	'''

	return destria

def a():
	dictionary_exemplo = {
		'ao estilo js' : 55,
		'nome' : 'José',
		'subtrai_10' : lambda num_x : num_x-10
	}

	print('__________')
	print(dictionary_exemplo['nome'])
	print(dictionary_exemplo['subtrai_10'](5))

	import json
	print(json.dumps(dictionary_exemplo, indent = 2)) # ao estilo <pre>print_r()</pre>

	simples_assim_tbm_funciona = {'teste' : 'valor', 'teste2' : 55}

def main():
	show_title()
   
    # Simples exemplo de uso de um array
	for it in ['laranja','abacaxi']:
		print("%s"%(it))

	show_msg_list(['carro', 'casa', 'hotel'])

	# repr para debug em python2, reprlib para python3 
	print(repr(get_things()))

	lado = 5
	# lambda function
	calc_hipotenusa_quadrado = lambda lad : calc_hipotenusa(lad, lad)
	hipotenusa_lado = calc_hipotenusa_quadrado(lado)
	print('Hipotenusa de um quadrado de lado %s: %s' % (lado, hipotenusa_lado))

	print('Testes:')
	print('#Teste 1')
	print(test_is_cor_azul('vermelho'))
	print(test_is_cor_azul('azul'))

	print('#Teste 2')
	print(test_numero_maior(2, 7))
	print(test_numero_maior(5, 5))
	print(test_numero_maior(9, 3))

	print('#Teste 3')
	print(test_valid_string(None))
	print(test_valid_string(''))
	print(test_valid_string('  '))
	print(test_valid_string('aaaaa'))

	print('#Teste 4')
	print(test_destria(False, False))
	print(test_destria(True, False))
	print(test_destria(False, True))
	print(test_destria(True, True))
	print(test_destria(None, None)) #out: False
	print(test_destria('asdasdad', 'bbbb')) #out: False
	print(test_destria(55, 99.9)) #out: False



if __name__ == '__main__':
	exemplo_metodo('--Ini--')
	main()
	exemplo_metodo('--Fim--')
