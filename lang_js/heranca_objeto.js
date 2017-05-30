
//http://loopinfinito.com.br/2013/02/05/heranca-em-javascript-parte-2/
var animal = {
  respirar: function() {
    alert('respirar');
  },
  reproduzir: function() {
    alert('reproduzir');
  }
}

var cachorro = Object.create(animal, {
  latir: {
    value: function() {
      alert('latir');
    }
  }
})

cachorro.respirar(); // método herdado
cachorro.latir(); // método adicionado