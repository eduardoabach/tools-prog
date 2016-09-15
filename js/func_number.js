
function randomIntFromInterval(min,max){
    return Math.floor(Math.random()*(max-min+1)+min);
}

function mk_cpf(points){
   var min = 0;
   var max = 9;
   var n1 = randomIntFromInterval(min,max);
   var n2 = randomIntFromInterval(min,max);
   var n3 = randomIntFromInterval(min,max);
   var n4 = randomIntFromInterval(min,max);
   var n5 = randomIntFromInterval(min,max);
   var n6 = randomIntFromInterval(min,max);
   var n7 = randomIntFromInterval(min,max);
   var n8 = randomIntFromInterval(min,max);
   var n9 = randomIntFromInterval(min,max);
   var d1 = n9*2+n8*3+n7*4+n6*5+n5*6+n4*7+n3*8+n2*9+n1*10;
   d1 = 11 - ( mod(d1,11) );

   if (d1>=10) d1 = 0;

   var d2 = d1*2+n9*3+n8*4+n7*5+n6*6+n5*7+n4*8+n3*9+n2*10+n1*11;
   d2 = 11 - ( mod(d2,11) );

   if (d2>=10) d2 = 0;

   var cpf = '';
   if(points)
      cpf=''+n1+n2+n3+'.'+n4+n5+n6+'.'+n7+n8+n9+'-'+d1+d2;
   else
      cpf=''+n1+n2+n3+n4+n5+n6+n7+n8+n9+d1+d2;

   return cpf;
}

function mk_cnpj(points){
   var min = 0;
   var max = 9;
   var n1 = randomIntFromInterval(min,max);
   var n2 = randomIntFromInterval(min,max);
   var n3 = randomIntFromInterval(min,max);
   var n4 = randomIntFromInterval(min,max);
   var n5 = randomIntFromInterval(min,max);
   var n6 = randomIntFromInterval(min,max);
   var n7 = randomIntFromInterval(min,max);
   var n8 = randomIntFromInterval(min,max);
   var n9 = 0; //randomiza(n);
   var n10 = 0; //randomiza(n);
   var n11 = 0; //randomiza(n);
   var n12 = 1; //randomiza(n);

   var d1 = n12*2+n11*3+n10*4+n9*5+n8*6+n7*7+n6*8+n5*9+n4*2+n3*3+n2*4+n1*5;
   d1 = 11 - ( mod(d1,11) );
   if (d1>=10) d1 = 0;
   var d2 = d1*2+n12*3+n11*4+n10*5+n9*6+n8*7+n7*8+n6*9+n5*2+n4*3+n3*4+n2*5+n1*6;
   d2 = 11 - ( mod(d2,11) );
   if (d2>=10) d2 = 0;

   var cnpj = '';
   if(points)
      cnpj = ''+n1+n2+'.'+n3+n4+n5+'.'+n6+n7+n8+'/'+n9+n10+n11+n12+'-'+d1+d2;
   else
      cnpj = ''+n1+n2+n3+n4+n5+n6+n7+n8+n9+n10+n11+n12+d1+d2;

   return cnpj;
}

function mod(dividendo,divisor) {
   return Math.round(dividendo - (Math.floor(dividendo/divisor)*divisor));
}

function is_numeric(n) {
   return !isNaN(parseFloat(n)) && isFinite(n);
}

function is_int(value) {
   return /^\d+$/.test(value);
}

function is_number_br(value) {
   return /^(-)?([0-9]{1,3})(\.[0-9]{3})*(\,[0-9]{1,}){0,1}$/.test(value);
}

function number_to_us(valor) {
   if (valor !== '' && valor !== '0' && valor.length > 0) {
      return parseFloat(valor.replaceAll('.', '').replace(',', '.'));
   }
}

function number_to_br(valor, decimals) {
   if (is_numeric(valor)) {
      return number_format(valor, decimals || 2, ',', '.');
   }
}

function number_format(number, decimals, dec_point, thousands_sep) {
   number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
   var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function (n, prec) {
         var k = Math.pow(10, prec);
         return '' + Math.round(n * k) / k;
      };
   // Fix for IE parseFloat(0.55).toFixed(0) = 0;
   s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
   if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
   }
   if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
   }
   return s.join(dec);
}
