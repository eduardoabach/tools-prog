
    /**
    Isso tudo ainda nao funciona, está com algum problema na recursiveidade de resolução da operação
    */
    
    function resolveOperacao(operacao){
        console.log('operacao '+operacao);

        if(operacao == parseFloat(operacao))
            return operacao;

        var resultOp = null;
        ['-', '+', '/', '*'].forEach(function(op){
            if(operacao.indexOf(op) > -1){
                console.log('op '+op);

                var listOperador = operacao.split(op);
                if(listOperador.length > 0){
                    if(listOperador.length == 2){
                        return fazOperacao(listOperador[0], listOperador[1], op);
                    } else {
                        var primeiroItem = listOperador[0];
                        listOperador.splice(0, 1);
                        return fazOperacao(primeiroItem, listOperador.join(op), op);
                    }
                }
            }        
        });

        return (resultOp === null) ? operacao : resultOp;
    }

    function fazOperacao(valA, valB, operador){
        valA = parseFloat(resolveOperacao(valA));
        valB = parseFloat(resolveOperacao(valB));
        
        var result = 0;
        if(operador == '*')
            result = valA * valB;
        else if(operador == '/')
            result = valA / valB;
        else if(operador == '+')
            result = valA + valB;
        else if(operador == '-')
            result = valA - valB;

        return result;
    }
    
    console.log(resolveOperacao('20+30+7+3-8'));
    //console.log(resolveOperacao('20+30+5+8+7-3'));
        