CREATE TABLE `recetas` (
 `idReceta` int(11) NOT NULL AUTO_INCREMENT,
 `contReceta` text NOT NULL,
 `idCliente` int(11) NOT NULL,
 PRIMARY KEY (`idReceta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1