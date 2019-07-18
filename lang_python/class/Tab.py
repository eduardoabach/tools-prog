#! /usr/bin/env python

import sys
import os
import time

from Bot import Bot

class Tab:
	gen = 0
	gen_limit = 1000000
	delay = 0.1 # clock em segudos
	size = 20
	list_el_content = []

	def __init__(self, list_init=[]):
		sys.setrecursionlimit(self.gen_limit)

		self.list_el_content = list_init
		self.load_el_content()
		self.change()

	def load_el_content(self):
		for el in self.list_el_content:
			el.set_environment(self)
			el.set_pos_random()

	def change(self):
		self.gen += 1
		self.change_content()
		self.render()

		# define perpetual loop
		time.sleep(self.delay)
		self.change()

	def change_content(self):
		for el in self.list_el_content:
			el.change()

	def render(self):
		view = 'Generation: ' + str(self.gen)
		for num_line in range(1, self.size+1):
			view += self.get_view_line(num_line)

		os.system('clear')
		print(view)

	def get_view_line(self, num_line):
		line_view = ''
		for num_column in range(1, self.size+1):
			line_view += self.get_view_cell(num_line, num_column)

		return self.get_break_line() + line_view

	def get_view_cell(self, num_line, num_column):
		cell = self.verif_el_exist_in_cell(num_line, num_column)
		return '[' + cell.name + ']' if cell  else '[ ]'

	def get_break_line(self):
		return '''
'''

	def verif_empty_cell(self, num_line, num_column):
		if num_line < 1 or num_line > self.size or num_column < 1 or num_column > self.size:
			return False
		return not self.verif_el_exist_in_cell(num_line, num_column)

	def verif_el_exist_in_cell(self, num_line, num_column):
		for it in self.list_el_content:
			if it.pos_x == num_line and it.pos_y == num_column:
				return it
		return False

t1 = Tab( [ Bot('A'), Bot('B') ] )
