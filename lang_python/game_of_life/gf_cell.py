#! /usr/bin/env python

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