#! /usr/bin/env python
# ages.py

''' Para testar se uma propriedade existe em um dicionario de forma simples '''

ages = {'Jim': 30, 'Pam': 28, 'Kevin': 33}
person = input('Get age for: ')
age = ages.get(person)

print(f'{person} is {age} years old.' if age else f"{person}'s age is unknown.")