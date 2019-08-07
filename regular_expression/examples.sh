
# emailexemplo@local.com
"(\w+)\@(\w+)\.(\w+)" 

# (51) 4444.44449
"\((?:[0-9]{2})\)?[\s\S](?:[0-9]{4})[\s\S](?:[0-9]{4,5})" 

# 0 ~ 99999
"^(?:[0-9]{1,5})$" 

# 0000 ~ 9999, mas 450 não funciona, apenas 0450
"^(?:[0-9]){4}$" 

# 192.168.10.8 ip simples
"([0-9]{1,3}\.){3}([0-9]{1,3})" 

# 192.168.0.1/24 ip com validação mais complexa
"((^|\\.)((25[0-5])|(2[0-4]\\d)|(1\\d\\d)|([1-9]?\\d))){4}\\/(?:\\d|[12]\\d|3[01])$"

# Uso do OR, vai pegar as palavras e os pontos finais
"[\w]|[.]"

# Return true para string em branco: ''
# You can use ^ to match beginning-of-line, and $ to match end-of-line, 
# thus the regular expression ^$ would match an empty line/string. 
"^$|[\w]|[.]"
