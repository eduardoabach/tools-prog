#!/bin/bash

num_exemplo=10
num_exemplo_outro=20
((num_exemplo_outro += 5))

printf "\n num_exemplo: $num_exemplo";
printf "\n num_exemplo_outro: $num_exemplo_outro";

((num_exemplo_outro = num_exemplo_outro * num_exemplo_outro ))

printf "\n num_exemplo_outro: $num_exemplo_outro";
printf "\n";