var socket = io.connect('http://localhost:8080', { 'forceNew': true });

	socket.on('listadoCitas',function (dato) {
		$('table tbody').empty();
		console.log(dato);
		dato.map(function(elemento,index){
			$('table tbody').append(`<tr>
						<td class="hora">${elemento.hora.replace('AM','a.m.').replace('PM','p.m.')}</td>
						<td class="mayuscula">${elemento.nombres.toLowerCase()}</td>
						<td class="tipo">${elemento.descripcion}</td>
						<td class="mayuscula">${elemento.prodDetalle.toLowerCase()}</td>
						<td>A</td>
						<td>
						<button class="btn btn-danger btnIcono mitooltip" id='pruebita' data-placement="left" title="Cancelar cita"><i class="material-icons">delete_forever</i></button>
						<button class="btn btn-success btnIcono mitooltip" data-placement="top" title="Cambiar horario"><i class="material-icons">file_download</i></button>
						<button class="btn btn-primary btnIcono mitooltip" id="${elemento.idCliente}"  data-placement="right" title="Más detalles"><i class="material-icons">person_pin</i></button>
						</td>
					</tr>`)
		});		
});
$('#btnlistarFechaDtp').click(function(){
	socket.emit('listarCitasHoy',$('#dtpFecha').val());
});
$('.btnIcono').click(function () {
	console.log($(this).attr('id'));
})