
//neste exemplo contorna uma situação simples de validação onde o usuário deve informar o resultado de uma conta
//está conta está em um campo, não em uma imagem: <div id='math_expression'>3 + 11 = ?</div>
document.getElementsByName('captcha')[0].value = eval($('#math_expression').html().replace(' = ?',''));
