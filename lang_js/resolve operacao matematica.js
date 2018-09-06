
    function resolveOperacao(operacao){

        if(operacao == parseInt(operacao)){
            return operacao;
        }

        var resultOper = null;
        ['-', '+', '/', '*'].forEach(function(op){
            
            if(resultOper === null && operacao.indexOf(op) > -1){

                var listOperador = operacao.split(op);
                if(listOperador.length > 0){
                    
                    var primeiroItem = listOperador[0];
                    listOperador.splice(0, 1);
                    resultOper = fazOperacao(primeiroItem, listOperador.join(op), op);
                }
            }    
        });

        return resultOper;
    }

    function fazOperacao(valA, valB, operador){
        valA = resolveOperacao(valA);
        valB = resolveOperacao(valB);
        
        if(valA == parseInt(valA)){
            valA = parseInt(valA);
        }
        
        if(valB == parseInt(valB)){
            valB = parseInt(valB);
        }
        
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
    
//        console.log(fazOperacao('7+1','3+1','+'));
//        console.log(resolveOperacao('20+30+7+3*8'));
    //console.log(resolveOperacao('20+30+5+8+7-3'));
        