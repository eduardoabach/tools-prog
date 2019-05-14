#! /usr/bin/env python

#import secure
import pexpect

# the file containing the list of servers to log into
input_file = "list.txt"

# The login creds
#user = secure.USER 
#password= secure.PASSWORD
user = 'sg'
password= 'sg'

print('a1')

def ssh_command (user, host, password, command):

	print('connect', host)

	ssh_newkey = 'Are you sure you want to continue connecting'
	child = pexpect.spawn('ssh -l %s %s %s'%(user, host, command))
	i = child.expect([pexpect.TIMEOUT, ssh_newkey, 'password: '])
	if i == 0: # Timeout
		print('ERROR!')
		# print('SSH could not login. Here is what SSH said:')
		# print(child.before, child.after)
		return None
	if i == 1: # SSH does not have the public key. Just accept it.
		child.sendline ('yes')
		child.expect ('password: ')
		i = child.expect([pexpect.TIMEOUT, 'password: '])
		if i == 0: # Timeout
			print('9ERROR!')
			# print('SSH could not login. Here is what SSH said:')
			# print(child.before, child.after)
			return None       
	child.sendline(password)
	return child

def main():

	print('a2')
	f = open(input_file, "r")
	server_list = f.readlines()
   
	for server in server_list:
		child = ssh_command (user, server, password, 'ls')
		#child = ssh_command (user, server, password, 'script.sh')
		child.expect(pexpect.EOF)
		output = child.before

if __name__ == "__main__":
	main()
