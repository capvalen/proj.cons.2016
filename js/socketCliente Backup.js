var socket = io.connect('http://192.168.1.187:8080', { 'forceNew': true });
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
if(tipo=='grabar'){socket.emit('grabarClienteProcedure',datos,usuario.idUsuario);}
else if(tipo=='actualizar'){datos[0].idCliente=datosGenerales.idCliente;
	console.log(datos);
	socket.emit('actualizarCliente',datos,usuario.idUsuario);}
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
socket.on('existeCliente',function(existe,dato){
	if (existe) {//console.log('si existe'); console.log(dato[0]);
		$("#contenidoErrorCliente").html(`El cliente que intenta registrar ya existe: <strong>${dato[0].cliNombres}, ${dato[0].cliApellidoPaterno} ${dato[0].cliApellidoMaterno}</strong>
			<a class="btn btn-success" href="ClientePanel.php?id=${dato[0].idCliente}" role="button">Ver <span class="glyphicon glyphicon-user"></span></a>`);
		$('#mensajeErrorCliente').removeClass('sr-only');
		$( "#btnGuardarCliente" ).prop( "disabled", true );
	}
	else {$('#mensajeErrorCliente').addClass('sr-only');
		$( "#btnGuardarCliente" ).prop( "disabled", false );}
});
$('#txtNombres').focusout(function(){console.log($('#txtApellidoPaterno').val().toUpperCase()+ ' '+$('#txtApellidoMaterno').val().toUpperCase()+ ' '+$('#txtNombres').val().toUpperCase());
	if($(this).val().length>2){
	socket.emit('validarNombreExistente',$('#txtApellidoPaterno').val().toUpperCase()+ ' '+$('#txtApellidoMaterno').val().toUpperCase()+ ' '+$('#txtNombres').val().toUpperCase());}
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
	$('#datoClienteTitulo').text(dato.nombres.toLowerCase());
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
	var celul=encodeURIComponent (datosGenerales.cliCelular);
	cumple=cumple.year();
	//cumple.locale('fr-ca');moment.locale('fr-ca');
	var hoy = moment().year();
	
	
	var edad=encodeURIComponent (hoy -cumple + ' AÑOS');
	//console.log();
	var dire=encodeURIComponent (datosGenerales.cliDireccion);
	var regisfe=encodeURIComponent(datosGenerales.histclifechaCreacion);
	//console.log(regisfe);

	var naci=moment(datosGenerales.cliFechaNacimiento);
	var moti=encodeURIComponent(datosGenerales.motivo);
	var tippac=encodeURIComponent(datosGenerales.prodDetalle);
	var usunom=encodeURIComponent(usuario.nombre)
	naci.locale('es');
	naci=encodeURIComponent (naci.format('L'));	
	moment.locale('es');
	hoy=encodeURIComponent(moment().format('L'));
	moment.locale('en');
	hora=encodeURIComponent(moment().format('LT'));

	urlImpr='imprimirHistoria.php?nombres='+nom+'&idHistoria='+idHi+'&ocupacion='+ocup+'&estado='+est+'&sexo='+sex+'&edad='+edad+'&direccion='+dire+'&nacimiento='+naci+'&motivo='+moti+'&registro='+regisfe+'&tipopaciente='+tippac+'&usunom='+usunom+'&celular='+celul;
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
	//console.log(dato)
	datosGenerales.idHistoria=dato.idHistoria;
	datosGenerales.histclifechaCreacion=moment().format('YYYY-MM-DD H:mm')
	$('#lblHistoria').html(`N° de Historia Clínica: <strong><span id="lblIdHistoria">${dato.idHistoria}</span></strong>`);
	$('#crearHistoria').addClass('hidden');$('#imprHistoria').removeClass('hidden');
	$('#btnCrearCita').removeClass('disabled');
	$('#btnCrearRevaluacion').removeClass('disabled');
	$('#btnCrearProcedimiento').removeClass('disabled');
	$("#imprHistoria").click();
});
socket.on('agregadoCita',function(fechaHora,dato){	//console.log(dato)
	var cita= moment(fechaHora,'YYYY-MM-DD H:m');	
	cita.locale('es');
	cita=cita.format('LLLL');
	
	$('.modal-cita').modal('hide');
	$('#mnjCitaRegistrada').removeClass('sr-only')
	.find('#lblMnjCita').html(cita);
	
	$('#listRegistro').prepend(`<div class="panel panel-success">
						<div class="panel-heading " role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg${dato.id}" aria-expanded="true" aria-controls="${dato.id}" role="tab">
						  <h4 class="panel-title">
							<span >
							  <strong>Consulta</strong> <span class="lblTiempoCita">${moment(fechaHora).fromNow()}</span> <span class="moneda"></span></span>
						  </h4>
						</div>
						<div id="Reg${dato.id}" class="panel-collapse collapse in" role="tabpanel" >
						  <div class="panel-body">
						  	<p class="pagos"></p>
							<p class="pconsulta">Consulta creada para las <span class="phora">${moment(fechaHora,'YYYY-MM-DD H:mm').format('h:mm a')}</span> del día <span class="pdia">${moment(fechaHora).format('dddd[,] DD [de] MMMM [de] YYYY')}</span>.</p>
							<div class="form-group">
								<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimirConsulta${dato.id}" ><span class="glyphicon glyphicon-print"></span> Imprimir voucher</button>
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${dato.id}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
								<button type="button" class="btn btn-info btnModificar" id="btnModificar${dato.id}"><span class="glyphicon glyphicon-export"></span> Mover fecha</button>
								<button type="button" class="btn btn-danger btnCancelarControl" id="btnCancelarControl${dato.id}"><span class="glyphicon glyphicon-fire"></span> Quemar consulta</button>
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
					<td class="mayuscula">${item.nombres}</td>
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
	//console.log(dato)
	listaRegistrosCliente=dato;
	console.log(listaRegistrosCliente)
	dato.map(function(elemento,index){		
		moment.locale('es');
		//if(elemento.idPagos != null){pagos=`Pagó cancelado <strong>S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</strong> el ${moment(elemento.pagoFecha).format('dddd[,] DD [de] MMMM [de] YYYY')}.`}
		if (elemento.tiempo=='pasado') {
			$('#listRegistro').append(`<div class="panel panel-info panel-sombreado">
						<div class="panel-heading collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg${elemento.idreg}" aria-expanded="true" aria-controls="Reg${elemento.idreg}" role="tab">
						  <h4 class="panel-title">
							<span >
							  <strong class="mayusculas">${elemento.descripcion}</strong> <span class="lblTiempoCita">${moment(elemento.regFecha).fromNow()}</span>  <span class="moneda"></span></span>
						  </h4>
						</div>
						<div id="Reg${elemento.idreg}" class="panel-collapse collapse" role="tabpanel" >
						  <div class="panel-body">						  	
							<p class="pconsulta">Consulta creada para las <span class="phora">${moment(elemento.regFecha).format('h:mm a')}</span> del día <span class="pdia">${moment(elemento.regFecha).format('dddd[,] DD [de] MMMM [de] YYYY')}</span>. <em>${elemento.usuNombre}</em></p>
							<p class="pagos"></p>
							<div class="form-group">
								<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimir${elemento.descripcion}${elemento.idreg}" ><span class="glyphicon glyphicon-print"></span> Imprimir voucher</button>
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${elemento.idreg}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
							</div>
						  </div>
						</div>
				  </div>`);
			/*$('#listRegistro').append(`<a href="#!" class="list-group-item">
		<p class="list-group-item-text"><strong>${elemento.descripcion} </strong>${moment(elemento.regCreado).fromNow()} <span class="hidden">aa</span></p></a>`);*/
		}
		var botones='';
		if(elemento.descripcion=='Consulta'){botones=`<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimir${elemento.descripcion}${elemento.idreg}" ><span class="glyphicon glyphicon-print"></span> Imprimir voucher</button>
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${elemento.idreg}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
								<button type="button" class="btn btn-info btnModificar" id="btnModificar${elemento.idreg}"><span class="glyphicon glyphicon-export"></span> Mover fecha</button>
								<button type="button" class="btn btn-danger btnCancelarControl" id="btnCancelarControl${elemento.idreg}"><span class="glyphicon glyphicon-fire"></span> Quemar consulta</button>`;}
		else{botones=`<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimir${elemento.descripcion}${elemento.idreg}" ><span class="glyphicon glyphicon-print"></span> Imprimir voucher</button>
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${elemento.idreg}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
								<button type="button" class="btn btn-info btnModificar" id="btnModificar${elemento.idreg}"><span class="glyphicon glyphicon-export"></span> Mover fecha</button>
								<button type="button" class="btn btn-danger btnCancelarControl" id="btnCancelarControl${elemento.idreg}"><span class="glyphicon glyphicon-fire"></span> Remover</button>`;}
		if (elemento.tiempo=='futuro') {
			$('#listRegistro').append(`<div class="panel panel-info panel-sombreado">
						<div class="panel-heading " role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg${elemento.idreg}" aria-expanded="true" aria-controls="Reg${elemento.idreg}" role="tab">
						  <h4 class="panel-title">
							<span >
							  <strong>${elemento.descripcion}</strong> ${elemento.regDescripcion} <span  class="lblTiempoCita">${moment(elemento.regFecha).fromNow()}</span> <span class="moneda"></span></span>
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
socket.on('insertadoPago',function(idreg,cant, obs){	//console.log(idreg,cant, obs)
		if(obs!="") {obs= '<strong>Obs: </strong>'+obs;}
	//$('#listRegistro').find(`#Reg${idreg}.pagos`).append(`<p>Pagó <strong>S/. ${parseFloat(cant).toFixed(2)}</strong> el ${moment().format('dddd[,] DD [de] MMMM [de] YYYY')}. <span class="capital">${obs}</span></p>`);
	$('.modal-adelanto').modal('hide');
	$(`#Reg${idreg}`).find('.pagos').append(`<p>Pagó <strong>S/. ${parseFloat(cant).toFixed(2)}</strong> el ${moment().format('dddd[,] DD [de] MMMM [de] YYYY')}. <span class="capital">${obs}</span>. <em>${usuario.nombre}</em></p>`);
//	console.log($(`#Reg${idreg}`).parent().html())
	$(`#Reg${idreg}`).parent().find('.moneda').html(`<span class="label label-primary pull-right">S/.</span>`);
	if(idreg==0){$('#panelPago').removeClass('sr-only');}
});
socket.on('pagosCliente',function(pagos) {
	console.log(pagos)
	$('#listRegistro').prepend(`<div class="panel panel-warning sr-only" id="panelPago">
	<div class="panel-heading " role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg0" aria-expanded="true" aria-controls="Reg0"  role="tab">
		<h4 class="panel-title">
		<span >
			<strong>Otros Pagos Realizados</strong> <span class="moneda"></span></span>
		</h4>
	</div>
	<div id="Reg0" class="panel-collapse collapse" role="tabpanel" >
		<div class="panel-body">
		<p class="pagos"></p>
		</div>
	</div>
</div>`);
	$(`#Reg0`).parent().find('.moneda').html(`<span class="label label-primary pull-right">S/.</span>`);

	pagos.map(function(elemento,index){ var pagoDescripcion;
		switch(elemento.idtipopago){
			case 1: pagoDescripcion='Adelantó' ; break;
			case 2: pagoDescripcion='Canceló'; break;
		}
		if(elemento.idRegistro==0){$('#panelPago').removeClass('sr-only');}
		var obs;
		if(elemento.pagoObservacion!="") {obs= '<strong>Obs: </strong> <span class="capital">'+elemento.pagoObservacion+'</span>.';}
		else {obs='';}
		$(`#Reg${elemento.idRegistro}`).find('.pagos').append(`<p><strong>${pagoDescripcion} S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</strong> el ${moment(elemento.pagoFecha).format('dddd[,] DD [de] MMMM [de] YYYY')}.
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
	$(`#Reg${idreg}`).find('.phora').text(moment(fechaHora,'YYYY-MM-DD H:mm').format('h:mm a'));
	$(`#Reg${idreg}`).find('.pdia').text(cita.format('dddd[,] DD [de] MMMM [de] YYYY'));
});
socket.on('listadoCitasCalendar',function (dato) {
	$('.tablaCalendario td').html('');
	$('#mnjClienteCitadoHoy').addClass('sr-only');
	datosCitasDelDia=dato;
	console.log(datosCitasDelDia);

	//console.log(datosCitasDelDia);
	var row, col;clientePuedeCitaHoy=false;
	var estado = dato.map(function (elemento,index) {
		var horacio=moment(elemento.hora,'H:mm a')
		row=horacio.format('H');
		col=horacio.format('m');
		//console.log(row+':'+col)
		if(elemento.descripcion=='Consulta'){
			$(`.tablaCalendario td[data-row='${row}'][data-column='${col}']`).html(`<div class="btn-group contenido">
				<!--// <button type="button" class="btn btn-sm btn-negro btnIzq hidden"><span class="glyphicon glyphicon-backward"></span>-->	
				</button><button type="button" class="btn btn-sm btn-primary btnPacienteCalendario" id='${index}'>Consulta</button><button type="button" class="btn btn-sm btn-negro btnDer"><span class="glyphicon glyphicon-forward"></span></button></div>`);
		}
		if(elemento.descripcion=='Revaluación'){
			$(`.tablaCalendario td[data-row='${row}'][data-column='${col}']`).html(`<div class="btn-group contenido">
				<!--// <button type="button" class="btn btn-sm btn-negro btnIzq hidden"><span class="glyphicon glyphicon-backward"></span>-->	
				</button><button type="button" class="btn btn-sm btn-success btnPacienteCalendario" id='${index}'>Control</button><button type="button" class="btn btn-sm btn-negro btnDer"><span class="glyphicon glyphicon-forward"></span></button></div>`);
		}
		if(elemento.descripcion=='Procedimiento'){
			$(`.tablaCalendario td[data-row='${row}'][data-column='${col}']`).html(`<div class="btn-group contenido">
				<!--// <button type="button" class="btn btn-sm btn-negro btnIzq hidden"><span class="glyphicon glyphicon-backward"></span>-->	
				</button><button type="button" class="btn btn-sm btn-warning btnPacienteCalendario" id='${index}'>Procedimiento</button><button type="button" class="btn btn-sm btn-negro btnDer"><span class="glyphicon glyphicon-forward"></span></button></div>`);
		}
		if(elemento.idCliente==datosGenerales.idCliente){
			$('#mnjClienteCitadoHoy').removeClass('sr-only').find('#lblMnjCita').html('El cliente ya tiene cita el día de hoy.');
			$(`.tablaCalendario td[data-row='${row}'][data-column='${col}']`).find('.btnPacienteCalendario').removeClass('btn-primary').addClass('btn-danger');
		}
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
							<span role="button" data-toggle="collapse" data-parent="#accordion" href="#Reg${dato.id}" aria-expanded="true" aria-controls="${dato.id}">
							  <strong>Revaluación</strong> <span class="lblTiempoCita">${moment(fechaHora).fromNow()}</span>  <span class="moneda"></span></span>
						  </h4>
						</div>
						<div id="Reg${dato.id}" class="panel-collapse collapse in" role="tabpanel" >
						  <div class="panel-body">
							<p class="pconsulta">Consulta creada para las <span class="phora">${moment(fechaHora,'YYYY-MM-DD H:mm').format('h:mm a')}</span> del día <span class="pdia">${moment(fechaHora).format('dddd[,] DD [de] MMMM [de] YYYY')}</span>.</p>
							<p class="pagos"></p>
							<div class="form-group">
								<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimirRevaluación${dato.id}" ><span class="glyphicon glyphicon-print"></span> Imprimir voucher</button>
								<button type="button" class="btn btn-amarillo btnPagar" id="btnPagar${dato.id}" ><span class="glyphicon glyphicon-piggy-bank"></span> Pagar</button>
								<button type="button" class="btn btn-info btnModificar" id="btnModificar${dato.id}"><span class="glyphicon glyphicon-export"></span> Mover fecha</button>
								<button type="button" class="btn btn-danger btnCancelarControl" id="btnCancelarControl${dato.id}"><span class="glyphicon glyphicon-fire"></span> Cancelar control</button>
							</div>
						  </div>
						</div>
				  </div>`);
});
socket.on('agregadoProcedimiento',function(fechaHora,dato){	
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
							  <strong>Procedimiento</strong> <span class="lblTiempoCita">${moment(fechaHora).fromNow()}</span> <span class="moneda"></span></p>
						  </h4>
						</div>
						<div id="Reg${dato.id}" class="panel-collapse collapse in" role="tabpanel" >
						  <div class="panel-body">
							<p class="pconsulta">Procedimiento creado para las <span class="phora">${moment(fechaHora,'YYYY-MM-DD H:mm').format('h:mm a')}</span> del día <span class="pdia">${moment(fechaHora).format('dddd[,] DD [de] MMMM [de] YYYY')}</span>.</p>
							<p class="pagos"></p>
							<div class="form-group">
								<button type="button" class="btn btn-success btnImprimirConsulta" id="btnImprimirProcedimiento${dato.id}" ><span class="glyphicon glyphicon-print"></span> Imprimir voucher</button>
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
});
socket.on('listadoProcedimientos', function(dato) {
	dato.map(function(elemento,index) {
		$('#cmbTipoProcedimiento').append(`<option value=${elemento.idtiempos}>${toTitleCase(elemento.tiempConsulta)}</option>`);
	});
});
socket.on('listadoDatosUsuario',function(dato){
	//console.log(usuario)
	/*usuario.push({idUsuario:dato[0].idUsuario});
	usuario.push({nombre:dato[0].usuNombre});*/
	usuario.idUsuario=dato[0].idUsuario;	
	usuario.nombre=dato[0].usuNombre;
	usuario.apellidos=dato[0].usuApellidos;
	usuario.nombreCompleto= dato[0].usuNombre+', '+dato[0].usuApellidos;
	usuario.tipo=dato[0].idTipo;
});
socket.on('insertadoIngresoExtra',function(){
	$('.modal-ingreso').modal('hide');
});
socket.on('insertadoEgresoExtra',function(){
	$('.modal-ingreso').modal('hide');
});
var pagosRealizados;
socket.on('listadoPagosXFecha',function (data) {
	
	pagosRealizados=data;
	console.log(pagosRealizados);
	plasmarPagos(false);
	
});
function plasmarPagos(permitirAdelantos){
	resetearCambioDiaCaja();
	limpiarTodoPagos();
	var monto =0, sumaParcialConsulta=0, sumaParcialProcedimientos=0, sumaParcialOtros=0, tipoProc='', sumaParcialEgresos=0, sumaTotal=0, cantidad=0;
	var adelanto='', cantAdelanto =0, cantNoAdelanto=0;
	pagosRealizados.map(function(elemento,index){
		//console.log(elemento.idtipopago)
		if(elemento.idtipopago==1){adelanto='EsAdelanto';cantAdelanto++}
		else{adelanto='NoEsAdelanto';cantNoAdelanto++}
		if (permitirAdelantos && adelanto=='EsAdelanto' ){//agregar todos los adelantos
			console.log(elemento.nombres + ' ' + elemento.pagoObservacion)
			switch(elemento.Tipo){
			case 'CONSULTA':
				$(`#${elemento.prodDetalle}`).find('.panelCuadre ul').append(`<li class="list-group-item"><div class='col-xs-7 col-sm-9 mayuscula ${adelanto}'>${elemento.nombres.toLowerCase()} <em class="text-muted">Adelanto ${elemento.pagoObservacion}</em></div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
				$(`#${elemento.prodDetalle}`).parent().removeClass('sr-only');
				cantidad=$(`#${elemento.prodDetalle}`).parent().find('#cantidad').text();
				$(`#${elemento.prodDetalle}`).parent().find('#cantidad').text(parseInt(cantidad)+1);
				monto=parseFloat($(`#${elemento.prodDetalle}`).parent().find('.montoSumado').text())+elemento.pagoMonto;
				$(`#${elemento.prodDetalle}`).parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));			
				sumaParcialConsulta+=elemento.pagoMonto; break;
			case 'PROCEDIMIENTO':
				tipoProc=elemento.regDescripcion.substring(0, elemento.regDescripcion.search(' ')).toUpperCase();
				$(`#${tipoProc}`).find('.panelCuadre ul').append(`<li class="list-group-item"><div class='col-xs-7 col-sm-9 mayuscula ${adelanto}'>${elemento.nombres.toLowerCase()} <em class="text-muted">Adelanto ${elemento.pagoObservacion}</em></div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
				$(`#${tipoProc}`).parent().removeClass('sr-only');
				cantidad=$(`#${elemento.prodDetalle}`).parent().find('#cantidad').text();
				$(`#${elemento.prodDetalle}`).parent().find('#cantidad').text(parseInt(cantidad)+1);
				monto=parseFloat($(`#${tipoProc}`).parent().find('.montoSumado').text())+elemento.pagoMonto;
				$(`#${tipoProc}`).parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));			
				sumaParcialProcedimientos+=elemento.pagoMonto;break;
			case 'OTROS':
				if(elemento.nombres == null){
					if(elemento.pagoObservacion.search('Ingreso extra: ')!=-1){
						$('#OTROSINGRESOS').find('.panelCuadre ul').append(`<li class="list-group-item"><div class='col-xs-7 col-sm-9 mayuscula ${adelanto}'>${elemento.pagoObservacion.replace('Ingreso extra: ','').toLowerCase()} </div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
						monto=parseFloat($('#OTROSINGRESOS').parent().find('.montoSumado').text())+elemento.pagoMonto;
						$('#OTROSINGRESOS').parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));					
						sumaParcialOtros+=elemento.pagoMonto;
					}
					if(elemento.pagoObservacion.search('Egreso extra: ')!=-1){
						$('#EGRESOS').find('.panelCuadre ul').append(`<li class="list-group-item"><div class='col-xs-7 col-sm-9 mayuscula ${adelanto}'>${elemento.pagoObservacion.replace('Egreso extra: ','').toLowerCase()} </div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
						monto=parseFloat($('#EGRESOS').parent().find('.montoSumado').text())+elemento.pagoMonto;
						$('#EGRESOS').parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));
						sumaParcialEgresos+=elemento.pagoMonto;
						}
					}
					else{$('#OTROSINGRESOS').find('.panelCuadre ul').append(`<li class="list-group-item"><div class='col-xs-7 col-sm-9 mayuscula ${adelanto}'>${elemento.nombres.toLowerCase()}: <em class="mayuscula text-muted">${elemento.pagoObservacion.toLowerCase()}</em></div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
							monto=parseFloat($('#OTROSINGRESOS').parent().find('.montoSumado').text())+elemento.pagoMonto;
							$('#OTROSINGRESOS').parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));					
							sumaParcialOtros+=elemento.pagoMonto;}
			}
		}

		if (adelanto=='NoEsAdelanto'){
			switch(elemento.Tipo){
			case 'CONSULTA':
				$(`#${elemento.prodDetalle}`).find('.panelCuadre ul').append(`<li class="list-group-item mitooltip"  data-toggle="tooltip" data-placement="right" title="Cobró: ${elemento.usuNombre}" ><div class='col-xs-7 col-sm-9 mayuscula ${adelanto} '>${elemento.nombres.toLowerCase()} <em class="text-muted">${elemento.pagoObservacion}</em></div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
				$(`#${elemento.prodDetalle}`).parent().removeClass('sr-only');
				cantidad=$(`#${elemento.prodDetalle}`).parent().find('#cantidad').text();
				$(`#${elemento.prodDetalle}`).parent().find('#cantidad').text(parseInt(cantidad)+1);
				monto=parseFloat($(`#${elemento.prodDetalle}`).parent().find('.montoSumado').text())+elemento.pagoMonto;
				$(`#${elemento.prodDetalle}`).parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));			
				sumaParcialConsulta+=elemento.pagoMonto; break;
			case 'PROCEDIMIENTO':
				tipoProc=elemento.regDescripcion.substring(0, elemento.regDescripcion.search(' ')).toUpperCase();
				$(`#${tipoProc}`).find('.panelCuadre ul').append(`<li class="list-group-item"><div class='col-xs-7 col-sm-9 mayuscula ${adelanto}'>${elemento.nombres.toLowerCase()} <em class="text-muted">${elemento.pagoObservacion}</em></div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
				$(`#${tipoProc}`).parent().removeClass('sr-only');
				cantidad=$(`#${elemento.prodDetalle}`).parent().find('#cantidad').text();
				$(`#${elemento.prodDetalle}`).parent().find('#cantidad').text(parseInt(cantidad)+1);
				monto=parseFloat($(`#${tipoProc}`).parent().find('.montoSumado').text())+elemento.pagoMonto;
				$(`#${tipoProc}`).parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));			
				sumaParcialProcedimientos+=elemento.pagoMonto;break;
			case 'OTROS':
				if(elemento.nombres == null){
					if(elemento.pagoObservacion.search('Ingreso extra: ')!=-1){
						$('#OTROSINGRESOS').find('.panelCuadre ul').append(`<li class="list-group-item"><div class='col-xs-7 col-sm-9 mayuscula ${adelanto}'>${elemento.pagoObservacion.replace('Ingreso extra: ','').toLowerCase()} </div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
						monto=parseFloat($('#OTROSINGRESOS').parent().find('.montoSumado').text())+elemento.pagoMonto;
						$('#OTROSINGRESOS').parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));					
						sumaParcialOtros+=elemento.pagoMonto;
					}
					if(elemento.pagoObservacion.search('Egreso extra: ')!=-1){
						$('#EGRESOS').find('.panelCuadre ul').append(`<li class="list-group-item"><div class='col-xs-7 col-sm-9 mayuscula ${adelanto}'>${elemento.pagoObservacion.replace('Egreso extra: ','').toLowerCase()} </div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
						monto=parseFloat($('#EGRESOS').parent().find('.montoSumado').text())+elemento.pagoMonto;
						$('#EGRESOS').parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));
						sumaParcialEgresos+=elemento.pagoMonto;
						}
					}
					else{$('#OTROSINGRESOS').find('.panelCuadre ul').append(`<li class="list-group-item"><div class='col-xs-7 col-sm-9 mayuscula ${adelanto}'>${elemento.nombres.toLowerCase()}: <em class="mayuscula text-muted">${elemento.pagoObservacion.toLowerCase()}</em></div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(elemento.pagoMonto).toFixed(2)}</div></li>`);
							monto=parseFloat($('#OTROSINGRESOS').parent().find('.montoSumado').text())+elemento.pagoMonto;
							$('#OTROSINGRESOS').parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));					
							sumaParcialOtros+=elemento.pagoMonto;}
			}
		}

	});
	

	$('#sumaParcialConsultas').text(parseFloat(sumaParcialConsulta).toFixed(2));
	$('#sumaParcialProcedimientos').text(parseFloat(sumaParcialProcedimientos).toFixed(2));
	$('#sumaParcialOtros').text(parseFloat(sumaParcialOtros).toFixed(2));
	$('#sumaParcialEgresos').text(parseFloat(sumaParcialEgresos).toFixed(2));

	$('#aConAdelantos').html('('+ (cantNoAdelanto + cantAdelanto) + ') Con adelantos');
	$('#aSinAdelantos').html('('+ cantNoAdelanto + ') Sin adelantos');
	calcularSumaDia();
	calcularCantidadesUnidadesxPago();
	$('.mitooltip').tooltip();

}

function calcularSumaDia(){
	var sumaParcialConsulta, sumaParcialProcedimientos, sumaParcialOtros, sumaParcialEgresos, sumaTotal;
	sumaParcialConsulta=parseFloat($('#sumaParcialConsultas').text(),2);
	sumaParcialProcedimientos=parseFloat($('#sumaParcialProcedimientos').text(),2);
	sumaParcialOtros=parseFloat($('#sumaParcialOtros').text(),2);
	sumaParcialEgresos=parseFloat($('#sumaParcialEgresos').text(),2);
	//console.log(sumaParcialConsulta+' '+sumaParcialProcedimientos+' '+sumaParcialOtros+' '+sumaParcialEgresos);
	sumaTotal=parseFloat(sumaParcialConsulta+sumaParcialProcedimientos+sumaParcialOtros-sumaParcialEgresos).toFixed(2);
	$('#montoIngresos').text(parseFloat(sumaParcialConsulta+sumaParcialProcedimientos+sumaParcialOtros).toFixed(2));
	$('#montoEgresos').text(parseFloat(sumaParcialEgresos).toFixed(2));
	$('#sumaTotal').text(sumaTotal);
	$('#TotalDia').text(sumaTotal);
	//console.log('total' +sumaTotal)
}
function calcularCantidadesUnidadesxPago() {
	$('#PARTICULAR').parent().find('#cantidad').text($('#PARTICULAR li').length);
	$('#PUNO').parent().find('#cantidad').text($('#PUNO li').length);
	$('#CONVENIO').parent().find('#cantidad').text($('#CONVENIO li').length);
	$('#CAYETANO_HEREDIA').parent().find('#cantidad').text($('#CAYETANO_HEREDIA li').length);
	$('#FRANK_PAIS').parent().find('#cantidad').text($('#FRANK_PAIS li').length);
	$('#FRANCO_PERUANO').parent().find('#cantidad').text($('#FRANCO_PERUANO li').length);
	$('#NIÑO_JESUS').parent().find('#cantidad').text($('#NIÑO_JESUS li').length);
	$('#SALUD_MUJER').parent().find('#cantidad').text($('#SALUD_MUJER li').length);
	$('#SAN_PABLO').parent().find('#cantidad').text($('#SAN_PABLO li').length);
	$('#SANTO_DOMINGO').parent().find('#cantidad').text($('#SANTO_DOMINGO li').length);
	$('#PNP').parent().find('#cantidad').text($('#PNP li').length);

	$('#AUDIOMETRÍA').parent().find('#cantidad').text($('#AUDIOMETRÍA li').length);
	$('#CAUTERIZACIÓN').parent().find('#cantidad').text($('#CAUTERIZACIÓN li').length);
	$('#CIRUJÍA').parent().find('#cantidad').text($('#CIRUJÍA li').length);
	$('#CURACIÓN').parent().find('#cantidad').text($('#CURACIÓN li').length);
	$('#LARINGOSCOPÍA').parent().find('#cantidad').text($('#LARINGOSCOPÍA li').length);
	$('#LIBERACIÓN').parent().find('#cantidad').text($('#LIBERACIÓN li').length);
	$('#OTROS').parent().find('#cantidad').text($('#OTROS li').length);
	$('#REDUCCIÓN').parent().find('#cantidad').text($('#REDUCCIÓN li').length);

	$('#OTROSINGRESOS').parent().find('#cantidad').text($('#OTROSINGRESOS li').length);
	$('#EGRESOS').parent().find('#cantidad').text($('#EGRESOS li').length);
}
function resetearCambioDiaCaja () {
	$('#PARTICULAR').parent().addClass('sr-only');
	$('#PUNO').parent().addClass('sr-only');
	$('#CONVENIO').parent().addClass('sr-only');
	$('#CAYETANO_HEREDIA').parent().addClass('sr-only');
	$('#FRANK_PAIS').parent().addClass('sr-only');
	$('#FRANCO_PERUANO').parent().addClass('sr-only');
	$('#NIÑO_JESUS').parent().addClass('sr-only');
	$('#SALUD_MUJER').parent().addClass('sr-only');
	$('#SAN_PABLO').parent().addClass('sr-only');
	$('#SANTO_DOMINGO').parent().addClass('sr-only');
	$('#PNP').parent().addClass('sr-only');

	$('#AUDIOMETRÍA').parent().addClass('sr-only');
	$('#CAUTERIZACIÓN').parent().addClass('sr-only');
	$('#CIRUJÍA').parent().addClass('sr-only');
	$('#CURACIÓN').parent().addClass('sr-only');
	$('#LARINGOSCOPÍA').parent().addClass('sr-only');
	$('#LIBERACIÓN').parent().addClass('sr-only');
	$('#OTROS').parent().addClass('sr-only');
	$('#REDUCCIÓN').parent().addClass('sr-only');
}

var minutosControl;
socket.on('TiempoControles',function (minutos) {minutosControl=minutos;
	if(minutos==5){	$('#tblControl10min').remove();}
	if(minutos==10){ $('#tblControl5min').remove();}

})
socket.on('resultadoContraseña',function(estadoCoincide){
	if(!estadoCoincide){console.log('no coincide')//no coincide la contraseña anterior
		$('.modal-password .alert-danger').find('#texto').text('La contraseña anterior no es correcta.');
		$('.modal-password').find('.alert-danger').removeClass('sr-only');}
	else{$('.modal-password .alert-danger').addClass('sr-only');}

});
socket.on('actualizadoContraseña',function() {
	$('.modal-password').modal('hide');
});

socket.on('listadoComentariosParaCliente',function(datos) {
	datos.map(function(elemento,index) {
		$('#divNotas').append(`<div class="col-sm-3 animated fadeInUp" >
						<div class="panel panel-primary">
							<div class="panel-heading"><span class="glyphicon glyphicon-paperclip"></span> <strong> ${elemento.comentTitulo}</strong></div>
							<div class="panel-body">
								<em><h6 class="text-right">	${moment(elemento.comentFecha).fromNow()}</h6>
								<p class="text-primary">«${elemento.comentRelleno}»</p>								
								<h6 class="text-right">${elemento.usuNombre}.</p></h6></em>
							</div>
							<div class="panel-footer text-center">
								<div class="btn-group" role="group" aria-label="...">
									<button type="button" class="btn btn-success mitooltip btnEditarNota" data-toggle="tooltip" data-placement="top" title="Editar"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-danger mitooltip btnEliminarNota" id="${elemento.idComentario}"  data-toggle="tooltip" data-placement="top" title="Eliminar nora"><span class="glyphicon glyphicon-remove-sign"></span></button>
								</div>
							</div>
						</div>
					</div>`);
	});
	$('.mitooltip').tooltip();
});
socket.on('contadoComentarios',function(datos){
	$('#lblContarComentarios').text(datos.num);
});