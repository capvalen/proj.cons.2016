<?php 
echo "Ver. 1.5 Compilado 18.02.07";

/*
Ver. 1.5
agregar tabla seAtiende

INSERT INTO `seatiende` (`idAnterior`, `antNombres`, `idEntrante`, `entrNombres`) VALUES ('30101', 'No hay paciente', '30101', 'No hay paciente');
UPDATE `cliente` SET `cliApellidoPaterno` = 'No hay paciente.', `cliApellidoMaterno` = 'No hay paciente.', `cliNombres` = 'No hay paciente.', `idOcupacion` = '12', `idGradoEstudios` = '1' WHERE `cliente`.`idCliente` = 30101;
UPDATE `cliente` SET `cliDireccion` = '', `cliCelular` = '' WHERE `cliente`.`idCliente` = 30101;
UPDATE `documentoidentidad` SET `idTipoDocumento` = '3', `NumeroDocumento` = '' WHERE `documentoidentidad`.`idCliente` = 30101;

Cambios 1.2
actualizar procedure:
* listarCitasPorFecha
+ listarContadorResumen
+ updateMoverFechaConsulta

Archivos
* cliente.php
* socketCliente.js
*/
 ?>

 
