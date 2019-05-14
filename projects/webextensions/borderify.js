//document.body.style.borderTop = "30px solid #cccccc";
//document.body.innerHTML = "<div style='background-color: red; padding: 8px; text-align: center; color: #ffffff'>ALERTA! Esse site é uma bosta!</div>"+document.body.innerHTML;
//alert('Olar');

//      "matches": ["*://*/*"], Match all HTTP, HTTPS and WebSocket URLs.
//      "matches": ["<all_urls>"],
//      "matches": ["*://*.mozilla.org/*"], Match all HTTP, HTTPS and WebSocket URLs that are hosted at "mozilla.org" or one of its subdomains.

var list = document.getElementsByTagName('div');
setInterval(function(){
	for (i = 0; i < list.length; i++) {
		var cor = '#'+Math.floor(Math.random()*16777215).toString(16);
		list[i].setAttribute('style', 'background-color: '+cor+' !important');
	}
}, 1000);
