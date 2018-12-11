var socket = io.connect('http://localhost:8080', { 'forceNew': true });
//--------- Codigo para pedir datos
/*socket.on('saludo',function(data){
	var tamano = data.length;
	for (var i = 0; i <tamano; i++) {
		console.log(data[i].ocupDetalle);
	};
});*/
$("#btnNuevoCliente").click(function() {
	llenadoCmb();
	$('#cmbProcedencia').val('1').change();
	$('#cmbOcupacion').val('6').change();
	$('#cmbEstadoCivil').val('1').change();
	$('#cmbGrado').val('4').change();
});
function llenadoCmb() {
	if($('#cmbProcedencia>option').length==1){
		socket.emit('listarProcedencia');
	};
	if($('#cmbOcupacion>option').length==1){
		socket.emit('listarOcupacion');
	};
	if($('#cmbEstadoCivil>option').length==1){
		socket.emit('listarEstadoCivil');
	};
	if($('#cmbGrado>option').length==1){ 
		socket.emit('listarGrado');
	};
}

socket.on('listadoProcedencia',function (data) {
	data[0].map(function(item,index){
		//console.log(item.prodDetalle);
		$('#cmbProcedencia').append(`<option value=${item.idProcedencia}>${toTitleCase(item.prodDetalle)}</option>`);
		$('#cmbProcedencia').val('1').change();
	});
	/*var tamano = data.length;
	for (var i = 0; i <tamano; i++) {
		console.log(data[i].prodDetalle);
	};*/
});
socket.on('listadoOcupacion',function (data) {
	data[0].map(function(item,index){ //se Usa 0 porque el array contiene en 0 los datos y en 1 el status del servidor
		$('#cmbOcupacion').append(`<option value=${item.idOcupacion}>${toTitleCase(item.ocupDetalle)}</option>`);
		$('#cmbOcupacion').val('6').change();
	});
});
socket.on('listadoEstadoCivil',function (data) {
	data[0].map(function(item,index){ //se Usa 0 porque el array contiene en 0 los datos y en 1 el status del servidor
		$('#cmbEstadoCivil').append(`<option value=${item.idEstadoCivil}>${toTitleCase(item.estcivDescripcion)}</option>`);
		$('#cmbEstadoCivil').val('1').change();
	});
});
socket.on('listadoGrado',function (data) {
	data[0].map(function(item,index){ //se Usa 0 porque el array contiene en 0 los datos y en 1 el status del servidor
		$('#cmbGrado').append(`<option value=${item.idGradoEstudios}>${toTitleCase(item.gradDescripcion)}</option>`);
		$('#cmbGrado').val('4').change();
	});
});

function grabarCliente(tipo) {
	var vSexo='';
	if($('#chkSexo').bootstrapSwitch('state')){vSexo='M'}
	else{vSexo='F'}
	var datos=[{
		procedencia: $('#cmbProcedencia').val(),
		dni: $('#txtDni').val(),
		tipoDni: $('#cmbTipoPersona').val(),
		paterno: $('#txtApellidoPaterno').val(),
		materno: $('#txtApellidoMaterno').val(),
		nombre: $('#txtNombres').val(),
		fecha: $('#dtpFechaNacimiento').val(),
		civil: $('#cmbEstadoCivil').val(),
		sexo: vSexo,
		grado: $('#cmbGrado').val(),
		ocupacion: $('#cmbOcupacion').val(),
		direccion: $('#txtDireccion').val(),
		telefono: $('#txtTelefono').val(),
		celular: $('#txtCelular').val(),
	}];
	//console.log(datos);
	// console.log($('#dtpFechaNacimiento').val());
//	socket.emit('grabarCliente',datos);
if(tipo=='grabar'){socket.emit('grabarClienteProcedure',datos,idUsuario);}
else if(tipo=='actualizar'){datos[0].idCliente=datosGenerales.idCliente;
	console.log(datos);
	socket.emit('actualizarCliente',datos,idUsuario);}
	//
}

socket.on('retornoClienteCreado',function (id,tipo){
	//console.log('idCliente: '+id);
	location.href = `ClientePanel.php?id=${id}&n=${tipo}`;
	});

$('#txtDni').focusout(function(){
	if($(this).val().length==8){
	socket.emit('validarDniExistente',$('#txtDni').val());}
});
socket.on('existeDni',function(existe,dato){
	if (existe) {console.log('si existe'); console.log(dato[0]);
		$("#contenidoErrorCliente").html(`El Dni que intenta registrar es de: <strong>${dato[0].cliNombres}, ${dato[0].cliApellidoPaterno} ${dato[0].cliApellidoMaterno}</strong>
			<a class="btn btn-success" href="ClientePanel.php?id=${dato[0].idCliente}" role="button">Ver <span class="glyphicon glyphicon-user"></span></a>`);
		$('#mensajeErrorCliente').removeClass('sr-only');
		$( "#btnGuardarCliente" ).prop( "disabled", true );
	}
	else {$('#mensajeErrorCliente').addClass('sr-only');
		$( "#btnGuardarCliente" ).prop( "disabled", false );}
});
function solicitarDatosClientePanel(idCliente){
	socket.emit('listarClientePanel',idCliente);
	socket.emit('listarRegistroCliente',idCliente);
}

socket.on('listadoClientePanel',function(dato){
	$('#lblNombre').text(dato.nombres.toLowerCase());
	$('#lblOcupacion').text(dato.ocupDetalle.toLowerCase());	
	var cumple=moment(dato.cliFechaNacimiento, "YYYY-MM-DD");	
	cumple.locale('fr-ca');moment.locale('fr-ca');
	var hoy = moment().format('L');
	$('#lblEdad').text(moment(cumple).preciseDiff(hoy));
	$('#lblEstado').text(dato.estcivDescripcion.toLowerCase());
	if(dato.idHistoria ==''){$('#lblHistoria').text(`Aún no tiene número de Historia Clínica`);$('#imprHistoria').addClass('hidden');$('#crearHistoria').removeClass('hidden');}
	else{$('#lblHistoria').html(`N° de Historia Clínica: <strong><span id="lblIdHistoria">${dato.idHistoria}</span></strong>`);$('#imprHistoria').removeClass('hidden');$('#crearHistoria').addClass('hidden');
	$('#btnCrearCita').removeClass('disabled');
	$('#btnCrearRevaluacion').removeClass('disabled');
	$('#btnCrearProcedimiento').removeClass('disabled');}
	if (dato.cliDireccion ==''){$('#lblDireccion').text('No precisó'); dato.cliDireccion='-'}
	else{$('#lblDireccion').text(dato.cliDireccion.toLowerCase());}
	$('#lblTelefono').text(dato.cliTelefono);
	$('#lblCelular').text(dato.cliCelular);
	$('.page-header').find('span').text(dato.nombres.toLowerCase());
	datosGenerales=dato;	
	console.log(datosGenerales);
});
$("#crearHistoria").click(function(){
	
	if($('#lblHistoria').text()=='Aún no tiene número de Historia Clínica'){
		$('.modal-motivo').modal('show');
		//socket.emit('crearHistoria',parseInt($('#lblIdCliente').text()));
	}
});
$("#imprHistoria").click(function() {
	
	var idHi=datosGenerales.idHistoria;
	var nom=encodeURIComponent( datosGenerales.nombres);
	
	var proc=encodeURIComponent (datosGenerales.prodDetalle);
	var ocup=encodeURIComponent (datosGenerales.ocupDetalle);
	var est=encodeURIComponent (datosGenerales.estcivDescripcion);
	var sex=encodeURIComponent (datosGenerales.sexo);
	var cumple=moment(datosGenerales.cliFechaNacimiento, "YYYY-MM-DD");	
	cumple=cumple.year();
	//cumple.locale('fr-ca');moment.locale('fr-ca');
	var hoy = moment().year();
	
	
	var edad=encodeURIComponent (hoy -cumple + ' AÑOS');
	//console.log();
	var dire=encodeURIComponent (datosGenerales.cliDireccion);
	var regisfe=encodeURIComponent(datosGenerales.histclifechaCreacion);

	var naci=moment(datosGenerales.cliFechaNacimiento);
	var moti=encodeURIComponent(datosGenerales.motivo);
	naci.locale('es');
	naci=encodeURIComponent (naci.format('L'));	
	moment.locale('es');
	hoy=encodeURIComponent(moment().format('L'));
	moment.locale('en');
	hora=encodeURIComponent(moment().format('LT'));

	urlImpr='imprimirHistoria.php?nombres='+nom+'&idHistoria='+idHi+'&ocupacion='+ocup+'&estado='+est+'&sexo='+sex+'&edad='+edad+'&direccion='+dire+'&nacimiento='+naci+'&hoy='+hoy+'&hora='+hora+'&motivo='+moti+'&registro='+regisfe;
	console.log(urlImpr);
	//window.open(urlImpr,'_blank');
	loadPrintDocument(this,{
		url: urlImpr,
		attr: "href",
		message:"Tu documento está siendo creado"
	});
});

/*$("#imprHistoria").printPage({
		url: urlImpr,
		attr: "href",
		message:"Tu documento está siendo creado"
});*/	

socket.on('idHistoriaCreada',function(dato) {
	datosGenerales.idHistoria=dato.idHistoria;
	$('#lblHistoria').html(`N° de Historia Clínica: <strong><span id="lblIdHistoria">${dato.idHistoria}</span></strong>`);
	$('#crearHistoria').addClass('hidden');$('#imprHistoria').removeClass('hidden');
	$('#btnCrearCita').removeClass('disabled');
	$('#btnCrearRevaluacion').removeClass('disabled');
	$('#btnCrearProcedimiento').removeClass('disabled');
	$("#imprHistoria").click();
});
socket.on('agregadoCita',function(fechaHora,dato){	
	var cita= moment(fechaHora,'YYYY-MM-DD H:m');	
	cita.locale('es');
	cita=cita.format('LLLL');
	
	$('.modal-cita').modal('hide');
	$('#mnjCitaRegistrada').removeClass('sr-only')
	.find('#lblMnjCita').html(cita);
	
	$('#listRegistro').prepend(`<div class="panel panel-success">
						<div class="panel-heading " role="tab">
						  <h4 class="panel-title">
							<p role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg${dato.id}" aria-expanded="true" aria-controls="${dato.id}">
							  <strong>Consulta</strong> <span class="lblTiempoCita">${moment(fechaHora).fromNow()}</span></p>
						  </h4>
						</div>
						<div id="Reg${dato.id}" class="panel-collapse collapse in" role="tabpanel" >
						  <div class="panel-body">
						  	<p class="pagos"></p>
							<p class="pconsulta">Consulta creada para las <span class="phora">${moment(fechaHora,'YYYY-MM-DD H:m').format('h:m a')}</span> del día <span class="pdia">${moment(fechaHora).format('dddd[,] DD [de] MMMM [de] YYYY')}</span>.</p>
							<div class="form-group">
								<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimirConsulta${dato.id}" ><span class="glyphicon glyphicon-print"></span> Imprimir cita</button>
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${dato.id}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
								<button type="button" class="btn btn-info btnModificar" id="btnModificar${dato.id}"><span class="glyphicon glyphicon-export"></span> Mover fecha</button>								
							</div>
						  </div>
						</div>
				  </div>`);
});
socket.on('listadoCitas',function(dato){
	//console.log(moment().isAfter($("#dtpFechaCita").val(),'days'));
	//console.log(dato);
	$("#tblCitas tbody").remove();
	dato.map(function(item,index){
			$("#tblCitas").append(`<tr>
					<td class="hora hidden">${item.hora}</td>
					<td>${item.hora.replace('AM','a.m.').replace('PM','p.m.')}</td>
					<td class="id sr-only">${item.idcliente}</td>
					<td class="mayusculas">${item.nombres}</td>
					<td><button class="btn btn-danger btn-sm eliminarCita">Cancelar cita</button>
					<button class="btn btn-success btn-sm" id="btnImprimirCita"><span class="glyphicon glyphicon-print"></span></button></td>
				</tr>`);
		});
	if (moment().isAfter($("#dtpFechaCita").val(),'days')){		//true es anterior 
		$('#btnProgramarCita').prop( "disabled", true );
		$('.mensajeError').text('No se puede asignar citas con fecha anterior a hoy.');
		$('#btnActualizarProgramacionCita').prop( "disabled", true );
		$('#divErrorCita').removeClass('sr-only');

		
		}
	else{
		$('#btnProgramarCita').prop( "disabled", false );
		$('#btnActualizarProgramacionCita').prop( "disabled", false );
		$('#divErrorCita').addClass('sr-only');
		$('#divErrorCita').addClass('sr-only');
		$('#btnProgramarCita').prop( "disabled", false );
		verificarCitaClienteporDia();		
	}

	
});
socket.on('listadoRegistroCliente',function(dato){
	console.log(dato)
	dato.map(function(elemento,index){
		//var pagos='';
		moment.locale('es');
		//if(elemento.idPagos != null){pagos=`Pagó cancelado <strong>S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</strong> el ${moment(elemento.pagoFecha).format('dddd[,] DD [de] MMMM [de] YYYY')}.`}
		if (elemento.tiempo=='pasado') {
			$('#listRegistro').append(`<div class="panel panel-info">
						<div class="panel-heading " role="tab">
						  <h4 class="panel-title">
							<p role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg${elemento.idreg}" aria-expanded="true" aria-controls="Reg${elemento.idreg}">
							  <strong>${elemento.descripcion}</strong> <span class="lblTiempoCita">${moment(elemento.regCreado).fromNow()}</span>  <span class="moneda"></span></p>
						  </h4>
						</div>
						<div id="Reg${elemento.idreg}" class="panel-collapse collapse" role="tabpanel" >
						  <div class="panel-body">						  	
							<p>Consulta creada para las ${moment(elemento.regCreado).format('h:mm a')} del día ${moment(elemento.regCreado).format('dddd[,] DD [de] MMMM [de] YYYY')}. <em>${elemento.usuNombre}</em></p>
							<p class="pagos"></p>
							<div class="form-group">
								
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${elemento.idreg}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
							</div>
						  </div>
						</div>
				  </div>`);
			/*$('#listRegistro').append(`<a href="#!" class="list-group-item">
		<p class="list-group-item-text"><strong>${elemento.descripcion} </strong>${moment(elemento.regCreado).fromNow()} <span class="hidden">aa</span></p></a>`);*/
		}
		var botones='';
		if(elemento.descripcion=='Consulta'){botones=`<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimir${elemento.descripcion}${elemento.idreg}" ><span class="glyphicon glyphicon-print"></span> Imprimir cita</button>
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${elemento.idreg}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
								<button type="button" class="btn btn-info btnModificar" id="btnModificar${elemento.idreg}"><span class="glyphicon glyphicon-export"></span> Mover fecha</button>`}
		else{botones=`<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimir${elemento.descripcion}${elemento.idreg}" ><span class="glyphicon glyphicon-print"></span> Imprimir cita</button>
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${elemento.idreg}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
								<button type="button" class="btn btn-info btnModificar" id="btnModificar${elemento.idreg}"><span class="glyphicon glyphicon-export"></span> Mover fecha</button>
								<button type="button" class="btn btn-danger btnCancelarControl" id="btnCancelarControl${elemento.idreg}"><span class="glyphicon glyphicon-fire"></span> Cancelar control</button>`}
		if (elemento.tiempo=='futuro') {
			$('#listRegistro').append(`<div class="panel panel-info">
						<div class="panel-heading " role="tab">
						  <h4 class="panel-title">
							<p role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg${elemento.idreg}" aria-expanded="true" aria-controls="Reg${elemento.idreg}">
							  <strong>${elemento.descripcion} </strong>  <span  class="lblTiempoCita">${moment(elemento.regFecha).fromNow()}</span> <span class="moneda"></span></p>
						  </h4>
						</div>
						<div id="Reg${elemento.idreg}" class="panel-collapse collapse" role="tabpanel" >
						  <div class="panel-body">						  	
							<p  class="pconsulta">Consulta creada para las <span class="phora">${moment(elemento.regFecha).format('h:mm a')}</span> del día <span class="pdia">${moment(elemento.regFecha).format('dddd[,] DD [de] MMMM [de] YYYY')}</span>. <em>${elemento.usuNombre}</em></p>
							<p class="pagos"></p>
							<div class="form-group">
								${botones}
							</div>
						  </div>
						</div>
				  </div>`);
			
			/*$('#listRegistro').append(`<a href="#!" class="list-group-item">
		<p class="list-group-item-text"><strong>${elemento.descripcion} </strong>${moment(elemento.regFecha).fromNow()} <span class="hidden">aa</span></p></a>`);*/}
		
	});
});
socket.on('listadoClientesEncontrados',function(dato){
	//console.log(dato);
	$('.modal-resultadosBusqueda').modal('show').find('tbody').empty();
	$('.modal-resultadosBusqueda').find('strong').html(dato.length);
	if(dato.length==0){$('.modal-resultadosBusqueda').find('table').hide();}
	else{$('.modal-resultadosBusqueda').find('table').show();}
	dato.map(function(element,index) {
		var cumple=moment(element.cliFechaNacimiento, "YYYY-MM-DD");	
		cumple.locale('es');			
		
		//console.log(moment(cumple).preciseDiff(moment.().format('YYYY')));
		$('.modal-resultadosBusqueda').find('tbody').append(`<tr>
								<th scope="row">${index +1}</th>
								<td>${element.idHistoria}</td>
								<td>${element.nombres}</td>
								<td class="hidden id">${element.idCliente}</td>
								<td class="">${moment(cumple).toNow(true)}</td>
								<td><a class="btn btn-sm btn-success" href="ClientePanel.php?id=${element.idCliente}" role="button">Ver <span class="glyphicon glyphicon-user"></span></a></td>
							</tr>`);
	});
});
socket.on('insertadoPago',function(idreg,cant, obs){	
		if(obs!="") {obs= '<strong>Obs: </strong>'+obs;}
	$('#listRegistro').find(`#Reg${idreg} .pagos`).append(`<p>Pagó <strong>S/. ${parseFloat(cant).toFixed(2)}</strong> el ${moment().format('dddd[,] DD [de] MMMM [de] YYYY')}. ${obs}</p>`);
	$('.modal-adelanto').modal('hide');
	$(`#Reg${idreg}`).parent().find('.moneda').html(`<span class="label label-primary pull-right">S/.</span>`);
});
socket.on('pagosCliente',function(pagos) {
	console.log(pagos)
	$('#listRegistro').prepend(`<div class="panel panel-warning">
	<div class="panel-heading " role="tab">
		<h4 class="panel-title">
		<p role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg0" aria-expanded="true" aria-controls="Reg0">
			<strong>Otros Pagos Realizados</strong> <span class="moneda"></span></p>
		</h4>
	</div>
	<div id="Reg0" class="panel-collapse collapse" role="tabpanel" >
		<div class="panel-body">
		<p class="pagos"></p>
		</div>
	</div>
</div>`);
	$(`#Reg0`).parent().find('.moneda').html(`<span class="label label-primary pull-right">S/.</span>`);
	pagos.map(function(elemento,index){
		var obs;
		if(elemento.pagoObservacion!="") {obs= '<strong>Obs: </strong>'+elemento.pagoObservacion+'.';}
		else {obs='';}
		$(`#Reg${elemento.idRegistro}`).find('.pagos').append(`<p>Pagó <strong>S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</strong> el ${moment(elemento.pagoFecha).format('dddd[,] DD [de] MMMM [de] YYYY')}.
			 ${obs} <em>${elemento.usuNombre}</em></p>`);
		$(`#Reg${elemento.idRegistro}`).parent().find('.moneda').html(`<span class="label label-primary pull-right">S/.</span>`);
	});
});
socket.on('actualizadoFechaConsulta',function(idreg,fechaHora) {
	$('.modal-cita').modal('hide');

	var cita= moment(fechaHora,'YYYY-MM-DD H:m');
	cita.locale('es');
	
	$('#mnjCitaRegistrada').removeClass('sr-only').find('#lblMnjCita').html(cita.calendar());
	$(`#Reg${idreg}`).parent().removeClass('panel-info').addClass('panel-success')
	.find('.lblTiempoCita').html(`${cita.calendar()}`);
	$(`#Reg${idreg}`).find('.phora').text(moment(fechaHora,'YYYY-MM-DD H:m').format('h:m a'));
	$(`#Reg${idreg}`).find('.pdia').text(cita.format('dddd[,] DD [de] MMMM [de] YYYY'));
});
socket.on('listadoCitasCalendar',function (dato) {
	$('.tablaCalendario td').html('');
	$('#mnjClienteCitadoHoy').addClass('sr-only');
	datosCitasDelDia=dato;

	console.log(datosCitasDelDia);
	var row, col;clientePuedeCitaHoy=true;
	dato.map(function (elemento,index) {
		var horacio=moment(elemento.hora,'H:mm a')
		row=horacio.format('H');
		col=horacio.format('m');
		//console.log(row+':'+col)
		if(elemento.descripcion=='Consulta'){
			$(`.tablaCalendario td[data-row='${row}'][data-column='${col}']`).html(`<div class="btn-group contenido"><button type="button" class="btn btn-sm btn-negro btnIzq"><span class="glyphicon glyphicon-backward"></span></button><button type="button" class="btn btn-sm btn-primary btnPacienteCalendario" id='${elemento.idregistroMovimientos}'>Consulta</button><button type="button" class="btn btn-sm btn-negro btnDer"><span class="glyphicon glyphicon-forward"></span></button></div>`);
		}
		if(elemento.descripcion=='Revaluación'){
			$(`.tablaCalendario td[data-row='${row}'][data-column='${col}']`).html(`<div class="btn-group contenido"><button type="button" class="btn btn-sm btn-negro btnIzq"><span class="glyphicon glyphicon-backward"></span></button><button type="button" class="btn btn-sm btn-success btnPacienteCalendario">Revaluación</button><button type="button" class="btn btn-sm btn-negro btnDer"><span class="glyphicon glyphicon-forward"></span></button></div>`);
		}
		if(elemento.idCliente==datosGenerales.idCliente){
			$('#mnjClienteCitadoHoy').removeClass('sr-only').find('#lblMnjCita').html('El cliente ya tiene cita el día de hoy.');
			$(`.tablaCalendario td[data-row='${row}'][data-column='${col}']`).find('.btnPacienteCalendario').removeClass('btn-primary').addClass('btn-danger');
			clientePuedeCitaHoy=false;}
		else{clientePuedeCitaHoy=true;}
		
	});
	bloquearCeldasHoyxHora();
});

socket.on('agregadoRevaluacion',function(fechaHora,dato){	
	var cita= moment(fechaHora,'YYYY-MM-DD H:m');	
	cita.locale('es');
	cita=cita.format('LLLL');
	//console.log(dato);
	
	$('.modal-cita').modal('hide');
	$('#mnjCitaRegistrada').removeClass('sr-only')
	.find('#lblMnjCita').html(cita);
	
	$('#listRegistro').prepend(`<div class="panel panel-success">
						<div class="panel-heading " role="tab">
						  <h4 class="panel-title">
							<p role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg${dato.id}" aria-expanded="true" aria-controls="${dato.id}">
							  <strong>Revaluación</strong> <span class="lblTiempoCita">${moment(fechaHora).fromNow()}</span></p>
						  </h4>
						</div>
						<div id="Reg${dato.id}" class="panel-collapse collapse in" role="tabpanel" >
						  <div class="panel-body">
							<p class="pconsulta">Consulta creada para las <span class="phora">${moment(fechaHora,'YYYY-MM-DD H:m').format('h:m a')}</span> del día <span class="pdia">${moment(fechaHora).format('dddd[,] DD [de] MMMM [de] YYYY')}</span>.</p>
							<p class="pagos"></p>
							<div class="form-group">
								<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimir${dato.descripcion}${dato.id}" ><span class="glyphicon glyphicon-print"></span> Imprimir cita</button>
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${dato.id}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
								<button type="button" class="btn btn-info btnModificar" id="btnModificar${dato.id}"><span class="glyphicon glyphicon-export"></span> Mover fecha</button>
								<button type="button" class="btn btn-danger btnCancelarControl" id="btnCancelarControl${dato.id}"><span class="glyphicon glyphicon-fire"></span> Cancelar control</button>
							</div>
						  </div>
						</div>
				  </div>`);
});
socket.on('eliminadoCita',function(idReg){
	$('.modal-cancelarCita').modal('hide');
	$('#listRegistro').find(`#Reg${idReg}`).parent().remove();
});
socket.on('listadoUltimosRegistrados',function(dato) {
	// body...
	console.log(dato)
	moment.locale('es')
	$('.modal-ultimosRegistrados').modal('show').find('tbody').empty();
	if(dato.length==0){$('.modal-ultimosRegistrados').find('table').hide();}
	else{$('.modal-ultimosRegistrados').find('table').show();}
	dato.map(function(element,index) {
	
	$('.modal-ultimosRegistrados').find('tbody').append(`<tr>
							<th scope="row">${index +1}</th>
							<td>${element.idHistoria}</td>
							<td>${element.nombres}</td>
							<td class="hidden id">${element.idCliente}</td>
							<td class="">${moment(element.regFecha).toNow(true)}</td>
							<td><a class="btn btn-sm btn-success" href="ClientePanel.php?id=${element.idCliente}" role="button">Ver <span class="glyphicon glyphicon-user"></span></a></td>
						</tr>`);
	});
})