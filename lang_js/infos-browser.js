//infos do browser
alert(location);
alert(location.pathname);
alert(location.origin); //ultimo endereço no voltar do nav.
alert(location.protocol);	
alert(location.port);
alert(location.host);

//location.replace("http://www.w3schools.com"); // alterar tela sem opt de voltar, parece estar na mesma, nao mostra no historico ultima
//navigator.plugins; // objeto lista
//navigator.plugins['Shockwave Flash']; // objeto
alert(navigator.plugins['Shockwave Flash'].version);

//document.links //lista links tela
//document.images //lista imgs...

alert(document.lastModified);
alert(document.cookie);
document.cookie = "favorite_food=tripe";