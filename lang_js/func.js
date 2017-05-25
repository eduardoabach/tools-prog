
setTimeout(function(){
    //o que deseja fazer...
}, 2000); // 2s


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

function scroll_to_element(id){
	 var elemento = document.getElementById(id);
	 $(elemento).scrollIntoView(2000);
}
