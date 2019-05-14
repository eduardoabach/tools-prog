
// vanilla
var list = document.getElementsByTagName('div');
setInterval(function(){
	for (i = 0; i < list.length; i++) {
		var cor = '#'+Math.floor(Math.random()*16777215).toString(16);
		list[i].setAttribute('style', 'background-color: '+cor+' !important');
	}
}, 1000);

//jquery
setInterval(function(){
	$('div').each(function(){
        var cor = '#'+Math.floor(Math.random()*16777215).toString(16);
        $(this).css('background-color', cor+' !important');
	});
}, 300);