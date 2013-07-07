var http = require("http");
var url	 = require('url');
var eventProxy =  require('eventproxy');
var handle = {};
handle['/'] = test;


function start(route, handle) {
	function onRequest(request, response) {
		var pathname = url.parse(request.url).pathname;
		route(handle, pathname, response);
	}
	http.createServer(onRequest).listen(8081);
}

function route(handle, pathname, response){
	console.log("route\n");
	if (typeof handle[pathname] === 'function') {
		handle[pathname](response);
	} else {
		console.log(pathname + 'is no fund');
	}
}

function test(response) {
	var ep = new eventProxy();
	
	ep.all('data1', 'data2', function(a, b){
		response.writeHead(200, {"Content-Type": "text/plain"});
		response.write(a);
		response.write(b);
		response.end();
	});


	http.get('http://127.0.0.1/nodejs/service.php?function=test', function(data){
		var buffers = [], size = 0;
		data.on('data', function(buffer) {
			buffers.push(buffer);
			size += buffer.length;
		});
		data.on('end', function(){
     		var buffer = new Buffer(size), pos = 0;
        	for(var i = 0, l = buffers.length; i < l; i++) {
           		buffers[i].copy(buffer, pos);
           		pos += buffers[i].length;
       		 }
			ep.emit('data1', buffer);
		});
	});
	http.get('http://127.0.0.1/nodejs/service.php?function=test2', function(data){
		var buffers = [], size = 0;
		data.on('data', function(buffer) {
			buffers.push(buffer);
			size += buffer.length;
		});
		data.on('end', function(){
     		var buffer = new Buffer(size), pos = 0;
        	for(var i = 0, l = buffers.length; i < l; i++) {
           		buffers[i].copy(buffer, pos);
           		pos += buffers[i].length;
       		 }
			ep.emit('data2', buffer);
		});
	});
}

function sleep(milliSeconds) {
   var startTime = new Date().getTime();
   while (new Date().getTime() < startTime + milliSeconds);
}

start(route, handle);
