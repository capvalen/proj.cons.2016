USE consultorio;
INSERT INTO `consultorio`.`procedencia` (`idProcedencia`, `prodDetalle`, `procWeb`) VALUES ('14', 'SANTA CRUZ', 'SANTA_CRUZ');
INSERT INTO `consultorio`.`procedencia` (`idProcedencia`, `prodDetalle`, `procWeb`) VALUES ('15', 'SAN LUIS', 'SAN_LUIS');


ALTER TABLE `consultorio`.`pagos` 
ADD COLUMN `pagoTurno` INT NULL COMMENT 'el pago será 1 para pago diurno y 2 para pago nocturno' AFTER `idTipoPago`;


USE `consultorio`;
DROP procedure IF EXISTS `insertarPago`;

DELIMITER $$
USE `consultorio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarPago`(in idregistro int,in cantidad double,in idusuario int,
 in observ text, in idCli int, in tipPago int, in turno int)
BEGIN
INSERT INTO `consultorio`.`pagos`
(
`idRegistro`,
`pagoMonto`,
`pagoFecha`,
`idUsuario`,pagoObservacion,`idCliente`,idtipopago,pagoTurno)
VALUES
(
idregistro,
cantidad,
now(),
idusuario, observ,idCli,tipPago,turno);

END$$

DELIMITER ;




USE `consultorio`;
DROP procedure IF EXISTS `listarCuadreDiurno`;

DELIMITER $$
USE `consultorio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarCuadreDiurno`(in fecha text)
BEGIN
SELECT idRegistro, pagoMonto, pagoFecha,  pagoObservacion,
concat(cli.cliNombres, ', ', cli.cliApellidoPaterno, ' ' , cli.cliApellidoMaterno) as nombres,
case when procWeb is null then 'OTROS' else procWeb end as prodDetalle,
usuario.usuNombre, regDescripcion,
case idTipoMovimientos when 1 or 2 or 4 then 'OTROS ' WHEN 3 THEN 'CONSULTA' WHEN 5 THEN 'PROCEDIMIENTO' WHEN 8 THEN 'CIRUJÍA' else 'OTROS' end as Tipo
, idtipopago
FROM consultorio.pagos
left join cliente cli on cli.idCliente=pagos.idCliente
left join procedencia on procedencia.idProcedencia=cli.idprocedencia
left join usuario on usuario.idUsuario= pagos.idUsuario
left join registromovimientos reg on reg.idregistroMovimientos = pagos.idregistro
left join tipomovimientos tip on tip.idTipoMovimientos=reg.idtipo
/*where DATE_FORMAT(pagoFecha,'%Y-%m-%d')= fecha and DATE_FORMAT(pagoFecha,'%H')<=14*/ 
where  DATE_FORMAT(pagoFecha,'%Y-%m-%d')= fecha and pagoTurno = 1
order by Tipo, prodDetalle, pagoObservacion asc;
END$$

DELIMITER ;




USE `consultorio`;
DROP procedure IF EXISTS `listarCuadreNocturno`;

DELIMITER $$
USE `consultorio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `listarCuadreNocturno`(in fecha text)
BEGIN

SELECT idRegistro, pagoMonto, pagoFecha,  pagoObservacion,
concat(cli.cliNombres, ', ', cli.cliApellidoPaterno, ' ' , cli.cliApellidoMaterno) as nombres,
case when procWeb is null then 'OTROS' else procWeb end as prodDetalle,
usuario.usuNombre, regDescripcion,
case idTipoMovimientos when 1 or 2 or 4 then 'OTROS ' WHEN 3 THEN 'CONSULTA' WHEN 5 THEN 'PROCEDIMIENTO' WHEN 8 THEN 'CIRUJÍA' else 'OTROS' end as Tipo
, idtipopago
FROM consultorio.pagos
left join cliente cli on cli.idCliente=pagos.idCliente
left join procedencia on procedencia.idProcedencia=cli.idprocedencia
left join usuario on usuario.idUsuario= pagos.idUsuario
left join registromovimientos reg on reg.idregistroMovimientos = pagos.idregistro
left join tipomovimientos tip on tip.idTipoMovimientos=reg.idtipo
/*where DATE_FORMAT(pagoFecha,'%Y-%m-%d')= fecha and DATE_FORMAT(pagoFecha,'%H')>14*/
where  DATE_FORMAT(pagoFecha,'%Y-%m-%d')= fecha and pagoTurno = 2
order by Tipo, prodDetalle, pagoObservacion asc;
END$$

DELIMITER ;



USE `consultorio`;
DROP procedure IF EXISTS `insertarEgresoExtra`;

DELIMITER $$
USE `consultorio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarEgresoExtra`(in monto double,in user int, in motivo text, in turno int)
BEGIN
INSERT INTO `consultorio`.`pagos`
(`idRegistro`,
`pagoMonto`,
`pagoFecha`,
`idUsuario`,
`pagoObservacion`,
`idCliente`, idTipoPago, pagoturno)
VALUES
(
0,
monto,
now(),
user,
concat('Egreso extra: ' , motivo),
0,4,turno);
END$$

DELIMITER ;





USE `consultorio`;
DROP procedure IF EXISTS `insertarIngresoExtra`;

DELIMITER $$
USE `consultorio`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarIngresoExtra`(in monto double,in user int, in motivo text, in turno int)
BEGIN
INSERT INTO `consultorio`.`pagos`
(`idRegistro`,
`pagoMonto`,
`pagoFecha`,
`idUsuario`,
`pagoObservacion`,
`idCliente`,idTipoPago, pagoturno)
VALUES
(
0,
monto,
now(),
user,
concat('Ingreso extra: ' ,motivo),
0, 3, turno);
END$$

DELIMITER ;





-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertarEgresoExtra`(in monto double,in user int, in motivo text, in turno int)
BEGIN
INSERT INTO `consultorio`.`pagos`
(`idRegistro`,
`pagoMonto`,
`pagoFecha`,
`idUsuario`,
`pagoObservacion`,
`idCliente`, idTipoPago, pagoturno)
VALUES
(
0,
monto,
now(),
user,
concat('Egreso extra: ' , motivo, turno),
0,4);
END