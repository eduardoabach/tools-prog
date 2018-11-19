
$('div').each(function(){
    var elAt = $(this);
    
    setInterval(function(){
        var cor = '#'+Math.floor(Math.random()*16777215).toString(16);
        elAt.css('background-color', cor+' !important');
    }, 300);
});