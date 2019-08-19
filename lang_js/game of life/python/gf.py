#! /usr/bin/env python

import os
import sys
import time

from gf_cell import Cell, CellCalcAliveFactory

class Gf:
	gen = 0
	gen_limit = 1000000
	delay = 0.2 # clock em segudos
	sz = 12
	cells = {}
	cells_alive_init = []

	def __init__(self, alive_exist=[]):
		sys.setrecursionlimit(self.gen_limit)
		self.cells_alive_init = alive_exist

		self.load_cells(alive_exist)
		self.gen_make()

	def load_cells(self, alive_exist):
		''' A multiplicacao por -1 vai fazer o grid em tela ter a posição 0,0 como central '''
		for n_line in range(self.sz * -1 , self.sz):
			self.cells[n_line] = {}
			for n_column in range(self.sz * -1 , self.sz):
				self.cells[n_line][n_column] = Cell( self.is_exist_alive_init( n_line, n_column ) )

		
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