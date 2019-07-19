#! /usr/bin/env python
import time

class Semaf:
	state = 'red'

	def __init__(self):
		self.change()

	def change(self, time_delay = None):

		print(self.state)

		if time_delay:
			time.sleep(time_delay)

		test_func = { 'green' : self.state_to_yellow, 'yellow' : self.state_to_red, 'red' : self.state_to_green}
		test_func[self.state]()

		''' Same effect with dict()
		if self.state == 'green':
			self.state_to_yellow()
		elif self.state == 'yellow':
			self.state_to_red()
		elif self.state == 'red':
			self.state_to_green()
		'''

	def state_to_green(self):
		self.state = 'green'
		self.change(5)

	def state_to_yellow(self):
		self.state = 'yellow'
		self.change(2)

	def state_to_red(self):
		self.state = 'red'
		self.change(15)


s1 = Semaf()
