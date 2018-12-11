var socket = io.connect('http://192.168.1.187:8080', { 'forceNew': true });


function listadoDatosUsuario(){
	$.ajax({url: 'php/solicitarDatosUsuario.php', type: "POST"}).success(function (resp) {
		var dato=JSON.parse(resp);
		usuario.idUsuario=dato.idUsuario;	
		usuario.nombre=dato.usuNombre;
		usuario.apellidos=dato.usuApellidos;
		usuario.nombreCompleto= dato.usuNombre+', '+dato.usuApellidos;
		usuario.tipo=dato.idTipo;
	});
}

function calcularEdadHastaHoy(fechaNacimiento){
	var cumple=moment(fechaNacimiento, "YYYY-MM");
	cumple.locale('fr-ca');moment.locale('fr-ca');
	var hoy = moment().format("YYYY-MM");
	return moment(cumple).preciseDiff(hoy);
}

socket.on('returnConsolidadxCliente',function(dato){
var dato=dato[0]; console.log(dato)
	$('#emNombre').text(dato.nombres.toLowerCase());
	$('#emEdad').text(calcularEdadHastaHoy(dato.cliFechaNacimiento));
	$('#emCivil').text(dato.estcivDescripcion.toLowerCase());
	$('#emGrado').text(dato.gradDescripcion.toLowerCase());
	$('#emOcupacion').text(dato.ocupDetalle.toLowerCase());
	$('#emProcedencia').text(dato.prodDetalle.toLowerCase());
	if(dato.ultimVisita==''){ $('#emVisita').text('Primera vez')}else{
		moment.locale('es');
		$('#emVisita').text(moment(dato.ultimVisita).fromNow())
	}

});

socket.on('returnListaAtendidos',function(idAnt, nomAnt, idNuev, nomNuev){
	$('#botonVerAnteriorPaciente').attr('href', 'ClientePanel.php?id='+idAnt)
	$('#spanNombrePacienteAnterior').text(nomAnt);
	$('#idPacListaLlamado').attr('href', 'ClientePanel.php?id='+idNuev)
	$('#spanNombrePacienteLlamado').text(nomNuev);
});