var geocoder;
var map;
var marker;
var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var localAtual = '-29.6976989 -51.084393999999975';

function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
    var options = {
        zoom: 5,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
	
    map = new google.maps.Map(document.getElementById("mapa"), options);
	
    geocoder = new google.maps.Geocoder();
	
    marker = new google.maps.Marker({
        map: map,
        draggable: true
    });
	
    marker.setPosition(latlng);
    carregarPontos();
    
    directionsDisplay.setMap(map);
    directionsDisplay.setPanel(document.getElementById("directionsPanel"));
}

function carregarPontos() {
 
    $.getJSON('pontos.json', function(pontos) {
 
        $.each(pontos, function(index, ponto) {
            
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
                title: ponto.titulo,
                map: map
            });
            var info = new google.maps.InfoWindow({
                content: ponto.mensagem
            });
            google.maps.event.addListener(marker, 'click', function() {
                info.open(marker.get('map'), marker);
                var destino = ponto.Latitude + ' ' + ponto.Longitude;
                calcRoute(destino);
            });
 
        });
 
    });
 
}

function calcRoute(end) {
    var start = localAtual;
    
    var request = {
        origin:start, 
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };

    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var distancia;
            var rota = response.routes[0]; /* Primeira rota */
            var etapa = rota.legs[0]; /* única etapa dessa rota */

            distancia = etapa.distance.value / 1000;

            $('#testea').val(distancia.toString());
        } else {
            alert(status);
        }

        document.getElementById('direcao').style.display = 'inline';
    });
}

$(document).ready(function () {

    initialize();
	
    function carregarNoMapa(endereco) {
        geocoder.geocode({
            'address': endereco + ', Brasil', 
            'region': 'BR'
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
		
                    $('#txtEndereco').val(results[0].formatted_address);
                    $('#txtLatitude').val(latitude);
                    $('#txtLongitude').val(longitude);
		
                    var location = new google.maps.LatLng(latitude, longitude);
                    marker.setPosition(location);
                    map.setCenter(location);
                    map.setZoom(16);
                }
            }
        })
    }
	
    $("#btnEndereco").click(function() {
        if($(this).val() != "")
            carregarNoMapa($("#txtEndereco").val());
    })
	
    $("#txtEndereco").blur(function() {
        if($(this).val() != "")
            carregarNoMapa($(this).val());
    })
	
    google.maps.event.addListener(marker, 'drag', function () {
        geocoder.geocode({
            'latLng': marker.getPosition()
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {  
                    $('#txtEndereco').val(results[0].formatted_address);
                    $('#txtLatitude').val(marker.getPosition().lat());
                    $('#txtLongitude').val(marker.getPosition().lng());
                }
            }
        });
    });
	
    $("#txtEndereco").autocomplete({
        source: function (request, response) {
            geocoder.geocode({
                'address': request.term + ', Brasil', 
                'region': 'BR'
            }, function (results, status) {
                response($.map(results, function (item) {
                    return {
                        label: item.formatted_address,
                        value: item.formatted_address,
                        latitude: item.geometry.location.lat(),
                        longitude: item.geometry.location.lng()
                    }
                }));
            })
        },
        select: function (event, ui) {
            $("#txtLatitude").val(ui.item.latitude);
            $("#txtLongitude").val(ui.item.longitude);
            var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
            marker.setPosition(location);
            map.setCenter(location);
            map.setZoom(16);
        }
    });
	
    $("form").submit(function(event) {
        event.preventDefault();
        $("#btnEndereco").click();
    });

});