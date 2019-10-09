/**

#fazer
elevador(andar atual, subindo, descendo, evento porta) + porta de elevador(aberta, fechada, abrindo, fechando, sensor de obstaculo)

*/

var timerRegressivoConsole = function(time){
    this.timeInit   = time;
    this.time       = time;
    this.loop       = null;

    this.start = () => this.loop = setInterval(this.contador, 1000);
    this.pause = () => clearInterval(this.loop);
    this.stop = () => {
        this.pause();
        this.time = this.timeInit;
    }
    this.contador = () => {
        console.log(this.time);
        if(this.time == 0)
            return this.stop();
        this.time--;
    }
};

var timerRegressivo = function(time, elInterface){
    this.timeInit   = time;
    this.time       = time;
    this.loop       = null;
    this.el         = (typeof elInterface == 'object') ? elInterface : null;

    this.start = () => this.loop = setInterval(this.contador, 1000);
    this.pause = () => clearInterval(this.loop);
    this.stop = () => {
        this.pause();
        this.time = this.timeInit;
    }
    this.contador = () => {
        console.log(this.time);
        if(this.el)
            this.el.html(this.time);
        if(this.time == 0)
            return this.stop();
        this.time--;
    }
};
var t = new timerRegressivo(10, $('.form-search'));
t.start();


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

var elevador = {
    andarMax: 10,
    andarMin: 1,
    andarAtual: 1,
    andarSelecionados: [],
    aberto: false,
    direcao: 'up',
    Chamar: function(andar){

    },
    Abrir: function(){

    },
    Fechar: function(){

    },
    AndarSelecionar: function(){

    },
    Subir: function(andar){

    },
    Descer: function(){

    }

}


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


// ------------------------------

var automatoShowImpar = {
    isImpar: null,
    qtd: 0,
    Start: function(number){
        this.qtd = 0;
        if(typeof number == 'undefined')
            number = 0;
        this.Run(number);
    },
    Run: function(number){
        this.qtd++;
        if(this.qtd > 1000)
            return;

        this.testIsImpar(number);
        if(this.isImpar)
            console.log(number);
            
        this.Run(number+1);
    },
    testIsImpar: function(number){
        if(this.isImpar != null && number != 0){
            this.isImpar = !this.isImpar;
            return;
        }
        this.isImpar = !(number % 2 == 0);
    }
};

automatoShowImpar.Start(2);

