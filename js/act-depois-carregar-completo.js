// carregar esperando tela carregar tudo antes
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		initApplication();
	}
}