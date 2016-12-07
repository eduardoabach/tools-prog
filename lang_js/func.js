
function url_view(tela, view){
   return location+'views/'+tela+'/'+view+'.php';
}

function mk_div(id){
   if(id != undefined){
      var objDiv = document.createElement('div');
      objDiv.className = '';
      objDiv.id = id;
      return objDiv;
   }
   return false;
}