var anexos = {
    
    listaArquivos: [],
    tipoUpload: null,
    urlAnex: sys_dir + 'anexos.php',
    
    Init: function(tipoUpload, divForm){
        var self = this;
        self.tipoUpload = tipoUpload;
        post(self.urlAnex, {
            acao: 'form'
        }, function (div) {
            divForm.innerHTML = div;
            self.Render(divForm);
        });
    },
    Render: function(content){
        var self = this;
        var formAnexos = content.getElementsByClassName('form-anexos')[0];
        var elDescricao = content.getElementsByClassName('anex-descricao')[0];
        var elArquivo = content.getElementsByClassName('anex-arquivo')[0];
        var elBtnAdd = content.getElementsByClassName('anex-add')[0];
        var elLista = content.getElementsByClassName('anex-lista')[0];

        // Validar a existência dos campos
        if(!formAnexos || !elDescricao || !elArquivo || !elBtnAdd || !elLista)
            return false;

        formAnexos.addEventListener('submit', function (evnt) {
          
        });

        elBtnAdd.addEventListener('click', function(){
            var descricao = elDescricao.value;
            for (var i = 0; i < elArquivo.files.length; i++) {    
                self.listaArquivos.push({
                    descricao: descricao,
                    arquivo: elArquivo.files[i]
                });

                var elListaItem = document.createElement('p');
                elListaItem.innerHTML = self.listaArquivos.length + ': ' + descricao;
                elLista.appendChild(elListaItem);
            }

            elDescricao.value = '';
            elArquivo.value = '';
        });

        elArquivo.addEventListener('change', function (evnt) {
            var descricao = elDescricao.value;
            if(elDescricao.value == ''){
                for (var i = 0; i < elArquivo.files.length; i++) {    
                    elDescricao.value = elArquivo.files[i].name;
                }
            }
        });
    },
    
    Enviar: function(idUpload){
        if(idUpload > 0){
            this.listaArquivos.forEach(function (dadosArquivo) {
                dadosArquivo[id_upload] = idUpload;
                self.enviarArquivo(dadosArquivo);
            });
        }
    },
    EnviarArquivo: function (dadosArquivo, callback) {
        var self = this;
        var formData = new FormData();
        formData.set('arquivo', dadosArquivo.arquivo);
        formData.set('descricao', dadosArquivo.descricao);

        var request = new XMLHttpRequest();
        request.open("POST", self.urlAnex);
        request.onload = function(e) {
            if (request.status == 200) {
                console.log('Upload Completo.');
            } else {
                console.log('Erro Upload: ' + request.status + '.');
            }
        };
        request.send(formData);
    }
};