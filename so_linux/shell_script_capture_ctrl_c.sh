#!/bin/bash

function do_it_on_exit {
    printf "\n\n ao sair do script por varios motivos, vai chegar aqui. \nPode ser com o ctrl + c";
}

function do_it_ctrl_c {
    printf "\n\n Foi o ctrl + c";
    exit
}

trap do_it_ctrl_c SIGINT
trap do_it_on_exit EXIT

while true
do
    printf "\n Interromper manualmente o script...";
    sleep 2
done