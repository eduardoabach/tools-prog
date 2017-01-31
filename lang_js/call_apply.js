
var pessoa = { nome: 'Pedro', sobrenome: 'Machado' };

function showFullName() {
    console.log(this.nome + " " + this.sobrenome);
}

showFullName.call(pessoa);
// Pedro Machado

showFullName.apply(pessoa);
// Pedro Machado

// *********************************

var pessoa = { idade: 26 };

function maisJovemQue() {
    for (var i = 0; i < arguments.length; i++) {
        console.log(this.idade < arguments[i]);
    }
}

maisJovemQue.call(pessoa, 30, 40, 15);
// true true false

maisJovemQue.apply(pessoa, [30, 40, 15]);
// true true false

// *********************************

/* número min/max em um array */
var numeros = [5, 6, 2, 3, 7];

/* utilizando Math.min/Math.max apply */
var max = Math.max.apply(null, numeros); //Igual a Math.max(numeros[0], ...) ou Math.max(5, 6, ...)
var min = Math.min.apply(null, numeros);
