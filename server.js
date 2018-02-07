
var express = require('express');
var app = express();
var server = require('http').createServer( app);
var io = require('socket.io')(server);




/*var mysql = require('mysql');
var clienteSql = mysql.createConnection({
	'user': 'root',
	'password': '*123456*',
	'host': 'localhost',
	'port' : 3306
}); 

clienteSql.query('use consultorio');*/

io.sockets.on('connection',function (socket) {
	console.log('Un cliente se ha conectado');
	/*clienteSql.query('Select * from ocupacion', function (err, rs, field) {
		if (err) {console.log(err); return;}
		socket.emit('saludo',rs);
	});*/

	socket.on('listarProcedencia',function () {
		clienteSql.query('call listarProcedencia();', function (err, rs, field) {
		if (err) {console.log(err); return;}
		socket.emit('listadoProcedencia',rs); });
	});
	socket.on('listarOcupacion',function () {
		clienteSql.query('call listarOcupacion();', function (err, rs, field) {
		if (err) {console.log(err); return;}
		socket.emit('listadoOcupacion',rs); });
	});
	socket.on('listarEstadoCivil',function () {
		clienteSql.query('call listarEstadoCivil();', function (err, rs, field) {
		if (err) {console.log(err); return;}
		socket.emit('listadoEstadoCivil',rs); });
	});
	socket.on('listarGrado',function () {
		clienteSql.query('call listarGrado();', function (err, rs, field) {
		if (err) {console.log(err); return;}
		socket.emit('listadoGrado',rs); });
	});
	/*socket.on('grabarCliente',function(datos){
		var nuevo=datos[0];
		clienteSql.query(`INSERT INTO cliente(cliApellidoPaterno, cliApellidoMaterno, cliNombres, idDni, cliFechaNacimiento,idEstadoCivil,idOcupacion,cliDireccion,cliTelefono,cliCelular,idProcedencia,cliSexo)
			values('${nuevo.paterno}','${nuevo.materno}','${nuevo.nombre}',${nuevo.tipoDni},'${nuevo.fecha}',${nuevo.civil},${nuevo.ocupacion},'${nuevo.direccion}','${nuevo.telefono}','${nuevo.celular}',${nuevo.procedencia},'${nuevo.sexo}');`, function (err, rs, field) {
			if (err) {console.log(err);
				console.log(err); return;}
			console.log(rs.id);
			});
	});*/
	socket.on('grabarClienteProcedure',function(datos,usuario){
		var nuevo=datos[0];
		clienteSql.query('call insertarCliente(?,?,?,?,?,?,?,?,?,?,?,?,?)',[nuevo.paterno, nuevo.materno, nuevo.nombre, nuevo.fecha, nuevo.civil, nuevo.sexo, nuevo.ocupacion, nuevo.direccion, nuevo.telefono, nuevo.celular, nuevo.procedencia,usuario,nuevo.grado],
		function (err, rs, field) {
			if (err) {console.log(err); return;}
			var resultaro=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultaro);
			var idCliente=dato[0].id;
			clienteSql.query('call insertarDNI(?,?,?)',[idCliente, nuevo.tipoDni,nuevo.dni], function (err, rs, field) {
				if (err) {console.log(err); return;}
				socket.emit('retornoClienteCreado',idCliente,1);
			});
		});
	});
	socket.on('actualizarCliente',function(datos,usuario){
		var nuevo=datos[0];
		clienteSql.query('call actualizarCliente(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[nuevo.idCliente,nuevo.paterno, nuevo.materno, nuevo.nombre, nuevo.fecha, nuevo.civil, nuevo.sexo, nuevo.ocupacion, nuevo.direccion, nuevo.telefono, nuevo.celular, nuevo.procedencia,usuario,nuevo.grado],
		function (err, rs, field) {
			socket.emit('retornoClienteCreado',nuevo.idCliente,2);
		});
	});
	socket.on('validarDniExistente',function(dni){
		clienteSql.query(`call validarDniExistente('${dni}')`,function(err,rs,field){
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			if(resultado.length==2){socket.emit('existeCliente',false,'');} //el resultado devuelve []
			else{socket.emit('existeCliente',true,dato);} //cuando si existe el dni, el resultado devuelve mas de 2 cadenas
		});
	});
	socket.on('validarNombreExistente',function(texto){
		clienteSql.query(`call validarNombreExiste('${texto}')`,function(err,rs,field){
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			if(resultado.length==2){socket.emit('existeCliente',false,'');} //el resultado devuelve []
			else{socket.emit('existeCliente',true,dato);} //cuando si existe el dni, el resultado devuelve mas de 2 cadenas
		});
	});
	socket.on('listarClientePanel',function(idCliente){
		clienteSql.query(`call listarClientePanel('${idCliente}')`,function(err,rs,field){
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoClientePanel',dato[0]);
		});
		clienteSql.query(`call contarComentarios(${idCliente})`,function(err,rs,field){
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('contadoComentarios',dato[0]);
		});
	});
	socket.on('crearHistoria',function(idCliente,motivo,usuario) {
		clienteSql.query(`call insertarHistoriaClinica(${idCliente},'${motivo}',1)`,function(err,rs,field) {
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('idHistoriaCreada',dato[0]);
		});
	});
	socket.on('agregarCita',function(idCliente,fechaHora,usuario){
		clienteSql.query(`call insertarCita(${idCliente}, "${fechaHora}",${usuario})`,function(err,rs,field){
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('agregadoCita',fechaHora,dato[0]);
			clienteSql.query(`call listarRegistroUnico(${dato[0].id})`,function (err,rs,field) {
				if (err) {console.log(err); return;}
				var nresultado=JSON.stringify(rs[0]);
				var ndato =JSON.parse(nresultado);
				io.sockets.emit('agregarListaPendientes',ndato[0]);
			});
		});
	});
	socket.on('listarCitasHoy',function(dia){
		clienteSql.query(`call listarCitasPorFecha('${dia}');`,function(err,rs,field){
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoCitasCalendar',dato);
		});
	});
	socket.on('listarCitasXFecha',function(dia){
		clienteSql.query(`call listarCitasPorFecha('${dia}');`,function(err,rs,field){
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoCitasXFecha',dato);
		});
	});
	socket.on('listarRegistroCliente',function(idCliente){
		clienteSql.query(`call listarRegistroPorCliente(${idCliente});`,function(err,rs,field){
			if (err) {console.log(err); return;}
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
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoClientesEncontrados',dato);
		});
	});
	socket.on('buscarClientePorNumeroHistoria',function(campoBusqueda) {
		clienteSql.query(`call buscarPorNumeroHistoria('${campoBusqueda}')`,function(err,rs,field){
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoClientesEncontrados',dato);
		});
	})
	socket.on('buscarClientePorDni',function(campoBusqueda){
		clienteSql.query(`call buscarPorDni('${campoBusqueda}')`,function(err,rs,field){
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoClientesEncontrados',dato);
		});
	});
	socket.on('listarUltimosRegistrados',function(campoBusqueda){
		clienteSql.query(`call listarUltimosRegistrados()`,function(err,rs,field){
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('listadoUltimosRegistrados',dato);
		});
	});
	socket.on('insertarPago',function(idreg,cant,idusu,obs,idcli,tipoPago,turno){
		clienteSql.query(`call insertarPago(${idreg},${cant},${idusu},'${obs}',${idcli},${tipoPago},${turno})`,function(err,rs,field){
			if (err) {console.log(err); return;}
			socket.emit('insertadoPago',idreg,cant, obs);
			io.sockets.emit('IngresoExtra', cant, obs+' <span class="label label-warning">Nuevo!</span>');
		});
	});
	socket.on('updateFechaConsulta',function(idReg,fecha,usuario) {
		clienteSql.query(`call updateMoverFechaConsulta(${idReg},'${fecha}',${usuario})`,function(err,rs,field){
			if (err) {console.log(err); return;}
			socket.emit('actualizadoFechaConsulta',idReg,fecha);
			io.sockets.emit('actualizacionDeListaConsultas',idReg,fecha);
		});
	});
	socket.on('moverFechaConsulta',function(idReg,fecha,usuario) {
		clienteSql.query(`call updateMoverFechaConsulta(${idReg},'${fecha}',${usuario})`,function(err,rs,field){
			if (err) {console.log(err); return;}
			//socket.emit('actualizadoFechaConsulta',idReg,fecha);
		});
	});
	socket.on('agregarRevaluacion',function(idCliente,fechaHora,usuario){
		clienteSql.query(`call insertarRevaluacion(${idCliente}, "${fechaHora}",${usuario})`,function(err,rs,field){
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('agregadoRevaluacion',fechaHora,dato[0]);
			clienteSql.query(`call listarRegistroUnico(${dato[0].id})`,function (err,rs,field) {
				if (err) {console.log(err); return;}
				var nresultado=JSON.stringify(rs[0]);
				var ndato =JSON.parse(nresultado);
				io.sockets.emit('agregarListaPendientes',ndato[0]);
			});
		});
	});
	socket.on('agregarProcedimiento',function(idCliente,fechaHora, obs,usuario){
		clienteSql.query(`call insertarProcedimiento(${idCliente}, "${fechaHora}","${obs}",${usuario})`,function(err,rs,field){
			if (err) {console.log(err); return;}
			var resultado=JSON.stringify(rs[0]);
			var dato =JSON.parse(resultado);
			socket.emit('agregadoProcedimiento',fechaHora,dato[0]);
			clienteSql.query(`call listarRegistroUnico(${dato[0].id})`,function (err,rs,field) {
				if (err) {console.log(err); return;}
				var nresultado=JSON.stringify(rs[0]);
				var ndato =JSON.parse(nresultado);
				io.sockets.emit('agregarListaPendientes',ndato[0]);
			});
		});
	});
	socket.on('eliminarCita',function (idReg, nombr){
		clienteSql.query(`call eliminarCita(${idReg}, "${nombr}")`,function (err,rs,field) {
		if (err) {console.log(err); return;}
		socket.emit('eliminadoCita',idReg);
		});
	});
	socket.on('listarProcedimientos',function(){
		clienteSql.query('call listarProcedimientos()',function (err,rs,field) {
		if (err) {console.log(err); return;}
		var resultado=JSON.stringify(rs[0]);
		var dato =JSON.parse(resultado);
		socket.emit('listadoProcedimientos',dato);
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
	socket.on('insertarIngresoExtra',function (monto, Usuario, moti, turno) {
		console.log(`call insertarIngresoExtra(${monto}, ${Usuario}, '${moti}', ${turno})`)
		clienteSql.query(`call insertarIngresoExtra(${monto}, ${Usuario}, '${moti}', ${turno})`,function (err,rs,field){
			if (err) {console.log(err); return;}
			socket.emit('insertadoIngresoExtra');
			io.sockets.emit('IngresoExtra', monto, moti);
		});
	});
	socket.on('insertarEgresoExtra',function (monto, Usuario, moti, turno) {
		clienteSql.query(`call insertarEgresoExtra(${monto}, ${Usuario}, '${moti}', ${turno})`,function (err,rs,field){
			if (err) {console.log(err);return;}
			socket.emit('insertadoEgresoExtra');
			io.sockets.emit('EgresoExtra', monto, moti);
		});
	});
	socket.on('listarPagosXFecha',function (fecha) {
		clienteSql.query(`call listarPagosXFecha("${fecha}")`,function (err,rs,field){
		if (err) {console.log(err); return;}
		var resultado=JSON.stringify(rs[0]);
		var dato =JSON.parse(resultado);
		socket.emit('listadoPagosXFecha',dato);
		});
	});
	socket.on('listarCuadreDiurno',function (fecha) {
		clienteSql.query(`call listarCuadreDiurno("${fecha}")`,function (err,rs,field){
		if (err) {console.log(err); return;}
		var resultado=JSON.stringify(rs[0]);
		var dato =JSON.parse(resultado);
		socket.emit('listadoPagosXFecha',dato);
		});
	});
	socket.on('listarCuadreNocturno',function (fecha) {
		clienteSql.query(`call listarCuadreNocturno("${fecha}")`,function (err,rs,field){
		if (err) {console.log(err); return;}
		var resultado=JSON.stringify(rs[0]);
		var dato =JSON.parse(resultado);
		socket.emit('listadoPagosXFecha',dato);
		});
	});
	socket.on('listarTiempoControles',function (fecha) {
		clienteSql.query('SELECT * FROM consultorio.configuraciones;',function (err,rs,field){
		if (err) {console.log(err); return;}
		var resultado=JSON.stringify(rs[0]);
		var dato =JSON.parse(resultado);
		socket.emit('TiempoControles',dato.tiempoControles);		
		});
	});
	socket.on('confirmarContrasena',function(iduser, passant) {
		clienteSql.query(`call confirmarContrasena(?,?);`,[iduser, passant],function (err,rs,field){
		var resultado=JSON.stringify(rs[0]);		
		var dato =JSON.parse(resultado);
		if(dato.length==0){socket.emit('resultadoContraseña',false);} //el dato devuelve []
		else{socket.emit('resultadoContraseña',true);} //cuando existe el usuario, el dato devuelve mas de 1 objeto json
		});
	});
	socket.on('actualizarContraseña',function(iduser, passnuev) { 
		clienteSql.query(`call cambiarContraseña(?,?);`,[iduser, passnuev],function (err,rs,field){
		socket.emit('actualizadoContraseña');
		});
	});
	socket.on('iniciaAtencionPacientes', function(pacienteActual, pacienteSiguiente) {
		io.sockets.emit('siguientePaciente',pacienteActual, pacienteSiguiente);
	});
	socket.on('solicitarPaciente',function() {
		io.sockets.emit('solicitarPacienteDoc');
	});
	socket.on('solicitarNumeroVideo',function () {
		clienteSql.query(`call solicitarNumeroVideo();`,function (err,rs,field){
		if (err) {console.log(err); return;}
		var resultado=JSON.stringify(rs[0]);
		var dato =JSON.parse(resultado);
		socket.emit('solicitadoNumeroVideo',dato[0].numeroVideo);
		});
	});
	socket.on('actualizarnumVideo',function (numVideo) {
		clienteSql.query(`call actualizarnumVideo(${numVideo})`);
	});
	socket.on('actualizarEstadoAtencion',function (idReg, idTipoEstado) {
		clienteSql.query(`call actualizarEstadoAtencion(${idReg}, ${idTipoEstado})`);
	});
	socket.on('insertarComentario',function(idCli, fecha, titulo, relleno, iduser) {
		clienteSql.query(`call insertarComentario(?,?,?,?,?);`,[idCli, fecha,titulo, relleno, iduser]);
	});
	socket.on('listarComentariosParaCliente',function (idCliente) {
		clienteSql.query(`call listarComentariosParaCliente(${idCliente})`,function (err,rs,field){
		if (err) {console.log(err); return;}
		var resultado=JSON.stringify(rs[0]);
		var dato =JSON.parse(resultado);
		socket.emit('listadoComentariosParaCliente',dato);
		});
	});
	socket.on('eliminarComentarioDeCliente',function(idComent) {
		clienteSql.query(`call eliminarComentarioDeCliente(?);`,[idComent]);
	});









});

	
server.listen(8080,function () {
	console.log('Escuchando en http://localhost:8080');
});