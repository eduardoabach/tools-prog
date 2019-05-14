#!/bin/bash
while read line
do
    ssh abc_def@"$line" "hostname; ls;" < /dev/null
done < "$1"