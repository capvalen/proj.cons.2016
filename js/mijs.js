var idUsuario=1;
var usuario={idUsuario: '12', nombre:'Carl'};
var datosGenerales,datosCitasDelDia;
var asignarCalendarioABD=false;
var clientePuedeCitaHoy=false;
var geneIdConsulta=0;//3 para consultas, 4 para revaluaciones, 5 para procedimientos, 8 para cirujías, 6 para el cambio de fechas
var idRegistroMovible=0;
$('.thumbnail').mouseenter(function(){
	$(this).children('.btn').addClass('animated bounce').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', 
		function(){
		$(this).removeClass('animated bounce');
	});
});

$(document).ready(function(){
	$('#fechaServer').load("php/getFecha.php");
	setInterval(function(){$('#horaServer').load("php/gethora.php");},'1000');
	$('#listBarras').hide();
	$('.mitooltip').tooltip();
	$('.BSswitch').bootstrapSwitch('state', true);
	
});

$('#cmbTipoPersona').change(function(){
	//console.log($(this).val());
	switch($(this).val()){
		case "1": $('#txtDni').attr('disabled', false);$('#cmbGrado').val('4');$('#txtDni').focus();break;
		case "2": $('#txtDni').attr('disabled', false);$('#cmbGrado').val('3');$('#cmbOcupacion').val('25'); break;
		case "3": $('#txtDni').val("");$('#txtDni').attr('disabled', true);$('#cmbGrado').val('4');break;
	}
});

$('#btnGuardarCliente').click(function(){
	if(validarCamposCliente()) {grabarCliente('grabar');}
});

function validarCamposCliente() {
	if(($('#txtDni').val()=="" || $('#txtDni').val().length<8) && $('#cmbTipoPersona').val()==1){
		$('#contenidoErrorCliente').html('El campo del DNI esta incompleto.');
		$('#mensajeErrorCliente').removeClass('sr-only'); return false;//console.log("falta DNI");
	}
	else if($('#txtDni').val()=="" && $('#cmbTipoPersona').text()=="Menor de edad "){
		$('#contenidoErrorCliente').html('El campo del DNI esta incompleto.');
		$('#mensajeErrorCliente').removeClass('sr-only'); return false;
	}
	else if($('#txtApellidoPaterno').val()=="" || $('#txtApellidoMaterno').val()=="" || $('#txtNombres').val()==""){
		$('#contenidoErrorCliente').html('Faltan los apellidos o nombres del cliente.');
		$('#mensajeErrorCliente').removeClass('sr-only'); return false;
	}
	else{
	//listo para guardar
		//$( "#btnGuardarCliente" ).prop( "disabled", true );
		$('#mensajeErrorCliente').addClass('sr-only'); return true;
		//console.log("guardando");		
		//location.href = 'ClientePanel.html';
	}
}

$('#txtFechaNacimiento').focusout(function(){
	//console.log($('#txtFechaNacimiento').val());
		
});
$(".modal").on("hidden.bs.modal", function(){
		//borrar los campos del modal
});

$("#cmbAdelanto").change(function(){
	switch($("#cmbAdelanto").val()){
		case "1": $("#txtMontoPagado").val("60.00");break;
		case "2":
		case "3": $("#txtMontoPagado").val("0.00");break;   
	}
});
$('.modal-cita #asignarDias').click(function(){
	var dias=$('#txtAsignarDias').val();
	if( dias==''){  dias=0;}
	//else {console.log(dias);}
	moment.locale('fr-ca');
	var fecha = moment();
	fecha = fecha.add(dias, 'days');
	//console.log(fecha.format('L'));
	$("#dtpFechaCita").val(fecha.format('L'));
	$("#dtpFechaCita").change();
});

$("#dtpFechaCita").change(function(){	
	//solicitar via socket las citas de los clientes por fecha
	//console.log($("#dtpFechaCita").val())	;
	if(moment($("#dtpFechaCita").val()).isValid()){
		socket.emit('listarCitasHoy',$("#dtpFechaCita").val());}
});
$('#btnCrearCita').click(function(){
	prepararModalCitas();
	asignarCalendarioABD=true;
	geneIdConsulta=3;
	$('.nav-tabs a[href="#calendar"]').tab('show');
	//solicitar via socket las citas de los clientes de hoy

	//socket.emit('listarCitasHoy',moment().format('L'));
});
function prepararModalCitas() {
	
	moment.locale('fr-ca');
	var hora=moment();
	hora=hora.add(10,'minutes');
	//console.log(hora.format('LT')); 
	$('#dtpHoraCita').val(hora.format('LT'));
	var lim=moment().subtract(1,'days').format('L');
	$("#dtpFechaCita").attr('min',moment().format('L'));
	$("#dtpFechaCita").val(moment().format('L'));
	$('#divErrorCita').addClass('sr-only');
}
$('#btnProgramarCita').click(function(){
	moment.locale('fr-ca');
	console.log('cli pro')
	var horaNueva=moment($('#dtpHoraCita').val(),'HH:mm');
	//console.log('hora que viene del objeto ' +horaNueva.format('LT'));
	var estado = true;
	
	var diferencia=0;
	$('#tblCitas>tbody>tr').each(function(index,element){
		
		var horaComparar=moment($(element).find('.hora').html(),'HH:mm');
		
		diferencia = horaComparar.diff(horaNueva,'minutes');
		//console.log('Diferencia entre horas ' + diferencia);
		if (diferencia>-10 && diferencia<10) {estado=false; return false;}
		else{//asignar valor verdadero para luego agregar a la BD
			 estado = true;}

	});

	if (estado==false){
		$('.mensajeError').text("Conflicto, No se cumplen 10 minutos entre citas.")
		$('#divErrorCita').removeClass('sr-only');
		//console.log('No hay 10 min entre las citas.' +  ${diferencia} + ' min');
	}
	else{
		var FechaHora= $("#dtpFechaCita").val() + ' ' + $("#dtpHoraCita").val()
		//console.log(FechaHora);
		socket.emit('agregarCita',datosGenerales.idCliente,FechaHora,idUsuario);    
	}
	

});
function verificarCitaClienteporDia(idPaciente){
	var estadoExiste=true;
	$('#tblCitas>tbody>tr').each(function(index,element){
		var idPacienteLista=$(element).find('.id').html();
		if(datosGenerales.idCliente==idPacienteLista){
			$('#btnProgramarCita').prop( "disabled", true );
			$('.mensajeError').text('El cliente ya tiene cita en este día.');
			$('#divErrorCita').removeClass('sr-only');
			estadoExiste=false;
			return false;}
		else{estadoExiste=true;}
	});
	if( estadoExiste){return true;}
}
function agregarFila(){

		// Obtenemos el numero de filas (td) que tiene la primera columna
		// (tr) del id "tabla"
		var tds=$("#tblCitas tr:first td").length;
		// Obtenemos el total de columnas (tr) del id "tabla"
		var trs=$("#tblCitas tr").length;
		var nuevaFila="<tr>";
		for(var i=0;i<tds;i++){
				// añadimos las columnas
				nuevaFila+="<td>"+(i+1)+" Añadida con jquery</td>";
		}
		// Añadimos una columna con el numero total de columnas.
		// Añadimos uno al total, ya que cuando cargamos los valores para la
		// columna, todavia no esta añadida
		nuevaFila+="<td>"+(trs+1)+" columnas";
		nuevaFila+="</tr>";
		$("#tblCitas").append(nuevaFila);
}
$('.eliminarCita').click(function(){
	 /**
 * Funcion para eliminar la ultima columna de la tabla.
 * Si unicamente queda una columna, esta no sera eliminada
 */
		// Obtenemos el total de columnas (tr) del id "tabla"
		var trs=$("table tr").length;
		console.log (trs);
		if(trs>1)
		{
				// Eliminamos la ultima columna
				$("table tr:last").remove();
		}
});

$('#btnGuardarPago').click(function(){
	
	if($('#txtMontoPagado').val()<=0){
		$(".mensajeError").html("El monto no puede ser negativo o estar vacío");
		$('#divErrorPago').removeClass('sr-only');
	}
	else{
		$('#divErrorPago').addClass('sr-only');
		
		socket.emit('insertarPago',parseInt($('#lblidRegistro').html()),parseFloat($('#txtMontoPagado').val()),idUsuario,$('#txtObservacion').val(),datosGenerales.idCliente);
	}
});
$('#btnIngresarPago').click(function(){
	$('#divErrorPago').addClass('sr-only');
});
$('#btnFiltroListaNuevos').click(function(){

	$('#btnFiltroListaTodos').click();
	$('.table>tbody>tr').each(function(index,element){
		if($(element).find('.tipo').html()!='Consulta'){$(element).hide('slow');}
	});
});
$('#btnFiltroListaRevaluados').click(function(){
	$('#btnFiltroListaTodos').click();
	$('.table>tbody>tr').each(function(index,element){
		if($(element).find('.tipo').html()!='Revaluación'){$(element).hide('slow');}
	});
});
$('#btnFiltroListaProcedimientos').click(function(){
	$('#btnFiltroListaTodos').click();
	$('.table>tbody>tr').each(function(index,element){
		if($(element).find('.tipo').html()!='Procedimiento'){$(element).hide('slow');}
	});
});
$('#btnFiltroListaTodos').click(function(){
	$('.table>tbody>tr').each(function(index,element){
			$(element).show('slow');
	});
});
$('#btnGuardarMotivo').click(function(){
	datosGenerales.motivo=$('#txtMotivo').val().toUpperCase();
	socket.emit('crearHistoria',datosGenerales.idCliente,datosGenerales.motivo.toUpperCase(),idUsuario);
	$('.modal-motivo').modal('hide');
	
});

function toTitleCase(str)
{
		return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
$('#txtBuscar').keypress(function(event){
    if (event.keyCode === 10 || event.keyCode === 13) 
      {event.preventDefault();
     	$('#btnBuscar').click();
     	$('#txtBuscar').val('');}
  });
$('#btnBuscar').click(function(){
	if($('#txtBuscar').val().length>=3){
 		if(esNumero($('#txtBuscar').val())){ 
 			//buscar en dnis
 			socket.emit('buscarClientePorDni',$('#txtBuscar').val());
 		}else{ 			
 			//sólo letras devuelve true, combinado letras con números es false
 			//buscar en nombres
 			socket.emit('buscarClientePorApellido',$('#txtBuscar').val());
 		}
	$('#txtBuscar').val('');
 	} 	
});
function esNumero(cadena)
{
      if (cadena.match(/^[0-9]+$/))
      {
        return true;
      }
      else
      {
        return false;
      }
}
$('#alistarUltimos').click(function() {
	socket.emit('listarUltimosRegistrados');
});
$('#btnActualizarDatos').click(function(){
	
	//console.log(`${}`);
	$('.modal-actualizarCliente #txtDni').val(datosGenerales.dni);
	$('.modal-actualizarCliente #cmbProcedencia').val(datosGenerales.idprocedencia);
	$('.modal-actualizarCliente #cmbTipoPersona').val(datosGenerales.idTipoDocumentoIdentidad).change();
	$('.modal-actualizarCliente #cmbEstadoCivil').val(datosGenerales.idestadocivil);
	$('.modal-actualizarCliente #cmbOcupacion').val(datosGenerales.idocupacion);
	$('.modal-actualizarCliente #cmbGrado').val(datosGenerales.idgradoestudios);
	$('.modal-actualizarCliente #txtApellidoPaterno').val(toTitleCase(datosGenerales.cliApellidoPaterno));
	$('.modal-actualizarCliente #txtApellidoMaterno').val(toTitleCase(datosGenerales.cliApellidoMaterno));
	$('.modal-actualizarCliente #txtNombres').val(toTitleCase(datosGenerales.cliNombres));
	$('.modal-actualizarCliente #txtTelefono').val(datosGenerales.cliTelefono);
	$('.modal-actualizarCliente #txtCelular').val(datosGenerales.cliCelular);
	if(datosGenerales.cliDireccion!='-'){$('.modal-actualizarCliente #txtDireccion').val(toTitleCase(datosGenerales.cliDireccion));}
	if(datosGenerales.sexo=='M'){$('#chkSexo').bootstrapSwitch('state', true);}
	else{$('#chkSexo').bootstrapSwitch('state', false);}

	
	fechaNa=moment(datosGenerales.cliFechaNacimiento);
	//console.log(fechaNa.format('YYYY-MM-DD'));
	$('.modal-actualizarCliente #dtpFechaNacimiento').val(fechaNa.format('YYYY-MM-DD'));
	$('.modal-actualizarCliente').modal('show');
});

$('#btnActualizarCliente').click(function(){
	if(validarCamposCliente()) {grabarCliente('actualizar');}
});
$('#listRegistro').on('click','.btnPagar',function() {
	var idReg=$(this).attr("id").replace('btnPagar','');
	$('#lblidRegistro').html(idReg);
	$('.modal-adelanto').modal('show');
});
$('#listRegistro').on('click','.btnImprimirConsulta',function(){
	var idd=$(this).attr("id");
	var idReg, titulo;
	if(idd.search('btnImprimirConsulta')!=-1){
		idReg=$(this).attr("id").replace('btnImprimirConsulta','');
		titulo=encodeURIComponent('REGISTRO DE CITA');
	}
	if(idd.search('btnImprimirRevaluación')!=-1){
		idReg=$(this).attr("id").replace('btnImprimirRevaluación','');
		titulo=encodeURIComponent('CITA DE CONTROL GRATUITA');
	}
	
	var hora= encodeURIComponent ($('#listRegistro').find(`#Reg${idReg} .phora`).text());
	var dia=encodeURIComponent ($('#listRegistro').find(`#Reg${idReg} .pdia`).text());
	urlImpr='imprimirCita.php?motivo='+titulo+'&dia='+dia+'&hora='+hora+'&nombres='+encodeURIComponent(datosGenerales.nombres)+'&idHistoria='+datosGenerales.idHistoria;
	console.log(urlImpr);
	loadPrintDocument(this,{
		url: urlImpr,
		attr: "href",
		message:"Tu documento está siendo creado"
	});
});
/*$('#listRegistro').on('click','.btnModificar',function(){
	$('.modal-cita').find('h4').text('Cambiar de fecha una cita existente');
	var idReg=$(this).attr("id").replace('btnModificar','');
	$('#btnActualizarProgramacionCita').removeClass('sr-only');
	$('#btnProgramarCita').addClass('sr-only');
	prepararModalCitas();
	$('.modal-cita #lblidRegistroUpdate').text(idReg);
	$('.modal-cita').modal('show');
	
});*/
$('#listRegistro').on('click','.btnModificar',function(){
	idRegistroMovible=$(this).attr("id").replace('btnModificar','');
	geneIdConsulta=6; asignarCalendarioABD=true;
	$('.nav-tabs a[href="#calendar"]').tab('show');
});
$('#listRegistro').on('click','.btnCancelarControl',function(){
	idRegistroMovible=$(this).attr("id").replace('btnCancelarControl','');
	$('.modal-cancelarCita').modal('show');
});
$('#btnActualizarProgramacionCita').click(function() {
	var FechaHora= $("#dtpFechaCita").val() + ' ' + $("#dtpHoraCita").val();
	socket.emit('updateFechaConsulta',parseInt($('#lblidRegistroUpdate').text()), FechaHora,idUsuario);
});
$('#btnCrearRevaluacion').click(function () {
	geneIdConsulta=4; asignarCalendarioABD=true;
	$('.nav-tabs a[href="#calendar"]').tab('show');
});
$('#btnCrearProcedimiento').click(function () {
	geneIdConsulta=5; asignarCalendarioABD=true;
	$('.nav-tabs a[href="#calendar"]').tab('show');
});
$('#btnEliminarCliente').click(function () {
	
});

$('td').hover(function() {
			 col =$(this).attr('data-column');
			$('.tablaCalendario').find(`th[data-column='${col}']`).css('background-color','#ffecb3');
		}).mouseleave(function(){
			$('.tablaCalendario').find(`th[data-column='${col}']`).css('background-color','white');
		})

		$('td').dblclick(function(){
			var row = $(this).attr("data-row");
			var col = $(this).attr("data-column");
			//console.log(asignarCalendarioABD + ' '+ clientePuedeCitaHoy);
			if($(this).text()=='' && asignarCalendarioABD && clientePuedeCitaHoy){//asignar un boton
			//$(this).text(row+':'+col);
			var hora=moment(row+':'+col,'H:mm');
			$('#lblAsignarHoraAMPM').text(hora.format('LT'));
			$('#lblAsignarHoraCompleta').text(row+':'+col);
			$('#modalAsignar').modal('show');
			}
			
		});
		$('.tablaCalendario').on('click','.btnDer',function(){
			var sumaMinutos;
			if($(this).parents('.tablaCalendario').attr('id')=='mañana'){sumaMinutos=10;}
			if($(this).parents('.tablaCalendario').attr('id')=='tarde'){sumaMinutos=15;}
			var row = parseInt($(this).parent().parent().attr("data-row"));
			var col = parseInt($(this).parent().parent().attr("data-column"));
			
			//console.log('Fila clickeada: '+row+':'+col);
			//Para la siguiente casilla
			var nextRow;
			var nextCol=col+sumaMinutos;
			if(nextCol==60){nextRow=row+1;nextCol='0';}//console.log('Proxima fila a mover '+ (row+1)+':0');}
			else {nextRow=row;}//console.log('Proxima columna a mover '+row+':'+nextCol);}

			var proxRow = row; var proxCol=col;
			var minutos, minutosLibre, minutosOcupado;	var estado = true;	var ocupado=0;
			var rowLibre, colLibre;
			var rowUltimo = row;
			var colUltimo = col;

			while (estado){
				if(proxRow>=6 && proxRow<=9){minutos=10}
					else{minutos=15}
				if(proxCol==45){proxRow=proxRow+1;proxCol=0;}
				else if(proxCol==50){proxRow=proxRow+1;proxCol=0;}
				else{proxCol+=minutos;}
				//console.log('actual ' + proxRow+'~'+proxCol);
				if($(`td[data-row='${proxRow}'][data-column='${proxCol}']`).html().length==0){estado=false; rowLibre=proxRow,colLibre=proxCol}
				else {estado=true;ocupado++;rowUltimo=proxRow;colUltimo=proxCol;}
				//console.log(estado);
			} 
			//console.log('libre ' + rowLibre+'~'+colLibre);
			//console.log('ocupado ' + rowUltimo+'~'+colUltimo);

			estado = true;
			var idReg
			while(estado){
				 idReg=parseInt($(`td[data-row='${rowUltimo}'][data-column='${colUltimo}']`).find('.btnPacienteCalendario').attr('id'));
				//console.log($('#dtpFechaCalendario').val() +' '+ rowLibre +':' +colLibre);
				socket.emit('updateFechaConsulta', idReg,$('#dtpFechaCalendario').val() +' '+ rowLibre +':' +colLibre,idUsuario );
				$(`td[data-row='${rowLibre}'][data-column='${colLibre}']`).html($(`td[data-row='${rowUltimo}'][data-column='${colUltimo}']`).html());
				$(`td[data-row='${rowUltimo}'][data-column='${colUltimo}']`).html('');
				rowLibre=rowUltimo; colLibre=colUltimo;
				//console.log('row libre '+rowLibre+' col libre ' + colLibre);
				
				if(rowLibre==10 && colUltimo==0){minutosOcupado=10}
				else if(rowUltimo>=6 && rowUltimo<=9){minutosOcupado=10}
				else{minutosOcupado=15}
					//console.log('minutos '+minutosOcupado)
				if(colUltimo==0){rowUltimo=rowUltimo-1;colUltimo=60-minutosOcupado;}
				else{colUltimo-=minutosOcupado;}
				//if(rowUltimo==9 && colUltimo==50){}
				//console.log('ulti row ocupado '+rowUltimo+' ulti col ocupado ' + colUltimo);
				//console.log('row libre '+rowLibre+' col libre ' + colLibre);				
				if(colLibre<=col && rowLibre==row){estado=false}
					else estado = true;
			}

			/*if($(`td[data-row='${nextRow}'][data-column='${nextCol}']`).html().length==0){
				$(`td[data-row='${nextRow}'][data-column='${nextCol}']`).html($(`td[data-row='${row}'][data-column='${col}']`).html());
				$(`td[data-row='${row}'][data-column='${col}']`).html('');
			}*/
			
		});

		$('.tablaCalendario').on('click','.btnIzq',function(){
			var sumaMinutos;
			if($(this).parents('.tablaCalendario').attr('id')=='mañana'){sumaMinutos=10;}
			if($(this).parents('.tablaCalendario').attr('id')=='tarde'){sumaMinutos=15;}
			var row = parseInt($(this).parent().parent().attr("data-row"));
			var col = parseInt($(this).parent().parent().attr("data-column"));
			//console.log($(this).parents('.tablaCalendario').attr('id'));
			//console.log('Fila clickeada: '+row+':'+col);
			//Para la siguiente casilla
			var nextRow;
			var nextCol=col-sumaMinutos;

			if(nextCol<0){nextRow=row-1;nextCol=60-sumaMinutos;}//console.log('Proxima fila a mover '+ (row-1)+':'+(60-sumaMinutos));
			else {nextRow=row;console.log('Proxima columna a mover '+row+':'+nextCol);}			
			if(nextRow==9 && nextCol==45)	{nextCol=50;}
			if($(`td[data-row='${nextRow}'][data-column='${nextCol}']`).html().length==0){
				$(`td[data-row='${nextRow}'][data-column='${nextCol}']`).html($(`td[data-row='${row}'][data-column='${col}']`).html());
				$(`td[data-row='${row}'][data-column='${col}']`).html('');
			}
		});

$('#btnAgregarConsultaHorario').click(function(){

	var completa=moment($('#lblAsignarHoraCompleta').text(),'H:mm');
	var row=completa.format('H');
	var col=completa.format('m');
	//$(`td[data-row='${row}'][data-column='${col}']`).html(`<div class="btn-group contenido"><button type="button" class="btn btn-sm btn-negro btnIzq"><span class="glyphicon glyphicon-backward"></span></button><button type="button" class="btn btn-sm btn-primary">Consulta</button><button type="button" class="btn btn-sm btn-negro btnDer"><span class="glyphicon glyphicon-forward"></span></button></div>`);
	//agregar a la BD
	switch(geneIdConsulta){
		case 3: socket.emit('agregarCita',datosGenerales.idCliente,$('#dtpFechaCalendario').val()+ ' '+row+':'+col,idUsuario); break;
		case 4: socket.emit('agregarRevaluacion',datosGenerales.idCliente,$('#dtpFechaCalendario').val()+ ' '+row+':'+col,idUsuario); break;
		case 6: socket.emit('updateFechaConsulta',idRegistroMovible,$('#dtpFechaCalendario').val()+ ' '+row+':'+col,idUsuario); break;
		default: break;
	}	
	$('.nav-tabs a[href="#home"]').tab('show');
	idRegistroMovible=0;

});

$('a[aria-controls="home"]').on('shown.bs.tab', function (){
	asignarCalendarioABD=false;
	$('#mnjClienteCitadoHoy').addClass('sr-only');
});

$('a[aria-controls="calendar"]').on('shown.bs.tab', function () {
	$('.alert').addClass('sr-only');
	moment.locale('es');
	$('#dtpFechaCalendario').val(moment().format('YYYY-MM-DD'));		
	var dia = moment($('#dtpFechaCalendario').val());
	
	$('#lblDiaCalendar').text(dia.format('dddd, D [de] MMMM [de] YYYY'));
	if(moment($("#dtpFechaCalendario").val()).isValid()){
		socket.emit('listarCitasHoy',$("#dtpFechaCalendario").val());}
});
$('#dtpFechaCalendario').change(function () {
	var dia = moment($('#dtpFechaCalendario').val());
	var hoy= moment().format('YYYY-MM-DD');
	
	clientePuedeCitaHoy=true;
	$('#lblDiaCalendar').text(dia.format('dddd, D [de] MMMM [de] YYYY'));	

	if(dia.diff(hoy,'day')<0){$('.tablaCalendario td').html('');
		$('#mnjClienteCitadoHoy').removeClass('sr-only').find('#lblMnjCita').html(`No se puede asignar fechas anteriores a ${moment(hoy).format('LLLL')}.`);}
	else{
		if(moment($("#dtpFechaCalendario").val()).isValid()){
			socket.emit('listarCitasHoy',$("#dtpFechaCalendario").val());}
	}
});
$('#btnRestarFecha').click(function() {
	var actual=moment($('#dtpFechaCalendario').val()).subtract(1,'days').format('YYYY-MM-DD');
	$('#dtpFechaCalendario').val(actual);
	$('#dtpFechaCalendario').change();
});
$('#btnSumarFecha').click(function() {
	var actual=moment($('#dtpFechaCalendario').val()).add(1,'day').format('YYYY-MM-DD');
	$('#dtpFechaCalendario').val(actual);
	$('#dtpFechaCalendario').change();
});
function bloquearCeldasHoyxHora() {
	var hoy= moment().format('YYYY-MM-DD');
	var row,col,hora;
	var ahora=moment().format('H:m');

	$('.tablaCalendario tbody tr td').css("background-color", "");

		if($('#dtpFechaCalendario').val()==hoy){
			//Anular las horas anteriores a la actual

			$('table tbody tr').each(function(index){
				$(this).children('td').each(function (index2){
					row = $(this).attr("data-row");
					col = $(this).attr("data-column");
					var hora=moment(row+':'+ col,'H:m');
					if(moment().diff(hora,'minutes')>=9){
						$(this).css("background-color", "#eceff1");
						if($(this).html()==''){
							$(this).html(`<button type="button" class="btn btn-negro btn-sm"><span class="glyphicon glyphicon-pushpin grey-text text-lighten-2"></span></button>`)
						}else{$(this).find('.btnIzq').remove();$(this).find('.btnDer').remove();}
					}
					//if(){$(this).css("background-color", "#efebe9");}					
				});
			});
		}
}
$('#btnCancelarCita').click(function(){
	socket.emit('eliminarCita',parseInt(idRegistroMovible), usuario.nombre);
});