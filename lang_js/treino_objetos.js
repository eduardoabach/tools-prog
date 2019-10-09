
/*
#maquinas de estados finitos (FSM - do inglês Finite State Machine), treinar
https://pt.wikipedia.org/wiki/M%C3%A1quina_de_Mealy
https://pt.wikipedia.org/wiki/Hierarquia_de_Chomsky
https://pt.wikipedia.org/wiki/M%C3%A1quina_de_estados_finita


#CRM - Customer Relationship Management (pesquisar mais sobre isso)

semaforo / semaforos multiplos em um cruzamento complexo

elevador(andar atual, subindo, descendo, evento porta) + porta de elevador(aberta, fechada, abrindo, fechando, sensor de obstaculo)

---------------------

https://www.meteor.com/tutorials

//-------------------
*/

var isGreen = () => {
    console.log('verde');
    setTimeout(() => isYellow(), 4000)
};
var isYellow = () => {
    console.log('amarelo');
    setTimeout(() => isRed(), 2000)
};
var isRed = () => {
    console.log('vermelho'); 
    setTimeout(() => isGreen(), 8000)
};
isGreen();


/* ----------------------------------------------------------- */

var multiplicar = (acumulador, valorAtual) => acumulador * valorAtual;
var arrMultipl = (...num) => num.reduce(multiplicar);

console.log(multiplicar(4,8)); // 32
console.log(arrMultipl(5,5,5)); // 125

// -------------------------------


var objTank = {
    pv: 100,
    municao: 20,
    Init: function(){

    },
    Transicao: function(){
        
    },
    actAtacar: function(objAlvo){

    },
    actDefender: function(objAlvo){

    },
    actFugir: function(objAlvo){

    },
    actPatrulhar: function(){

    }
};

//-----------------------------------


var pessoaF = function(nome, options){
    this.nome = nome;
    this.idade = 0;
    this.recursos = [];
    this.habilidades = [];

    // if(typeof options != 'undefined')
    //     Object.assign(this, options);
    
    this.Busca = function(nomeCaracteristica, itemBusca){

    }
};




var pessoa = {
    nome: '',
    idade: 0,
    recursos: [],
    habilidades: [],
    Init: function(nome, options){
        this.nome = nome;
        if(typeof options != 'undefined')
            Object.assign(this, options);
    },
    Busca: function(nomeCaracteristica, itemBusca){

    }
};

var p1 = Object.create(pessoa);
p1.Init('Maria');

var p2 = Object.create(pessoa);
p2.Init('Carlos', {
    habilidades: ['Marceneiro', 'Eletricista', 'Carpinteiro']
});


var listSurvivor = [];
listSurvivor.push();




