$.ajax({
    url: 'js/vendor/testedb.json',
    dataType: 'json',
    success: function(data) {


        var item = [];

        $.each(data, function(key,val) {
            item.push('<li id="' + key + '">' + val + '</li>');
        });

        $('<ul/>',{
            'class': 'myclass',
            html: item.join('')
        }).appendTo('body');


    },
    statusCode: {
        404: function() {
            alert("some problem");
        }
    },

});

$.getJSON(url_do_json, function(dados) {
    for(var i=0; i<dados.length; i++) {
        $(document.body).append('<div>' + dados[i].titulo + ', ' + dados[i].duracao + '</div>');
    }
});

// #######################################################

//verificar se existe a key no json
if(j.hasOwnProperty('msg')){
    alert(j.msg);
}

// #######################################################

$(function(){
    var jsonString = [{"titulo":"noticia 1","corpo":"corpo da noticia 1","data":"02\/07\/2014"},{"titulo":"noticia 2","corpo":"corpo da noticia 2","data":"02\/07\/2014"},{"titulo":"noticia 3","corpo":"corpo da noticia 3","data":"02\/07\/2014"},{"titulo":"noticia 4","corpo":"corpo da noticia 4","data":"02\/07\/2014"}];

    $.each(jsonString, function(i, item){
        $('.noticias').append("<li>"+ item.data +" - " +item.titulo + "</li>");
    });
});