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