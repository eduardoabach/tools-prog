//Botão estilo spam que ao passar mouse ele desaparece e dois aparecem em outros lugares randômicos da tela, ciclo infinito...

var click_spam = {
        Gerar: function(){
                this.CriarElemento();
        },
        CriarElemento: function(){
                var self = this;

                var elemento = document.createElement('div');
                elemento.setAttribute('style', 'background: gray; padding: 10px; position: fixed; cursor: pointer;');
                
                var texto = document.createTextNode('CLICK!');
                elemento.appendChild(texto);
                
                elemento.onmousemove = function(event) {
                        self.MoverElemento(this);
                }

                document.body.appendChild(elemento);

                return elemento;
        },
        PosicaoRandom: function(){
                var docElement = document.documentElement,
                getElBTG = document.getElementsByTagName('body')[0],
                altura = window.innerHeight || docElement.clientHeight || getElBTG.clientHeight - 50,
                largura = window.innerWidth || docElement.clientWidth || getElBTG.clientWidth - 50,
                alturaRandom = Math.floor(Math.random() * altura) - 25,
                larguraRandom = Math.floor(Math.random() * largura) - 25,
                jsonReturn = {'altura': alturaRandom, 'largura': larguraRandom};

                return jsonReturn;
        },
        MoverElemento: function(elementoOrigem){
                var elemento = this.CriarElemento(),
                posNovoElemento = this.PosicaoRandom(),
                posOrigemElemento = this.PosicaoRandom();

                elementoOrigem.style.top = posOrigemElemento.altura + 'px';
                elementoOrigem.style.left = posOrigemElemento.largura + 'px';
                elemento.style.top = posNovoElemento.altura + 'px';
                elemento.style.left = posNovoElemento.largura + 'px';
        }
};

click_spam.Gerar();
