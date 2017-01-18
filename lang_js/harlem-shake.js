(function () {

        var MIN_HEIGHT = 30;
        var MIN_WIDTH = 30;
        var MAX_HEIGHT = 350;
        var MAX_WIDTH = 350;

        var CAMINHO_AUDIO = "//s3.amazonaws.com/moovweb-marketing/playground/harlem-shake.ogg";
        var CAMINHO_CSS = "//s3.amazonaws.com/moovweb-marketing/playground/harlem-shake-style.css";

        var CSS_BASE = "mw-harlem_shake_me";
        var CSS_DEVAGAR = "mw-harlem_shake_slow";
        var CSS_PRIMEIRO = "im_first";
        var CSS_OUTROS = ["im_drunk", "im_baked", "im_trippin", "im_blown"];
        var CSS_STROBE = "mw-strobe_light";
        var CSS_ARQUIVO_CRIADO = "mw_added_css";

        function addCSS() {
                var css = document.createElement("link");
                css.setAttribute("type", "text/css");
                css.setAttribute("rel", "stylesheet");
                css.setAttribute("href", CAMINHO_CSS);
                css.setAttribute("class", CSS_ARQUIVO_CRIADO);

                document.body.appendChild(css);
        }

        function removerArquivosAdicionados() {
                var arquivosAdicionados = document.getElementsByClassName(CSS_ARQUIVO_CRIADO);
                for (var i = 0; i < arquivosAdicionados.length; i++) {
                        document.body.removeChild(arquivosAdicionados[i]);
                }
        }

        function flashTela() {
                var flash = document.createElement("div");
                flash.setAttribute("class", CSS_STROBE);
                document.body.appendChild(flash);

                setTimeout(function () {
                        document.body.removeChild(flash);
                }, 100);
        }

        function tamanho(elemento) {
                return {
                        height: elemento.offsetHeight,
                        width: elemento.offsetWidth
                };
        }

        function dentroLimite(elemento) {
                var elementoTamanho = tamanho(elemento);
                return (elementoTamanho.height > MIN_HEIGHT &&
                        elementoTamanho.height < MAX_HEIGHT &&
                        elementoTamanho.width > MIN_WIDTH &&
                        elementoTamanho.width < MAX_WIDTH);
        }

        function posY(elemento) {
                var alt = elemento;
                var topPosicao = 0;
                while (!!alt) {
                        topPosicao += alt.offsetTop;
                        alt = alt.offsetParent;
                }
                return topPosicao;
        }

        function alturaTela() {
                var tela = document.documentElement;
                if (!!window.innerWidth) {
                        return window.innerHeight;
                } else if (tela && !isNaN(tela.clientHeight)) {
                        return tela.clientHeight;
                }
                return 0;
        }

        function scrollY() {
                if (window.pageYOffset) {
                        return window.pageYOffset;
                }
                return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
        }

        var vpH = alturaTela();
        var st = scrollY();
        function estaVisivel(node) {
                var y = posY(node);

                return (y >= st && y <= (vpH + st));
        }

        function tocarAudio() {
                var audioEl = document.createElement("audio");
                audioEl.setAttribute("class", CSS_ARQUIVO_CRIADO);
                audioEl.src = CAMINHO_AUDIO;
                audioEl.loop = false;

                var harlem = false,
                        shake = false,
                        slowmo = false;

                audioEl.addEventListener("timeupdate", function () {
                        var tempo = audioEl.currentTime,
                                nodes = listaElementosMovimento,
                                len = nodes.length, i;

                        // início do som, apenas primeiro em movimento
                        if (tempo >= 0.5 && !harlem) {
                                harlem = true;
                                moverPrimeiro(primeiroElemento);
                        }

                        // zueira iniciada
                        if (tempo >= 15.5 && !shake) {
                                shake = true;
                                pararTodoMovimento();
                                flashTela();
                                for (i = 0; i < len; i++) {
                                        moverOutros(nodes[i]);
                                }
                        }

                        // velocidade lenta do final
                        if (audioEl.currentTime >= 28.4 && !slowmo) {
                                slowmo = true;
                                moverDevagarTodos();
                        }
                }, true);

                audioEl.addEventListener("ended", function () {
                        pararTodoMovimento();
                        removerArquivosAdicionados();
                }, true);

                audioEl.innerHTML = "<p>Seu navegador não tem suporte a zueira(elementos de audio).</p>";

                document.body.appendChild(audioEl);
                audioEl.play();
        }

        function moverPrimeiro(elemento) {
                elemento.className += " " + CSS_BASE + " " + CSS_PRIMEIRO;
        }
        function moverOutros(elemento) {
                // define variedade de efeitos no movimento dos elementos
                var outroUsar = Math.floor(Math.random() * CSS_OUTROS.length);
                elemento.className += " " + CSS_BASE + " " + CSS_OUTROS[outroUsar];
        }

        function moverDevagarTodos() {
                var elementosMovendo = document.getElementsByClassName(CSS_BASE);
                for (var i = 0; i < elementosMovendo.length; ) {
                        elementosMovendo[i].className = elementosMovendo[i].className.replace(CSS_BASE, CSS_DEVAGAR);
                }
                CSS_BASE = CSS_DEVAGAR;
        }

        function pararTodoMovimento() {
                var elementosMovendo = document.getElementsByClassName(CSS_BASE);
                var regex = new RegExp('\\b' + CSS_BASE + '\\b');
                for (var i = 0; i < elementosMovendo.length; ) {
                        elementosMovendo[i].className = elementosMovendo[i].className.replace(regex, "");
                }
        }

        var todosElementos = document.getElementsByTagName("*"), len = todosElementos.length, i, elementoAtual;
        var primeiroElemento = null;
        for (i = 0; i < len; i++) {
                elementoAtual = todosElementos[i];
                if (dentroLimite(elementoAtual)) {
                        if (estaVisivel(elementoAtual)) {
                                primeiroElemento = elementoAtual;
                                break;
                        }
                }
        }

        if (elementoAtual === null) {
                console.warn("Essa página não tem ingredientes para a zueira. Tente em outra página, JUST DO IT!");
                return;
        }

        addCSS();

        tocarAudio();

        var listaElementosMovimento = [];

        for (i = 0; i < len; i++) {
                elementoAtual = todosElementos[i];
                if (dentroLimite(elementoAtual)) {
                        listaElementosMovimento.push(elementoAtual);
                }
        }

})();
