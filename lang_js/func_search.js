
function web_open_new(url){
   window.open(url, '_blank');
}

function search_all(str) {
   web_open_new('https://www.google.com.br/search?q='+encodeURI(str));
   web_open_new('http://www.bing.com/search?q='+encodeURI(str));
}

function search_whois(str) {
   web_open_new('http://www.whois.com/whois/'+str); //best
   web_open_new('http://who.is/whois/'+str);
   web_open_new('https://www.whois.net/'+str);
}

function search_map(str) {
   web_open_new('https://www.google.com.br/maps/place/'+encodeURI(str));
   web_open_new('https://maps.here.com/search/'+encodeURI(str));
   web_open_new('http://cep.guiamais.com.br/busca/'+encodeURI(str)); // cep
}