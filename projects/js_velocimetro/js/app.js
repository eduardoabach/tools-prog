var App = {
    search: {
        view: function() {
            var $id = $(this).data('id-event');
            //alert($id);
        },
        init: function() {
            //$('#main').html($('#search-menu').html()).find('.view-detals-event').click(App.search.view);
            $('#main').html($('#velocimetroTela').html());
        }
    },
    configuracao: {
        init: function() {
            $('#main').html($('#configuracaoTela').html());
            // $.ajax({
			// url: "api/index.html"
            // }).done(function( html ) {
			// $("#main").html(html);
            // });
        }
    },
    luztroca: {
        init: function() {
            $('#main').html($('#luzTrocaTela').html());
        }
    },
    about: {
        init: function() {
            $('#main').html($('#about-menu').html());
        }
    },
    init: function() {
        $('#btn-configuracaoTela').click(App.configuracao.init);
        $('#btn-luzTrocaTela').click(App.luztroca.init);
        $('#btn-about-menu').click(App.about.init);
        $('#btn-velocimetroTela').click(App.search.init).click();
    }
};

$(document).ready(function() {
	App.init();
	geoBuscar();
});

var output = document.getElementById("statusMsg");
var numeroVelocidade = document.getElementById("numeroVelocidade");
var unidadeVelocidade = document.getElementById("unidadeVelocidade");
var unidadeExib = 'km';
var marchaSport = {
	'ativo':1,
	'list':{
		'1':{'speed':0,'show':0},
		'2':{'speed':40,'show':1},
		'3':{'speed':60,'show':1},
		'4':{'speed':80,'show':1},
		'5':{'speed':0,'show':0},
		'6':{'speed':0,'show':0},
		'7':{'speed':0,'show':0}
		}
	}
var marchaEconomico = {
	'ativo':0,
	'list':{
		'1':{'speed':0,'show':0},
		'2':{'speed':0,'show':0},
		'3':{'speed':0,'show':0},
		'4':{'speed':0,'show':0},
		'5':{'speed':0,'show':0},
		'6':{'speed':0,'show':0},
		'7':{'speed':0,'show':0}
		}
	}
  
function geoBuscar() {
  
  if (!navigator.geolocation){
    output.innerHTML = "<p>Geolocalização não suportada</p>";
    return;
  }

  function success(position) {
    window.setInterval(function() {calcular(position);}, 3000);
  }

  function calcular(position){
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    var velocidadeMS = position.coords.speed;
    var velocidadeKmH = 0;
    var velocidadeMpH = 0;
	
    if(velocidadeMS > 0){
	velocidadeKmH = velocidadeMS*3.6;
	velocidadeMpH = velocidadeKmH/1.609;
    }

    var velocidadeAt = 0;
    var unidadeAt = '';
    if(unidadeExib == 'km'){
	velocidadeAt = velocidadeKmH;
	unidadeAt = 'km/h';
    } else if(unidadeExib == 'ms'){
	velocidadeAt = velocidadeMS;
	unidadeAt = 'm/s';
    } else if(unidadeExib == 'mh'){
	velocidadeAt = velocidadeMpH;
	unidadeAt = 'mp/h';
    }

    numeroVelocidade.innerHTML = velocidadeAt.toFixed(1);
    unidadeVelocidade.innerHTML = unidadeAt;

    var exibirShift = false;

    //marchaSport
    if(marchaSport.ativo == 1){
	$.each(marchaSport.list, function(i, item){
		speedAt = item.speed;
		showAt = item.show;
		if(showAt == 1 && exibirShift == false){
			speedMax = speedAt*1.06;
			speedMin = speedAt*0.94;
			if(velocidadeAt <= speedMax && velocidadeAt >= speedMin){
				exibirShift = true;
			}
		}
        });
    } else if(marchaEconomico.ativo == 1){
	$.each(marchaEconomico.list, function(i, item){
		speedAt = item.speed;
		showAt = item.show;
		if(showAt == 1 && exibirShift == false){
			speedMax = speedAt*1.06;
			speedMin = speedAt*0.94;
			if(velocidadeAt <= speedMax && velocidadeAt >= speedMin){
				exibirShift = true;
			}
		}
        });
    }

    if(exibirShift){
	$('#shiftLight').addClass('shiftLight_up');
    } else {
	$('#shiftLight').removeClass('shiftLight_up');
    }

  }
  
  function getImagemGoogle(latitude,longitude){
	var img = new Image();
	img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";
	//output.appendChild(img);
	return img;
  }

  function error() {
    output.innerHTML = "Não foi possível identificar sua localização.";
  };

  navigator.geolocation.getCurrentPosition(success, error);
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function setCheckedValue(radioObj, newValue) {
	if(!radioObj)
		return;
	var radioLength = radioObj.length;
	if(radioLength == undefined) {
		radioObj.checked = (radioObj.value == newValue.toString());
		return;
	}
	for(var i = 0; i < radioLength; i++) {
		radioObj[i].checked = false;
		if(radioObj[i].value == newValue.toString()) {
			radioObj[i].checked = true;
		}
	}
}
