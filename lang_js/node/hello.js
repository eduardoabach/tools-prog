
var port = 1993;

var http = require('http');
http.createServer(function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/plain'});
  res.end('running!');
}).listen(port);

console.log('Server running at http://localhost:'+port+'/');

