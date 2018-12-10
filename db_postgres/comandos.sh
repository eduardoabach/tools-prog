#!/bin/sh

//Abrir no terminal
sudo -u postgres psql postgres

//Connect
psql -h 127.0.0.1 -U username nomebase

//Backup base usando arquivo 
pg_dump -h 127.0.0.1 -U username -n nomebase>arquivo_destino_da_base
pg_dump -f nome_arquivo_db.dump --username=postgres --host=10.1.1.99 nome_da_base_existente

//Restaurar arquivo de base com arquivo
psql -h 127.0.0.1 -U username -d nomebase -f ./arquivo_destino_da_base
