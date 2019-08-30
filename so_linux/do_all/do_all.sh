#!/bin/bash
while read -r line
do
    echo "Execute: $line"
    $line
    printf "\n\n"
done < "loop_commands.txt"