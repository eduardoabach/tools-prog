
//listar plugins navegador
var qtdPlug = navigator.plugins.length;

alert(
  qtdPlug.toString() + " Plugin(s)<br>" +
  "Name | Filename | description<br>"
);

for(var i = 0; i < qtdPlug; i++) {
  alert(
    navigator.plugins[i].name +
    " | " +
    navigator.plugins[i].filename +
    " | " +
    navigator.plugins[i].description +
    " | " +
    navigator.plugins[i].version +
    "<br>"
  );
}
