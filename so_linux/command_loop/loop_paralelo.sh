#!/bin/bash
set -m # Enable Job Control

SECONDS=0
qtd_votes_sended=0
interval_load_memory=0

function do_it_on_exit {
    votes_per_second=$(($qtd_votes_sended / $SECONDS));
    printf "\n\n $SECONDS seconds | $qtd_votes_sended votes sended | $votes_per_second votes per second";
}
trap do_it_on_exit EXIT


function load_memory {
    read -r _ memory_free_mb _ <<< "$(grep --fixed-strings 'MemFree' /proc/meminfo)"
    memory_free_mb=$(($memory_free_mb / 1024));
}
load_memory;

while true
do    
    if (($memory_free_mb > 300)); then
        curl -s http://127.0.0.1:5000/votes/do/1 &
        ((qtd_votes_sended += 1))
    else
        sleep 0.4
        load_memory;
    fi

    ((interval_load_memory += 1))
    if (($interval_load_memory > 300)); 
    then 
        load_memory;
        printf "\n free memo: $memory_free_mb";
        ((interval_load_memory = 0))
    fi;
done