#!/usr/bin/python

import paramiko
ssh = paramiko.SSHClient()
ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())
ssh.connect('10.1.1.188', username='sg', password='sg')
stdin, stdout, stderr = ssh.exec_command('ls\n')