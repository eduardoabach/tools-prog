#!/bin/bash

num_exemplo=10
num_exemplo_outro=20
((num_exemplo_outro += 5))
if [[ (($num_exemplo < 15)) && (($num_exemplo_outro > 30)) ]] || (($num_exemplo_outro <= 25)); 
then
    printf "\n true if";
elif (($num_exemplo == 10));
then
    printf "\n true elif";
else
    #repare que o else não tem o THEN
    printf "\n in else...";
fi;

printf "\n num_exemplo: $num_exemplo";
printf "\n num_exemplo_outro: $num_exemplo_outro";
printf "\n";

