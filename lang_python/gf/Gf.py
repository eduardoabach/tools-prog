#! /usr/bin/env python

import os
import sys
import time
import random

#https://pt.wikipedia.org/wiki/Jogo_da_vida

class Cell:
	alive = False
	neighbor_alive = 0

	def __init__(self, alive = False):
		self.alive = alive

	def check(self):
		if self.neighbor_alive < 2: #morre de solidão
			self.die()
		elif self.neighbor_alive > 3: #morre por superpopulação
			self.die()
		elif self.neighbor_alive == 3 and not self.alive: #nasce uma nova vida
			self.born()

	def born(self):
		self.alive = True

	def die(self):
		self.alive = False
		
	def neighbor_reset(self):
		self.neighbor_alive = 0

	def neighbor_add_alive(self):
		self.neighbor_alive += 1

class CellCalcAliveFactory:
	cell_list = {}
	cell = None
	n_line = None
	n_column = None
	n_qtd = None

	def __init__(self, cell_list):
		self.cell_list = cell_list
		self.do()

	def do(self):
		for n_line, line in self.cell_list.items():
			for n_column, cell in line.items():
				self.set_check(cell, n_line, n_column)
				self.check()

	def set_check(self, cell, line, column):
		cell.neighbor_reset()
		self.cell = cell
		self.n_line = line
		self.n_column = column

	def check(self):

		line = self.n_line
		line_UP = line-1
		line_DOWN = line+1

		column = self.n_column
		column_L = column-1
		column_R = column+1
		
		self.check_alive(line_UP, column_L)
		self.check_alive(line_UP, column)
		self.check_alive(line_UP, column_R)

		self.check_alive(line, column_L)
		self.check_alive(line, column_R)

		self.check_alive(line_DOWN, column_L)
		self.check_alive(line_DOWN, column)
		self.check_alive(line_DOWN, column_R)

	def check_alive(self, n_line, n_column):
		if n_line in self.cell_list:
			if n_column in self.cell_list[n_line]:
				if self.cell_list[n_line][n_column].alive:
					self.add_alive()

	def add_alive(self):
		self.cell.neighbor_add_alive()


class Gf:
	gen = 0
	gen_limit = 1000000
	delay = 0.2 # clock em segudos
	sz = 10
	cells = {}
	cells_alive_init = []

	def __init__(self, alive_exist=[]):
		sys.setrecursionlimit(self.gen_limit)
		self.cells_alive_init = alive_exist

		self.load_cells(alive_exist)
		self.gen_make()

	def load_cells(self, alive_exist):
		for n_line in range(self.sz * -1 , self.sz):
			self.cells[n_line] = {}
			for n_column in range(self.sz * -1 , self.sz):
				self.cells[n_line][n_column] = Cell( self.is_exist_alive_init( n_line, n_column ) )


		#for n_line in range(0, self.sz):
		#	self.cells[n_line] = {}
		#	for n_column in range(0, self.sz):
		#		self.cells[n_line][n_column] = Cell( self.is_exist_alive_init( n_line, n_column ) )
		
	def is_exist_alive_init(self, n_line, n_column):
		for cord_alive in self.cells_alive_init:
			if cord_alive[0] == n_line and cord_alive[1] == n_column:
				return True
		return False

	def gen_make(self):
		self.gen += 1
		self.gen_check_rules()
		self.interface_render()

		time.sleep(self.delay)
		self.gen_make()

		
	def gen_check_rules(self):
		CellCalcAliveFactory(self.cells)
		for line in self.cells.values():
			for cell in line.values():
				cell.check()

	def interface_render(self):
		view = 'Generation: ' + str(self.gen)

		for line in self.cells.values():
			view += self.interface_break_line()
			for cell in line.values():
				view += '[X]' if cell.alive else '[ ]'
				#view += 'o' if cell.alive else '.'

		os.system('clear')
		print(view)


	def interface_break_line(self):
		return '''
'''


list_opt = {
	"Clear": [],
	"Glider": [[1,0], [2,1], [2,2], [1,2], [0,2]],
	"Small Exploder": [[0,1], [0,2], [1,0], [1,1], [1,3], [2,1], [2,2]],
	"Exploder": [[0,0], [0,1], [0,2], [0,3], [0,4], [2,0], [2,4], [4,0], [4,1], [4,2], [4,3], [4,4]],
	"10 Cell Row": [[0,0], [1,0], [2,0], [3,0], [4,0], [5,0], [6,0], [7,0], [8,0], [9,0]],
	"Lightweight spaceship": [[0,1], [0,3], [1,0], [2,0], [3,0], [3,3], [4,0], [4,1], [4,2]],
	"Tumbler": [[0,3], [0,4], [0,5], [1,0], [1,1], [1,5], [2,0], [2,1], [2,2], [2,3], [2,4], [4,0], [4,1], [4,2], [4,3], [4,4], [5,0], [5,1], [5,5], [6,3], [6,4], [6,5]],
	"Gosper Glider Gun": [[0,2], [0,3], [1,2], [1,3], [8,3], [8,4], [9,2], [9,4], [10,2], [10,3], [16,4], [16,5], [16,6], [17,4], [18,5], [22,1], [22,2], [23,0], [23,2], [24,0], [24,1], [24,12], [24,13], [25,12], [25,14], [26,12], [34,0], [34,1], [35,0], [35,1], [35,7], [35,8], [35,9], [36,7], [37,8]]
}

test = Gf(list_opt['Glider'])

glid_tested = [ [1,2],[2,3],[3,1],[3,2], [3,3] ]
#test = Gf(glid_tested)



'''
test = Gf([
	[0,0],[0,1],[0,2],
	[1,0],[1,1],[1,2],
	[2,0],[2,1],[2,2]
])'''