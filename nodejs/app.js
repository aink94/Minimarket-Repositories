var 
	app     = require('http').createServer(handler),
	io      = require('socket.io')(app),
	fs      = require('fs'),
	port    = process.argv[3] || 9898,
	serialport = require('serialport'),
	SerialPort = serialport.SerialPort,
	portName   = process.argv[2],
	portConfig = {
		baudRate: 115200,
		parity  : "none",
		dataBits: 8,
		parser  : serialport.parsers.readline('\n')
	};

	sp = new SerialPort(portName, portConfig);


	function handler(req, res)
	{
		fs.readFile(__dirname+'/index.html', function(err, data)
		{
			if(err)
			{
				res.writeHead(500);
				return res.end("Error ");
			}
			res.writeHead(200);
			res.end(data);
		});
	}

	arduinoMessage = '';

	sendMessage = function(buffer, socket, context){
		arduinoMessage += buffer.toString();
		console.log(arduinoMessage);

		if(arduinoMessage.indexOf('#') >= 0){
			socket.emit('notif', {context: context, data:arduinoMessage});
			console.log(context);
			console.log("Send Data To Laravel :");
			console.log(arduinoMessage);
			arduinoMessage = "";
		}
	};

	//connect
	io.sockets.on('connection', function(socket){
		
		//--------------Scan Form Tambah Data -----------------
		socket.on('bayar', function(data){
			console.log(data);
			sp.write(data.menu, function(err){//kirim data ke arduino dari web
				console.log('pilih menu ---------> '+data.menu);
			});
			
			sp.on('data', function(data){//terima data 
				arduinoMessage += data.toString();
				//console.log(arduinoMessage);
				if(arduinoMessage.indexOf('#') >= 0){
					socket.volatile.emit('bayar', data);
					console.log("Data To Laravel ----------> "+arduinoMessage);
					arduinoMessage = "";
				}
			});
		});
		
	});


	
	sp.on('close', function(err) {
		console.log('Port closed!');
	});

	sp.on('error', function(err) {
		console.error('error', err);
	});

	sp.on('open', function() {
		console.log('Port opened!');
	});


	app.listen(port);//localhost:9898
	console.log('Running http://localhost:'+port+'/');
