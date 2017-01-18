function is_year(value) {
   return /^\d{4}$/.test(value) && value > 1799 && value < 2501;
}

function is_date_br(s) {
   var first_test = /^\d{2}\/\d{2}\/\d{4}$/.test(s);
   if (!first_test)
      return false;
   var bits = s.split('/');
//   var d = new Date(bits[2], bits[1] - 1, bits[0]);
   var d = new Date(Date.UTC(bits[2]+'', (bits[1] - 1)+'', bits[0]+'','24'));
   
   return d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]);
}

function is_date_us(s) {
   var first_test = /^\d{4}\-\d{2}\-\d{2}$/.test(s);
   if (first_test === false)
      return false;
   var bits = s.split('-');
//   var d = new Date(bits[0], bits[1] - 1, bits[2]);
   var d = new Date(Date.UTC(bits[0]+'', (bits[1] - 1)+'', bits[2]+'','24'));
   return d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[2]);
}

function date_to_br(date) {
   if (is_date_us(date)) {
      var dat = date.split('-');
      return dat[2] + '/' + dat[1] + '/' + dat[0];
   }
}

function date_to_us(date) {
   if (is_date_br(date)) {
      var dat = date.split('/');
      return dat[2] + '-' + dat[1] + '-' + dat[0];
   }
}


