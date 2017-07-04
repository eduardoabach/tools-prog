
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
