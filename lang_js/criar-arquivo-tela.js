
  criar_arquivo_download('teste de conteudo', 'a.txt', 'plain/text');

  function criar_arquivo_download(conteudo, filename, contentType) {
    if(!contentType){
        contentType = 'plain/text';
        //'image/gif', 'plain/text', 'application/octet-stream'
    }
    var element = document.createElement('a');
    element.setAttribute('href', 'data:' + contentType + ';charset=utf-8,' + encodeURIComponent(conteudo));
    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
  }