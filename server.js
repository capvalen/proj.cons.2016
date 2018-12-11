var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);


var mysql = require('mysql');
var clienteSql = mysql.createConnection({
	'user': 'root',
	'password': '*123456*',
	'host': 'localhost',
	'port' : 3306
});

clienteSql.query('use consultorio');

io.on('connection',function (socket) {
	console.log('Un cliente se ha conectado');
	/*clienteSql.query('Select * from ocupacion', function (err, rs, field) {
		if (err) {clienteSql.end(); return;}
		socket.emit('saludo',rs);
	});*/

	socket.on('listarProcedencia',function () {
		clienteSql.query('call listarProcedencia();', function (err, rs, field) {
		if (err) {clienteSql.end(); return;}
		socket.emit('listadoProcedencia',rs); });
	});
	socket.on('listarOcupacion',function () {
		clienteSql.query('call listarOcupacion();', function (err, rs, field) {
		if (err) {clienteSql.end(); return;}
		socket.emit('listadoOcupacion',rs); });
	});
	socket.on('listarEstadoCivil',function () {
		clienteSql.query('call listarEstadoCivil();', function (err, rs, field) {
		if (err) {clienteSql.end(); return;}
		socket.emit('listadoEstadoCivil',rs); });
	});
	socket.on('listarGrado',function () {
		clienteSql.query('call listarGrado();', function (err, rs, field) {
		if (err) {clienteSql.end(); return;}
		socket.emit('listadoGrado',rs); });
	});
	/*socket.on('grabarCliente',function(datos){
		var nuevo=datos[0];
		clienteSql.query(`INSERT INTO cliente(cliApellidoPaterno, cliApellidoMaterno, cliNombres, idDni, cliFechaNacimiento,idEstadoCivil,idOcupacion,cliDireccion,cliTelefono,cliCelular,idProcedencia,cliSexo)
			values('${nuevo.paterno}','${nuevo.materno}','${nuevo.nombre}',${nuevo.tipoDni},'${nuevo.fecha}',${nuevo.civil},${nuevo.ocupacion},'${nuevo.direccion}','${nuevo.telefono}','${nuevo.celular}',${nuevo.procedencia},'${nuevo.sexo}');`, function (err, rs, field) {
			if (err) {console.log(err);
				clienteSql.end(); return;}
			console.log(rs.id);
			});
	});*/
	socket.on('grabarClienteProcedure',function(datos,usuario){
		var nuevo=datos[0];
		clienteSql.query('call insertarCliente(?,?,?,?,?,?,?,?,?,?,?,?,?)',[nuevo.paterno, nuevo.materno, nuevo.nombre, nuevo.fecha, nuevo.civil, nuevo.sexo, nuevo.ocupacion, nuevo.direccion, nuevo.telefono, nuevo.celular, nuevo.procedencia,usuario,nuevo.grado],
		function (err, rs, field) {
			if (err) {console.log(err);clienteSql.end(); return;}
			var resultaro=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultaro);
			var idCliente=dato[0].id;
			clienteSql.query('call insertarDNI(?,?,?)',[idCliente, nuevo.tipoDni,nuevo.dni], function (err, rs, field) {
				if (err) {clienteSql.end(); return;}
				socket.emit('retornoClienteCreado',idCliente,1);
			});
		});
	});
	socket.on('actualizarCliente',function(datos,usuario){
		var nuevo=datos[0];
		console.log(nuevo.idCliente);
		clienteSql.query('call actualizarCliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[nuevo.idCliente,nuevo.paterno, nuevo.materno, nuevo.nombre, nuevo.fecha, nuevo.civil, nuevo.sexo, nuevo.ocupacion, nuevo.direccion, nuevo.telefono, nuevo.celular, nuevo.procedencia,usuario,nuevo.grado],
		function (err, rs, field) {
			socket.emit('retornoClienteCreado',nuevo.idCliente,2);
		});
	});
	socket.on('validarDniExistente',function(dni){
		clienteSql.query(`call validarDniExistente('${dni}')`,function(err,rs,field){
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			if(resultado.length==2){socket.emit('existeDni',false,'');} //el resultado devuelve []
			else{socket.emit('existeDni',true,dato);} //cuando si existe el dni, el resultado devuelve mas de 2 cadenas
		});
	});
	socket.on('listarClientePanel',function(idCliente){
		clienteSql.query(`call listarClientePanel('${idCliente}')`,function(err,rs,field){
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoClientePanel',dato[0]);
		});
	});
	socket.on('crearHistoria',function(idCliente,motivo,usuario) {
		clienteSql.query(`call insertarHistoriaClinica(${idCliente},'${motivo}',1)`,function(err,rs,field) {
			if (err) {clienteSql.end(); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('idHistoriaCreada',dato[0]);
		});
	});
	socket.on('agregarCita',function(idCliente,fechaHora,usuario){
		clienteSql.query(`call insertarCita(${idCliente}, "${fechaHora}",${usuario})`,function(err,rs,field){
			if (err) {clienteSql.end(); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('agregadoCita',fechaHora,dato[0]);
		});
	});
	socket.on('listarCitasHoy',function(dia){
		clienteSql.query(`call listarCitasPorFecha('${dia}');`,function(err,rs,field){
			if (err) {clienteSql.end(); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoCitas',dato);
			socket.emit('listadoCitasCalendar',dato);
		});
	});	
	socket.on('listarRegistroCliente',function(idCliente){
		clienteSql.query(`call listarRegistroPorCliente(${idCliente});`,function(err,rs,field){
			if (err) {clienteSql.end(); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoRegistroCliente',dato);
			clienteSql.query(`call listarPagosPorCliente (${idCliente})`,function(err,rs,field) {
				var resu=JSON.stringify(rs[0]);
				var pagos =JSON.parse(resu);
				socket.emit('pagosCliente',pagos);
			});
		});
	});
	socket.on('buscarClientePorApellido',function(campoBusqueda){
		clienteSql.query(`call buscarPorNombre('${campoBusqueda}')`,function(err,rs,field){
			if (err) {clienteSql.end(); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoClientesEncontrados',dato);
		});
	});
	socket.on('buscarClientePorDni',function(campoBusqueda){
		clienteSql.query(`call buscarPorDni('${campoBusqueda}')`,function(err,rs,field){
			if (err) {clienteSql.end(); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoClientesEncontrados',dato);
		});
	});
	socket.on('listarUltimosRegistrados',function(campoBusqueda){
		clienteSql.query(`call listarUltimosRegistrados()`,function(err,rs,field){
			if (err) {clienteSql.end(); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoUltimosRegistrados',dato);
		});
	});
	socket.on('insertarPago',function(idreg,cant,idusu,obs,idcli){
		clienteSql.query(`call insertarPago(${idreg},${cant},${idusu},"${obs}",${idcli})`,function(err,rs,field){
			if (err) {console.log(err);clienteSql.end(); return;}
			socket.emit('insertadoPago',idreg,cant, obs);
		});
	});
	socket.on('updateFechaConsulta',function(idReg,fecha,usuario) {
		clienteSql.query(`call updateMoverFechaConsulta(${idReg},'${fecha}',${usuario})`,function(err,rs,field){
			if (err) {clienteSql.end(); return;}
			socket.emit('actualizadoFechaConsulta',idReg,fecha);
		});
	});
	socket.on('agregarRevaluacion',function(idCliente,fechaHora,usuario){
		clienteSql.query(`call insertarRevaluacion(${idCliente}, "${fechaHora}",${usuario})`,function(err,rs,field){
			if (err) {clienteSql.end(); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('agregadoRevaluacion',fechaHora,dato[0]);
		});
	});
	socket.on('eliminarCita',function(idReg, nombr){
		clienteSql.query(`call eliminarCita(${idReg}, "${nombr}")`,function(err,rs,field) {
		if (err) {console.log(err);clienteSql.end(); return;}
		socket.emit('eliminadoCita',idReg);
		});
		
	});







});

	
server.listen(8080,function () {
	console.log('Escuchando en http://localhost:8080');
});