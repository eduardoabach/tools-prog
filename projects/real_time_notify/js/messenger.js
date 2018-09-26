var Messenger = {
	evt: null,
	elList: null,
	urlReceive: null,
	urlSend: null,
	nick: null,
	sala: null,
	callbackSend: null,
	callbackReceive: null,
	Init: function(urlEventReceiv, urlEventSend, el){
		this.urlReceive = urlEventReceiv;
		this.urlSend = urlEventSend;
		this.elList = el;
	},
	SetSala: function(s){
		this.sala = s;
	},
	SetNick: function(n){
		this.nick = n;
	},
	Conect: function(){
		this.CreateServerEventObserv();
	},
	Disconect: function(){
		this.evt.close();
		this.evt = null;
	},
	CreateServerEventObserv: function(){
		var self = this;
		self.evt = new EventSource(self.urlReceive);

		self.evt.onopen = function() {
			console.log("Connection to server opened.");
		};
		self.evt.onmessage = function(e) {
			var obj = JSON.parse(JSON.parse(e.data));
			self.ReceiveMsg(obj);
		}
		self.evt.onerror = function() {
			console.log("EventSource failed.");
		};
	},
	ExistConection: function(){
		return (this.evt !== null);
	},
	SetCallbackReceive: function(callback){
		if(typeof callback == 'function')
			this.callbackReceive = callback;
	},
	ReceiveMsg: function(obj){
		var dataJs = new Date(obj.data+'Z'); // formato date-time do js precisa do 'Z' no fim para representar o layout

		this.elList.innerHTML +=  "<small>" + obj.nick + " - " + dataJs.toLocaleString('pt-br') + "</small><br>" + obj.msg + "<hr>";
		if(this.callbackReceive !== null)
			this.callbackReceive();
	},
	SetCallbackSend: function(callback){
		if(typeof callback == 'function')
			this.callbackSend = callback;
	},
	SendMsg: function(str){
		var self = this;
		var params = new FormData();
		params.append('sala', this.sala);
		params.append('nick', this.nick);
		params.append('msg', str);

		var xhr = new XMLHttpRequest();
		xhr.open("POST", this.urlSend, true);
		xhr.onload = function (e) {
		    if (xhr.readyState === 4) {
		        if (xhr.status === 200) {
		            var res = xhr.responseText;
		            console.log(JSON.parse(res));
		            if(self.callbackSend !== null)
		            	self.callbackSend();
		        } else {
		            console.error(xhr.statusText);
		        }
		    }
		};
		xhr.onerror = function (e) {
			alert('err');
		    console.error(xhr.statusText);
		};
		xhr.send(params);
	},
	GetLog: function(){
		if(this.ExistConection()){
			console.log(this.evt.withCredentials);
			console.log(this.evt.readyState);
			console.log(this.evt.url);
		}
	}
}