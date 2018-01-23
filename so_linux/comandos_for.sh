
# mostrar valor invertido, .otxetedolpmexE, caso tenha espaço, tranforma em quebra de linha
for d in $(echo 'Exemplodetexto.' | rev | cut -c1-); do echo $d; done

# mostrar lista em ordem reversa com quebras de linha a cada item
# rev: é a ordem invertida, sem ele a lista fica em ordem normal
# -c1-: é o indice inicial, se usar -c2- vai mostrar 8,7,6..., usando -c7- 3, 2, 1
# sed 's/\(.\)/\1 /g': é a quebra de linha
for d in $(echo 123456789 | rev | cut -c1- | sed 's/\(.\)/\1 /g'); do echo $d; done
