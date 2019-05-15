

// quantidade de elementos no DOM
document.getElementsByTagName('*').length

alert('test');


// ----------------------------------------------------

var dataUsExemplo = '2018-04-25';
console.log(dataUsExemplo.split('-').reverse().join('/')); // out: 25/04/2018

// ----------------------------------------------------

var respostaDeletar = confirm("Deseja deletar?");
if (respostaDeletar == true) {
} else {
}

var idade = prompt("Qual é a sua idade?", '18');
if(idade > 18) {
}

history.back();
history.go(-1);

// carregar esperando tela carregar tudo antes
document.onreadystatechange = function () {
    if (document.readyState == "complete") {
        initApplication();
    }
}

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
//navigator.appCodeName = "Mozilla"
//navigator.oscpu = "Linux x86_64"
//navigator.platform = "Linux x86_64"

screen.width
screen.height //total do display

innerWidth
innerHeight //disponivel para a pagina real

screen.availWidth
screen.availHeight //disponivel para o browser, mas sem descontar console e barras dele

txt += "<p>Color depth: " + screen.colorDepth + "</p>";
txt += "<p>Color resolution: " + screen.pixelDepth + "</p>"; 

//navigator.appCodeName = "Mozilla"
//navigator.appCodeName = "Mozilla"
//navigator.appCodeName = "Mozilla"
//navigator.appCodeName = "Mozilla"
//navigator.appCodeName = "Mozilla"




//document.links //lista links tela
//document.images //lista imgs...

alert(document.lastModified);
alert(document.cookie);
document.cookie = "favorite_food=tripe";


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



// ----------------------------------------------------

// criar array
var arrExemplo1 = [];
console.log(arrExemplo1.length); // mostra 0
arrExemplo1.push("teste"); // ["teste"], index 0
console.log(arrExemplo1[0]); // mostra teste
console.log(arrExemplo1.length); // mostra 1

//remover itens de um array
var arrayExemplo = ["bar", "baz", "foo", "qux"]; // index = 0,1,2,3
arrayExemplo.splice(2, 1); // Inicia na index 2, removendo um elemento = ["bar", "baz", "qux"]
arrayExemplo.splice(2,2); // Inicia na index 2, removendo dois elementos = ["bar", "baz"]

// criar objeto
var objExemplo1 = {};
objExemplo1.item = "teste"; // {item: "teste"}
console.log(objExemplo1.item); // mostra teste

// remover itens em um objeto
objExemplo1.remove('item');

var objsMove = document.getElementsByClassName("class-nome-exemplo");
Object.keys(object).map(function(objectKey, index) {
    var value = object[objectKey];
    console.log(value);
});

// Se existe atributo
var x = document.getElementById("myBtn").hasAttribute("onclick"); 

Math.round(1.005 * 1000)/1000 // Returns 1 instead of expected 1.01!
parseFloat("1.555").toFixed(2); // Returns 1.55 instead of 1.56.

// Criar um observador de evento, ótimo para callback envolvendo a interface
document.getElementById('anchor').addEventListener('click', function() {
	console.log('anchor');
});

//verificar se existe a key no json
if(j.hasOwnProperty('msg')){
    alert(j.msg);
}

// ************************************************

// Identificando o nome de uma class / objeto / function
function Animal() {}
var cachorro = new Animal();

typeof Animal;        // == "function"
typeof cachorro;      // == "object"

cachorro instanceof Animal;     // == true
cachorro.constructor.name;      // == "Animal"
Animal.name                     // == "Animal"    

// ************************************************
  
var Pessoa = {
   nome: '',
   idade: 22,
   tipo: 'human',
   apresentar: function() {
       console.log('Olá, meu nome é ' + this.nome + ' e eu sou um ' + this.tipo + '.' );
   }
};

var RoboTeste = Object.create(Pessoa);
Object.assign(RoboTeste, {
    nome: "R2D2",
    tipo: 'robô',
    material: "metal",
    consumo_kWh: 5,
    carga_maxima_kWh: 10,
    carga_atual_kWh: 5,
    carregar: function(kWh) {
        var self = this;
        this.carga_atual_kWh = Math.min(self.carga_maxima_kWh, self.carga_atual_kWh + kWh);
        var percentCarga = this.carga_atual_kWh / this.carga_maxima_kWh * 100;
        var msgCarga = (percentCarga === 100) ? ' está completamente carregado.' : ' está ' + percentCarga +'% carregado.';
        console.log(self.nome + msgCarga);
    }
});

RoboTeste.nome = 'Bender';
RoboTeste.apresentar(); //Olá, meu nome é Bender e eu sou um robô.
RoboTeste.carregar(5); //Bender está completamente carregado.


//http://loopinfinito.com.br/2013/02/05/heranca-em-javascript-parte-2/
var animal = {
  respirar: function() { alert('respirar') },
  reproduzir: function() { alert('reproduzir') }
};

var cachorro = Object.create(animal, {
  latir: {
    value: function() { alert('latir') }
  }
});

cachorro.respirar(); // método herdado
cachorro.latir(); // método adicionado


// *********************************

var pessoa = { nome: 'Pedro', sobrenome: 'Machado' };
function showFullName() {
    console.log(this.nome + " " + this.sobrenome);
}
showFullName.call(pessoa); // Pedro Machado
showFullName.apply(pessoa); // Pedro Machado


var pessoa = { idade: 26 };
function maisJovemQue() {
    for (var i = 0; i < arguments.length; i++) {
        console.log(this.idade < arguments[i]);
    }
}
maisJovemQue.call(pessoa, 30, 40, 15); // true true false
maisJovemQue.apply(pessoa, [30, 40, 15]); // true true false

// *********************************

// Uso de callback
function tryMe (param1, param2) {
    alert (param1 + " and " + param2);
}

function callbackTester (callback, param1, param2) {
    callback (param1, param2);
}

callbackTester (tryMe, "hello", "goodbye");

// *********************************


/* número min/max em um array */
var numeros = [5, 6, 2, 3, 7];

/* utilizando Math.min/Math.max apply */
var max = Math.max.apply(null, numeros); //Igual a Math.max(numeros[0], ...) ou Math.max(5, 6, ...)
var min = Math.min.apply(null, numeros);



// ****************************************************

// Try e Catch, forEach de array que não é interrompido com return, então aqui como exemplo foi aplicado Try...

var BreakException = {};

try {
  [1, 2, 3].forEach(function(el) {
    console.log(el);
    if (el === 2) throw BreakException;
  });
} catch (e) {
  if (e !== BreakException) throw e;
}

// ----------------------------------------------------

var xhr = new XMLHttpRequest();
xhr.open("GET", urlJson, true);
xhr.onload = function (e) {
    if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            var res = xhr.responseText;

            // exemplo recebendo json...
            self.result = JSON.parse(res);
        } else {
            console.error(xhr.statusText);
        }
    }
};
xhr.onerror = function (e) {
    console.error(xhr.statusText);
};
xhr.send(null); 

// ----------------------------------------------------

var fibRef = 1;
var fibProx = 2;
for(var loop=0; loop < 15; loop++){
    console.log(fibRef);
    var fibProxOld = fibProx;
    fibProx += fibRef;
    fibRef = fibProxOld;
}


function fibonacci(loop){
    var fibRef = 1, fibProx = 2, temp;

    while(loop > 0){
        console.log(fibRef);
        var temp = fibProx;
        fibProx += fibRef;
        fibRef = temp;
        loop--;
    }
    //return 
}

// ----------------------------------------------------

// ARROW FUNCTION
var soma = (a, b) => a + b;
alert(soma(5,2)); // 7

var somaF = function(a, b){ return a + b };
alert(somaF(5,2)); // 7

// uso de arguments, parametro multiplo
(function () {console.log(arguments)})(1, 2);

// ----------------------------------------------------

// Closures
function makeAdder(x) {
  return function(y) {
    return x + y;
  };
}

var add5 = makeAdder(5);
var add10 = makeAdder(10);

print(add5(2));  // 7
print(add10(2)); // 12

// -----

function makeSizer(size) {
  return function() {
    document.body.style.fontSize = size + 'px';
  };
}

var size12 = makeSizer(12);
var size14 = makeSizer(14);
var size16 = makeSizer(16);

document.getElementById('size-12').onclick = size12;
document.getElementById('size-14').onclick = size14;

/*
<a href="#" id="size-12">12</a>
<a href="#" id="size-14">14</a>
*/


// -----

var makeCounter = function() {
  var privateCounter = 0;
  function changeBy(val) {
    privateCounter += val;
  }
  return {
    increment: function() {
      changeBy(1);
    },
    decrement: function() {
      changeBy(-1);
    },
    value: function() {
      return privateCounter;
    }
  }  
};

var Counter1 = makeCounter();
var Counter2 = makeCounter();
alert(Counter1.value()); /* Alerts 0 */
Counter1.increment();
Counter1.increment();
alert(Counter1.value()); /* Alerts 2 */
Counter1.decrement();
alert(Counter1.value()); /* Alerts 1 */
alert(Counter2.value()); /* Alerts 0 */

// ########################################################## JQUERY ########################################################

// Pegar o elemento javascript de um Jquery
var elJs = $('#nome_elemento').get(0);

// Sobe nos elementos html para a tr 
$('#id_exemplo').closest('tr');

// Desativar e Ativar o botão
if ($(this).val() == '') {
    $('.enableOnInput').prop('disabled', true);
} else {
    $('.enableOnInput').prop('disabled', false);
}


$('#id_form').serialize();

//buscas de elementos dentro de outro
var Form = $('#id_form');
Form.find('#campo_a').change(function(){
    alert('alterado');
});

//verificar se um checkbox esta marcado
var campoMarcado = (Form.find('#id_campo_checkbox').attr('checked') == undefined);

div.find('.class-test').each(function(){
    alert($(this).html());
});

// verificar quantidade de registros
if($( "#myDiv" ).length > 5){

}

// Observar o click de uma div, vai aplicar o gatilho a todos os campos internos
var elDivForm = $('#nome-div-form');
elDivForm.on('click',function(e){
  console.log(this); //vem a div, objeto original da busca
  console.log(e.target); // aqui consegue pegar o item individual que sofreu o evento
  // lembrando que esses dois objetos são javascrit, e para manipular com jquery vai usar: $(this), $(e.target)...
});


// ----------------------------------------------------

$(function(){
    var list = [
        {"titulo":"noticia 1","corpo":"corpo da noticia 1","data":"02\/07\/2014"},
        {"titulo":"noticia 2","corpo":"corpo da noticia 2","data":"02\/07\/2014"},
        {"titulo":"noticia 3","corpo":"corpo da noticia 3","data":"02\/07\/2014"},
        {"titulo":"noticia 4","corpo":"corpo da noticia 4","data":"02\/07\/2014"}
    ];

    $.each(list, function(i, item){
        $('.noticias').append("<li>"+ item.data +" - " +item.titulo + "</li>");
    });
});

jsonObj.members.viewers['key_name'] = 'valor...';

// ----------------------------------------------------

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
    }
});

// ----

// cancelar requisição ajax anterior
var gettopic;
$(".buttons").click(function(){
    if (gettopic){
        gettopic.abort();
    }
    gettopic=$.post("topic.php", {id: topicId}, function(result){
       // codes for handling returned result
    });
});

var xhr = $.ajax({
    type: "POST",
    url: "some.php",
    data: "name=John&location=Boston",
    success: function(msg){
        alert( "Data Saved: " + msg );
    }
});
xhr.abort();


// ----------------------------------------------------

$.getJSON(url_do_json, function(dados) {
    for(var i=0; i<dados.length; i++) {
        $(document.body).append('<div>' + dados[i].titulo + ', ' + dados[i].duracao + '</div>');
    }
});