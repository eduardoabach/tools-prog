
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

//-------------------

var semaf = {
    state: null,
    Init: function(){
        this.Transition('green');
    },
    SetState: function(state){
        this.state = state;
    },
    Transition: function(newState){
        this.SetState(newState);
        console.log(this.state);

        switch(this.state) {
            case 'green':
                this.isGreen();
            break;
            case 'yellow':
                this.isYellow();
            break;
            case 'red':
                this.isRed();
            break;
            default:
                console.log('Invalid State!');
            break;
        }
    },
    isGreen: function(){
        setTimeout(() => this.Transition('yellow'), 4000);
    },
    isYellow: function(){
        setTimeout(() => this.Transition('red'), 2000);
    },
    isRed: function(){
        setTimeout(() => this.Transition('green'), 8000);
    }
}
semaf.Init();



/*******************************************************/


var elElefante = {
    numero: 1,
    Cantar: function(){
        if(this.numero >= 10) 
            return false;

        setTimeout(() => {
            console.log(this.makeTxt());
            this.Cantar();
        },1000);
    },
    makeTxt: function(){ 
        return this.makeTxtNumero() + ' ' + this.makeTxtEncomodam() 
    },
    makeTxtNumero: function(){ 
        return this.numero+ ((this.numero == 1) ? ' elefante encomoda': ' elefantes encomodam') + ' muita gente!' 
    },
    makeTxtEncomodam: function(){ 
        return 'Mas '+(++this.numero)+' elefantes '+this.makeEncomodacao(this.numero)+' muito mais!' 
    },
    makeEncomodacao: function(num){
        var str = '';
        for(var i = 0; i < num; i++)
            str += 'encomodam ';
        return trim(str);
    }
};

elElefante.Cantar();
/*
1 elefante encomoda muita gente! Mas 2 elefantes encomodam encomodam muito mais!
2 elefantes encomodam muita gente! Mas 3 elefantes encomodam encomodam encomodam muito mais!
3 elefantes encomodam muita gente! Mas 4 elefantes encomodam encomodam encomodam encomodam muito mais!
4 elefantes encomodam muita gente! Mas 5 elefantes encomodam encomodam encomodam encomodam encomodam muito mais!
5 elefantes encomodam muita gente! Mas 6 elefantes encomodam encomodam encomodam encomodam encomodam encomodam muito mais!
6 elefantes encomodam muita gente! Mas 7 elefantes encomodam encomodam encomodam encomodam encomodam encomodam encomodam muito mais!
7 elefantes encomodam muita gente! Mas 8 elefantes encomodam encomodam encomodam encomodam encomodam encomodam encomodam encomodam muito mais!
8 elefantes encomodam muita gente! Mas 9 elefantes encomodam encomodam encomodam encomodam encomodam encomodam encomodam encomodam encomodam muito mais!
9 elefantes encomodam muita gente! Mas 10 elefantes encomodam encomodam encomodam encomodam encomodam encomodam encomodam encomodam encomodam encomodam muito mais!
*/

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




