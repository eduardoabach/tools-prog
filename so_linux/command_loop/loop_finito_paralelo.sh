set -m # Enable Job Control

SECONDS=0
qtd_votes_sended=0

function do_it_on_exit {
    votes_per_second=$(($qtd_votes_sended / $SECONDS));
    printf "\n\n $SECONDS seconds | $qtd_votes_sended votes sended | $votes_per_second votes per second";
}
trap do_it_on_exit EXIT

#Atenção! Esse script não implementa um controle de memoria ram, pode acabar, depend do hardware aguentar
for i in `seq 1000`; do # start 1000 jobs in parallel
    curl -s http://127.0.0.1:5000/votes/do/1 & 
    ((qtd_votes_sended += 1))
    # sleep 3 &
done
