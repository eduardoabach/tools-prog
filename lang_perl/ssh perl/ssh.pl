#!/usr/bin/perl

use strict;
use warnings;
use Net::OpenSSH;

my $host = '10.1.1.188';
my $user = 'sg';
my $login_passwd = 'sg';

my $ssh = Net::OpenSSH->new($host, user => $user, password => $login_passwd);
$ssh->error and die "Unable to connect to remote host: " . $ssh->error;

$ssh->system({tty => 1});

$ssh->error and die "error: " . $ssh->error; 