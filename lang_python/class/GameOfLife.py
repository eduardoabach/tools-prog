#! /usr/bin/env python
import random

class Bot:
	name = 'X'
	pos_x = 0
	pos_y = 0
	log_gen = []
	possible_moves = 8 # 4 movs em cruz(+), mais os 4 movs em (X)
	environment = None

	def __init__(self, name=None):
		if name:
			self.name = name

	def set_environment(self, env):
		self.environment = env

	def set_log_gen(self):
		self.log_gen.append({ 
			'g': self.environment.gen,
			'x': self.pos_x,
			'y': self.pos_y
		})

	def set_pos(self, pos_x, pos_y):
		self.pos_x = pos_x
		self.pos_y = pos_y
	
	def set_pos_random(self):
		sz = self.environment.size
		possit_invalid = []
		for tentat in range(sz * sz):
			pos = self.get_position_environment_random()
			
			possit_invalid.append(pos)
			if self.environment.verif_empty_cell(pos['x'], pos['y']):
				self.set_pos(pos['x'], pos['y'])


	def get_position_environment_random(self):
		sz = self.environment.size
		return { 'x' :  random.randrange(1, sz+1) , 'y' : random.randrange(1, sz+1) }
		
	def change(self):
		self.set_log_gen()
		self.move()

	def move(self):
		pos_moved_selected = self.move_select()
		if pos_moved_selected:
			self.set_pos(pos_moved_selected['x'], pos_moved_selected['y'])

	def move_cell_cords_result(self, cell_el, direction_cords):
		return { 
			'x' : cell_el.pos_x + direction_cords['x'], 
			'y' : cell_el.pos_y + direction_cords['y']
		}

	def move_select(self):

		possit_invalid = []
		for tentat in range( self.possible_moves ): 

			direct = self.get_direction_random(possit_invalid)
			if not direct:
				return False # não foi possível criar um movimento válido

			pos_moved = self.move_cell_cords_result(self, direct)
			possit_invalid.append(direct)
			if self.environment.verif_empty_cell(pos_moved['x'], pos_moved['y']):
				return pos_moved
		
		return False

	def get_direction_random(self, list_direct_indisponible=[]):

		for tentat in range( self.possible_moves ):

			while True: #evitar o vetor de direção 0,0
				direct = { 'x' :  random.randrange(-1,2) , 'y' : random.randrange(-1,2) }
				if not (direct['x'] == 0 and direct['y'] == 0):
					break

			valid = True
			for direct_indisp in list_direct_indisponible:
				if direct['x'] == direct_indisp['x'] and direct['y'] == direct_indisp['y']:
					valid = False
					break
			
		return direct if valid else False





