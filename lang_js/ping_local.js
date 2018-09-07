
// Descobrir se o host da aplicação está respondendo
function ping_local(){
	// Abrir uma nova requisicao com um parametro random para evitar o cache
	var xhr = new ( window.ActiveXObject || XMLHttpRequest )( "Microsoft.XMLHTTP" );
	xhr.open( "HEAD", location + "?rand=" + Math.floor((1 + Math.random()) * 0x10000), false );

	try {
		xhr.send();
		//console.log(xhr.status);
		return(xhr.status >= 200 && (xhr.status < 300 || xhr.status === 304));
	} catch (error) {
		return false;
	}
}