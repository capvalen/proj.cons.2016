var express = require('express');
var app = express();

var mysql = require('mysql');
var clienteSql = mysql.createConnection({
	'user': 'root',
	'password': '*123456*',
	'host': 'localhost',
	'port' : 3306
});

clienteSql.query('use consultorioweb');

var server = require('http').Server(app);

var io = require('socket.io')(server);

io.sockets.on('connection', function (socket) {
	console.log('Hay una conexion');

	socket.on('actualizarEstadoAtencion',function (idReg, idTipoEstado) {
		clienteSql.query(`call actualizarEstadoAtencion(${idReg}, ${idTipoEstado})`);
	});
	socket.on('iniciaAtencionPacientes', function(pacienteActual, pacienteSiguiente, idNuevo) { 
		io.sockets.emit('siguientePaciente',pacienteActual, pacienteSiguiente); 
		clienteSql.query(`call updateQuienAtiende(${idNuevo}, '${pacienteActual}' )`, function (err, rs, field) {
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('returnListaAtendidos', dato[0].idAnterior, dato[0].antNombres, idNuevo, pacienteActual );
			
		});
	});

	socket.on('datosDeUsuario',function (iduser) {
		clienteSql.query(`call listarDatosUsuario(${iduser})`,function (err,rs,field){
		if (err) {console.log(err); return;}
		var resultado=JSON.stringify(rs[0]);
		var dato =JSON.parse(resultado);
		socket.emit('listadoDatosUsuario',dato);
		});
	});
	socket.on('listarConsolidadxCliente', function (idPac) {
		clienteSql.query(`call listarCompendioPaciente(${idPac})`, function (err, rs, field) {
		if (err) {console.log(err); return;}
		socket.emit('returnConsolidadxCliente',rs[0]); });
	});



});




server.listen(8080, function () {
	console.log('Servidor corriendo en localhost');
});