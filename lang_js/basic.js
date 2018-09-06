
alert('test');


var respostaDeletar = confirm("Deseja deletar?");
if (respostaDeletar == true) {
} else {
}

var idade = prompt("Qual é a sua idade?", '18');
if(idade > 18) {
}

history.back();
history.go(-1);   


// criar array
var arrExemplo1 = [];
arrExemplo1.push("teste"); // ["teste"], index 0
console.log(arrExemplo1[0]); // mostra teste

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
