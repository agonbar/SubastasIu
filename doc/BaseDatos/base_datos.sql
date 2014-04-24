-- Creamos la base de datos
DROP DATABASE IF EXISTS SubastasIU;
CREATE DATABASE IF NOT EXISTS SubastasIU;

-- Asignamos
GRANT USAGE ON *.* TO 'userSubIu'@'localhost';
	DROP USER 'userSubIu'@'localhost';

-- Creamos el usuario
CREATE USER userSubIu@localhost IDENTIFIED BY 'passSubIu';
GRANT ALL ON SubastasIU.* TO userSubIu@localhost IDENTIFIED BY 'passSubIu';

-- Seleccionamos la base de datos
USE SubastasIU;

-- Borrar las tablas
DROP TABLE IF EXISTS Comentario;
DROP TABLE IF EXISTS Puja;
DROP TABLE IF EXISTS EstadoPuja;
DROP TABLE IF EXISTS HistoricoSubasta;
DROP TABLE IF EXISTS Subasta; 
DROP TABLE IF EXISTS EstadoSubasta;
DROP TABLE IF EXISTS LineaPedido;
DROP TABLE IF EXISTS Transaccion; 
DROP TABLE IF EXISTS HistoricoPedido; 
DROP TABLE IF EXISTS Pedido; 
DROP TABLE IF EXISTS EstadoPedido;
DROP TABLE IF EXISTS FotoComponente;
DROP TABLE IF EXISTS Notificacion;
DROP TABLE IF EXISTS EstadoNotificacion;
DROP TABLE IF EXISTS Componente;
DROP TABLE IF EXISTS EstadoComponente;
DROP TABLE IF EXISTS Usuario;
DROP TABLE IF EXISTS EstadoUsuario;

-- Creacion de la base de datos
CREATE TABLE Usuario (idUsuario int(10) NOT NULL AUTO_INCREMENT, idEstadoUsuario int(10) NOT NULL, nombre varchar(20), apellidos varchar(30), direccion varchar(50), localidad varchar(255), provincia varchar(255), codigoPostal varchar(5), dni varchar(9), email varchar(50), fechaNacimiento date, usuario varchar(20), clave varchar(35), cuentaPayPal int(30), isAdmin int(1), PRIMARY KEY (idUsuario));
CREATE TABLE EstadoUsuario (idEstadoUsuario int(10) NOT NULL AUTO_INCREMENT, nombreEstUsu varchar(20), desEstUsu varchar(50), PRIMARY KEY (idEstadoUsuario));
CREATE TABLE Notificacion (idNotificacion int(10) NOT NULL AUTO_INCREMENT, idEstadoNotificacion int(10) NOT NULL, idUsuarioOrigen int(10) NOT NULL, idUsuarioDestino int(10) NOT NULL, textoNot varchar(100), asuntoNot varchar(20), fechaEnvioNot datetime NULL, fechaLecturaNot datetime NULL, PRIMARY KEY (idNotificacion));
CREATE TABLE EstadoNotificacion (idEstadoNotificacion int(10) NOT NULL AUTO_INCREMENT, nombreEstNot varchar(20), desEstNot varchar(50), PRIMARY KEY (idEstadoNotificacion));
CREATE TABLE Pedido (idPedido int(10) NOT NULL AUTO_INCREMENT, idEstadoPedido int(10) NOT NULL, idUsuarioComprador int(10) NOT NULL, idUsuarioVendedor int(10) NOT NULL, fechaEnvio datetime NULL, fechaAlta datetime NULL, fechaActualizacion datetime NULL, total float, PRIMARY KEY (idPedido));
CREATE TABLE EstadoPedido (idEstadoPedido int(10) NOT NULL AUTO_INCREMENT, nombreEstPed varchar(20), desEstPed varchar(50), PRIMARY KEY (idEstadoPedido));
CREATE TABLE HistoricoPedido (idHistPedido int(10) NOT NULL AUTO_INCREMENT, idPedido int(10) NOT NULL, idEstadoInicial int(10) NOT NULL, idEstadoFinal int(10) NOT NULL, motivo varchar(50), PRIMARY KEY (idHistPedido));
CREATE TABLE LineaPedido (idLineaPedido int(10) NOT NULL AUTO_INCREMENT, idPedido int(10) NOT NULL, idComponente int(10) NOT NULL, precioLinea float, numUnidades int(10), PRIMARY KEY (idLineaPedido));
CREATE TABLE Transaccion (idTran int(10) NOT NULL AUTO_INCREMENT, idPedido int(10) NOT NULL, idUsuOrigTran int(10) NOT NULL, idUsuDesTran int(10) NOT NULL, fechaTran datetime NULL, concepto varchar(30), cantidad int(100), PRIMARY KEY (idTran));
CREATE TABLE Componente (idComponente int(10) NOT NULL AUTO_INCREMENT, idUsuVendedor int(10) NOT NULL, idEstadoComp int(10) NOT NULL, nombreComp varchar(20), desComp varchar(400), desBreveComp varchar(255), precio float, unidadesStock int(10), PRIMARY KEY (idComponente));
CREATE TABLE Subasta (idSubasta int(10) NOT NULL AUTO_INCREMENT, idUsuCreador int(10) NOT NULL, idEstadoSub int(10) NOT NULL, idCompSub int(10) NOT NULL, numCompSub int(10), titulo varchar(255), descripcionBreve varchar(255), descripcion varchar(400), fechaCierre datetime NULL, fechaApertura datetime NULL, fechaCreacion datetime NULL, precioInicial float, idFotoComp int(10), tituloFotoSub varchar(255), desFotoSub varchar(400), rutaFotoSub varchar(255), PRIMARY KEY (idSubasta));
CREATE TABLE EstadoSubasta (idEstadoSub int(10) NOT NULL AUTO_INCREMENT, nombreEstSub varchar(50), desEstSub varchar(50), PRIMARY KEY (idEstadoSub));
CREATE TABLE HistoricoSubasta (idHistSubasta int(10) NOT NULL AUTO_INCREMENT, idEstadoIniSub int(10) NOT NULL, idEstadoFinSub int(10) NOT NULL, motivoSub varchar(50), idSubasta int(10) NOT NULL, PRIMARY KEY (idHistSubasta));
CREATE TABLE Puja (idPuja int(10) NOT NULL AUTO_INCREMENT, idSubastaPuja int(10) NOT NULL, idUsuarioPuja int(10) NOT NULL, idEstPuja int(10) NOT NULL, cantPujada int(10), fechaPuja datetime NULL, PRIMARY KEY (idPuja));
CREATE TABLE EstadoPuja (idEstPuja int(10) NOT NULL AUTO_INCREMENT, nombreEstPuja varchar(20), desEstPuja varchar(50), PRIMARY KEY (idEstPuja));
CREATE TABLE Comentario (idComentario int(11) NOT NULL AUTO_INCREMENT, idUsuarioCom int(10) NOT NULL, idPedido int(10) NOT NULL, puntuacion int(11), mensaje varchar(255), fechaComentario datetime NULL, PRIMARY KEY (idComentario));
CREATE TABLE EstadoComponente (idEstadoComp int(10) NOT NULL AUTO_INCREMENT, nombreEstComp varchar(20), desEstComp varchar(50), PRIMARY KEY (idEstadoComp));
CREATE TABLE FotoComponente (idFotoComp int(10) NOT NULL AUTO_INCREMENT, idCompFoto int(10) NOT NULL, tituloFoto varchar(255), descripcionFoto varchar(400), ruta varchar(255), isPrincipal int(1), PRIMARY KEY (idFotoComp));
ALTER TABLE Notificacion ADD INDEX FKNotificaci349195 (idEstadoNotificacion), ADD CONSTRAINT FKNotificaci349195 FOREIGN KEY (idEstadoNotificacion) REFERENCES EstadoNotificacion (idEstadoNotificacion);
ALTER TABLE Notificacion ADD INDEX FKNotificaci897734 (idUsuarioOrigen), ADD CONSTRAINT FKNotificaci897734 FOREIGN KEY (idUsuarioOrigen) REFERENCES Usuario (idUsuario);
ALTER TABLE Notificacion ADD INDEX FKNotificaci71069 (idUsuarioDestino), ADD CONSTRAINT FKNotificaci71069 FOREIGN KEY (idUsuarioDestino) REFERENCES Usuario (idUsuario);
ALTER TABLE Pedido ADD INDEX FKPedido566230 (idUsuarioComprador), ADD CONSTRAINT FKPedido566230 FOREIGN KEY (idUsuarioComprador) REFERENCES Usuario (idUsuario);
ALTER TABLE Pedido ADD INDEX FKPedido243177 (idUsuarioVendedor), ADD CONSTRAINT FKPedido243177 FOREIGN KEY (idUsuarioVendedor) REFERENCES Usuario (idUsuario);
ALTER TABLE HistoricoPedido ADD INDEX FKHistoricoP550832 (idEstadoInicial), ADD CONSTRAINT FKHistoricoP550832 FOREIGN KEY (idEstadoInicial) REFERENCES EstadoPedido (idEstadoPedido);
ALTER TABLE HistoricoPedido ADD INDEX FKHistoricoP956995 (idEstadoFinal), ADD CONSTRAINT FKHistoricoP956995 FOREIGN KEY (idEstadoFinal) REFERENCES EstadoPedido (idEstadoPedido);
ALTER TABLE HistoricoPedido ADD INDEX FKHistoricoP300755 (idPedido), ADD CONSTRAINT FKHistoricoP300755 FOREIGN KEY (idPedido) REFERENCES Pedido (idPedido);
ALTER TABLE LineaPedido ADD INDEX FKLineaPedid342235 (idPedido), ADD CONSTRAINT FKLineaPedid342235 FOREIGN KEY (idPedido) REFERENCES Pedido (idPedido);
ALTER TABLE Transaccion ADD INDEX FKTransaccio806892 (idPedido), ADD CONSTRAINT FKTransaccio806892 FOREIGN KEY (idPedido) REFERENCES Pedido (idPedido);
ALTER TABLE Transaccion ADD INDEX FKTransaccio332699 (idUsuOrigTran), ADD CONSTRAINT FKTransaccio332699 FOREIGN KEY (idUsuOrigTran) REFERENCES Usuario (idUsuario);
ALTER TABLE Transaccion ADD INDEX FKTransaccio589760 (idUsuDesTran), ADD CONSTRAINT FKTransaccio589760 FOREIGN KEY (idUsuDesTran) REFERENCES Usuario (idUsuario);
ALTER TABLE LineaPedido ADD INDEX FKLineaPedid131306 (idComponente), ADD CONSTRAINT FKLineaPedid131306 FOREIGN KEY (idComponente) REFERENCES Componente (idComponente);
ALTER TABLE Componente ADD INDEX FKComponente265412 (idUsuVendedor), ADD CONSTRAINT FKComponente265412 FOREIGN KEY (idUsuVendedor) REFERENCES Usuario (idUsuario);
ALTER TABLE HistoricoSubasta ADD INDEX FKHistoricoS568006 (idSubasta), ADD CONSTRAINT FKHistoricoS568006 FOREIGN KEY (idSubasta) REFERENCES Subasta (idSubasta);
ALTER TABLE HistoricoSubasta ADD INDEX FKHistoricoS758890 (idEstadoIniSub), ADD CONSTRAINT FKHistoricoS758890 FOREIGN KEY (idEstadoIniSub) REFERENCES EstadoSubasta (idEstadoSub);
ALTER TABLE HistoricoSubasta ADD INDEX FKHistoricoS402697 (idEstadoFinSub), ADD CONSTRAINT FKHistoricoS402697 FOREIGN KEY (idEstadoFinSub) REFERENCES EstadoSubasta (idEstadoSub);
ALTER TABLE Subasta ADD INDEX FKSubasta582554 (idUsuCreador), ADD CONSTRAINT FKSubasta582554 FOREIGN KEY (idUsuCreador) REFERENCES Usuario (idUsuario);
ALTER TABLE Puja ADD INDEX FKPuja691949 (idUsuarioPuja), ADD CONSTRAINT FKPuja691949 FOREIGN KEY (idUsuarioPuja) REFERENCES Usuario (idUsuario);
ALTER TABLE Puja ADD INDEX FKPuja13205 (idSubastaPuja), ADD CONSTRAINT FKPuja13205 FOREIGN KEY (idSubastaPuja) REFERENCES Subasta (idSubasta);
ALTER TABLE Comentario ADD INDEX FKComentario375683 (idPedido), ADD CONSTRAINT FKComentario375683 FOREIGN KEY (idPedido) REFERENCES Pedido (idPedido);
ALTER TABLE Comentario ADD INDEX FKComentario306359 (idUsuarioCom), ADD CONSTRAINT FKComentario306359 FOREIGN KEY (idUsuarioCom) REFERENCES Usuario (idUsuario);
ALTER TABLE Componente ADD INDEX FKComponente416733 (idEstadoComp), ADD CONSTRAINT FKComponente416733 FOREIGN KEY (idEstadoComp) REFERENCES EstadoComponente (idEstadoComp);
ALTER TABLE Puja ADD INDEX FKPuja958543 (idEstPuja), ADD CONSTRAINT FKPuja958543 FOREIGN KEY (idEstPuja) REFERENCES EstadoPuja (idEstPuja);
ALTER TABLE Notificacion ADD INDEX FKNotificaci349196 (idEstadoNotificacion), ADD CONSTRAINT FKNotificaci349196 FOREIGN KEY (idEstadoNotificacion) REFERENCES EstadoNotificacion (idEstadoNotificacion);
ALTER TABLE Subasta ADD INDEX FKSubasta542612 (idEstadoSub), ADD CONSTRAINT FKSubasta542612 FOREIGN KEY (idEstadoSub) REFERENCES EstadoSubasta (idEstadoSub);
ALTER TABLE Pedido ADD INDEX FKPedido357609 (idEstadoPedido), ADD CONSTRAINT FKPedido357609 FOREIGN KEY (idEstadoPedido) REFERENCES EstadoPedido (idEstadoPedido);
ALTER TABLE Usuario ADD INDEX FKUsuario832357 (idEstadoUsuario), ADD CONSTRAINT FKUsuario832357 FOREIGN KEY (idEstadoUsuario) REFERENCES EstadoUsuario (idEstadoUsuario);
ALTER TABLE FotoComponente ADD INDEX FKFotoCompon203758 (idCompFoto), ADD CONSTRAINT FKFotoCompon203758 FOREIGN KEY (idCompFoto) REFERENCES Componente (idComponente);
ALTER TABLE Subasta ADD INDEX FKSubasta801261 (idCompSub), ADD CONSTRAINT FKSubasta801261 FOREIGN KEY (idCompSub) REFERENCES Componente (idComponente);

-- Insertar los datos de las tablas descriptivas
-- Tabla EstadoUsuario
INSERT INTO EstadoUsuario (idEstadoUsuario, nombreEstUsu, desEstUsu) VALUES (1, 'HABILITADO', 'El usuario puede autenticarse en la aplicacion');
INSERT INTO EstadoUsuario (idEstadoUsuario, nombreEstUsu, desEstUsu) VALUES (2, 'BAJA', 'El usuario no puede autenticarse en la aplicacion');
-- Tabla EstadoPedido
INSERT INTO EstadoPedido (idEstadoPedido, nombreEstPed, desEstPed) VALUES (1, 'NUEVO', 'El pedido se acaba de crear');
INSERT INTO EstadoPedido (idEstadoPedido, nombreEstPed, desEstPed) VALUES (2, 'EN_TRAMITE', 'El vendedor ha pagado el pedido y esta a la espera de la respuesta del vendedor');
INSERT INTO EstadoPedido (idEstadoPedido, nombreEstPed, desEstPed) VALUES (3, 'RECHAZADO', 'El vendedor cancela la entrega de ese pedido');
INSERT INTO EstadoPedido (idEstadoPedido, nombreEstPed, desEstPed) VALUES (4, 'ACEPTADO', 'El vendedor ha aceptado el pedido y se dispone a enviar el componente');
INSERT INTO EstadoPedido (idEstadoPedido, nombreEstPed, desEstPed) VALUES (5, 'RECIBIDO', 'El comprador indica que ha recibido el componente');
INSERT INTO EstadoPedido (idEstadoPedido, nombreEstPed, desEstPed) VALUES (6, 'RECIBIDO', 'El comprador indica que no ha recibido el componente');
-- Tabla EstadoSubasta
INSERT INTO EstadoSubasta (idEstadoSub, nombreEstSub, desEstSub) VALUES (1, 'CREADA', 'El usuario ha creado la subasta pero aun no ha empezado');
INSERT INTO EstadoSubasta (idEstadoSub, nombreEstSub, desEstSub) VALUES (2, 'EN_PROCESO', 'La subasta esta abierta y los usuarios pueden pujar');
INSERT INTO EstadoSubasta (idEstadoSub, nombreEstSub, desEstSub) VALUES (3, 'FINALIZADA', 'La subasta ha llegado a su fecha de cierre');
INSERT INTO EstadoSubasta (idEstadoSub, nombreEstSub, desEstSub) VALUES (4, 'CANCELADA', 'La subasta ha sido cancelada por el usuario');
INSERT INTO EstadoSubasta (idEstadoSub, nombreEstSub, desEstSub) VALUES (5, 'ABORTADA', 'La subasta ha sido cancelada por el administrador');
-- Tabla EstadoPuja
INSERT INTO EstadoPuja (idEstPuja, nombreEstPuja, desEstPuja) VALUES (1, 'GANADORA', 'La puja es la ganadora de subasta en ese momento');
INSERT INTO EstadoPuja (idEstPuja, nombreEstPuja, desEstPuja) VALUES (2, 'PERDEDORA', 'La puja no es la ganadora de esa subasta');
-- Tabla EstadoComponente
INSERT INTO EstadoComponente (idEstadoComp, nombreEstComp, desEstComp) VALUES (1, 'NUEVO', 'El componente es nuevo');
INSERT INTO EstadoComponente (idEstadoComp, nombreEstComp, desEstComp) VALUES (2, 'USADO', 'El componente esta usado');
-- Tabla EstadoMensaje
INSERT INTO EstadoNotificacion (idEstadoNotificacion, nombreEstNot, desEstNot) VALUES (1, 'NO_LEIDO', 'El mensaje no se ha leido');
INSERT INTO EstadoNotificacion (idEstadoNotificacion, nombreEstNot, desEstNot) VALUES (2, 'LEIDO', 'El mensaje se ha leido');

-- Insertar los datos de inicio
-- Usuario Administrador Por defecto
INSERT INTO `SubastasIU`.`Usuario` (`idUsuario`, `idEstadoUsuario`, `nombre`, `apellidos`, `direccion`, `localidad`, `provincia`, `codigoPostal`, `dni`, `email`, `fechaNacimiento`, `usuario`, `clave`, `cuentaPayPal`, `isAdmin`) VALUES ('0', '1', 'ADMINISTRADOR', 'ADMINISTRADOR', 'Ourense', 'Ourense', 'Ourense', '32004', '36164987Q', 'miguel.callon.alvarez@gmail.com', '2013-11-01', 'root', '9a281eea0823964dfb2915823c248417', '36262626262', '1');

-- DATOS DE PRUEBA
-- Datos de subasta
INSERT INTO `SubastasIU`.`Usuario` (`idUsuario`, `idEstadoUsuario`, `nombre`, `apellidos`, `direccion`, `localidad`, `provincia`, `codigoPostal`, `dni`, `email`, `fechaNacimiento`, `usuario`, `clave`, `cuentaPayPal`, `isAdmin`) VALUES ('1', '1', 'Paco1', 'Paco1', 'Ourense', 'Ourense', 'Ourense', '32004', '36164987Q', 'admin_subatasiu@gmail.com', '2013-11-01', 'usuario1', '9a281eea0823964dfb2915823c248417', '36262626262', '0');
INSERT INTO `SubastasIU`.`Usuario` (`idUsuario`, `idEstadoUsuario`, `nombre`, `apellidos`, `direccion`, `localidad`, `provincia`, `codigoPostal`, `dni`, `email`, `fechaNacimiento`, `usuario`, `clave`, `cuentaPayPal`, `isAdmin`) VALUES ('2', '1', 'Paco2', 'Paco2', 'Ourense', 'Ourense', 'Ourense', '32004', '36164987Q', 'admin_subatasiu@gmail.com', '2013-11-01', 'usuario2', '9a281eea0823964dfb2915823c248417', '36262626262', '0');
INSERT INTO `SubastasIU`.`Usuario` (`idUsuario`, `idEstadoUsuario`, `nombre`, `apellidos`, `direccion`, `localidad`, `provincia`, `codigoPostal`, `dni`, `email`, `fechaNacimiento`, `usuario`, `clave`, `cuentaPayPal`, `isAdmin`) VALUES ('3', '1', 'Paco3', 'Paco3', 'Ourense', 'Ourense', 'Ourense', '32004', '36164987Q', 'admin_subatasiu@gmail.com', '2013-11-01', 'usuario3', '9a281eea0823964dfb2915823c248417', '36262626262', '0');
INSERT INTO `SubastasIU`.`Usuario` (`idUsuario`, `idEstadoUsuario`, `nombre`, `apellidos`, `direccion`, `localidad`, `provincia`, `codigoPostal`, `dni`, `email`, `fechaNacimiento`, `usuario`, `clave`, `cuentaPayPal`, `isAdmin`) VALUES ('4', '1', 'Paco4', 'Paco4', 'Ourense', 'Ourense', 'Ourense', '32004', '36164987Q', 'admin_subatasiu@gmail.com', '2013-11-01', 'usuario4', '9a281eea0823964dfb2915823c248417', '36262626262', '0');
INSERT INTO `SubastasIU`.`Usuario` (`idUsuario`, `idEstadoUsuario`, `nombre`, `apellidos`, `direccion`, `localidad`, `provincia`, `codigoPostal`, `dni`, `email`, `fechaNacimiento`, `usuario`, `clave`, `cuentaPayPal`, `isAdmin`) VALUES ('5', '1', 'Paco5', 'Paco5', 'Ourense', 'Ourense', 'Ourense', '32004', '36164987Q', 'admin_subatasiu@gmail.com', '2013-11-01', 'usuario5', '9a281eea0823964dfb2915823c248417', '36262626262', '0');
INSERT INTO `SubastasIU`.`Usuario` (`idUsuario`, `idEstadoUsuario`, `nombre`, `apellidos`, `direccion`, `localidad`, `provincia`, `codigoPostal`, `dni`, `email`, `fechaNacimiento`, `usuario`, `clave`, `cuentaPayPal`, `isAdmin`) VALUES ('6', '1', 'Paco6', 'Paco6', 'Ourense', 'Ourense', 'Ourense', '32004', '36164987Q', 'admin_subatasiu@gmail.com', '2013-11-01', 'usuario6', '9a281eea0823964dfb2915823c248417', '36262626262', '0');

-- Datos de pedido
INSERT INTO `SubastasIU`.`Pedido` (`idPedido`, `idEstadoPedido`, `idUsuarioComprador`, `idUsuarioVendedor`, `fechaEnvio`, `fechaAlta`, `fechaActualizacion`, `total`) VALUES ('1', '1', '1', '2', '2013-11-01', '2013-11-01', '2013-11-01', '20');
INSERT INTO `SubastasIU`.`Pedido` (`idPedido`, `idEstadoPedido`, `idUsuarioComprador`, `idUsuarioVendedor`, `fechaEnvio`, `fechaAlta`, `fechaActualizacion`, `total`) VALUES ('2', '2', '1', '2', '2013-11-01', '2013-11-01', '2013-11-02', '25');
INSERT INTO `SubastasIU`.`Pedido` (`idPedido`, `idEstadoPedido`, `idUsuarioComprador`, `idUsuarioVendedor`, `fechaEnvio`, `fechaAlta`, `fechaActualizacion`, `total`) VALUES ('3', '3', '1', '2', '2013-11-01', '2013-11-01', '2013-11-03', '35');
INSERT INTO `SubastasIU`.`Pedido` (`idPedido`, `idEstadoPedido`, `idUsuarioComprador`, `idUsuarioVendedor`, `fechaEnvio`, `fechaAlta`, `fechaActualizacion`, `total`) VALUES ('4', '4', '1', '2', '2013-11-04', '2013-11-01', '2013-11-01', '30');

-- Datos del componente
INSERT INTO `SubastasIU`.`Componente` (`idComponente`, `idUsuVendedor`, `idEstadoComp`, `nombreComp`, `desBreveComp`, `desComp`, `precio`, `unidadesStock`) VALUES ('1', '2', '1', 'Componente1', 'descripcion breve1', 'descripcion extensa 1', '10', '10');
INSERT INTO `SubastasIU`.`Componente` (`idComponente`, `idUsuVendedor`, `idEstadoComp`, `nombreComp`, `desBreveComp`, `desComp`, `precio`, `unidadesStock`) VALUES ('2', '2', '2', 'Componente1', 'descripcion breve2', 'descripcion extensa 2', '10', '30');

-- Fotos de los componentes
INSERT INTO `SubastasIU`.`FotoComponente` (`idFotoComp`, `idCompFoto`, `tituloFoto`, `descripcionFoto`, `ruta`, `isPrincipal`) VALUES ('1', '1', 'foto1', 'foto1', '/componentes/1_0.jpg', '1');
INSERT INTO `SubastasIU`.`FotoComponente` (`idFotoComp`, `idCompFoto`, `tituloFoto`, `descripcionFoto`, `ruta`, `isPrincipal`) VALUES ('2', '1', 'foto2', 'foto2', '/componentes/1_1.jpg', '0');
INSERT INTO `SubastasIU`.`FotoComponente` (`idFotoComp`, `idCompFoto`, `tituloFoto`, `descripcionFoto`, `ruta`, `isPrincipal`) VALUES ('3', '1', 'foto3', 'foto3', '/componentes/1_2.jpg', '0');
INSERT INTO `SubastasIU`.`FotoComponente` (`idFotoComp`, `idCompFoto`, `tituloFoto`, `descripcionFoto`, `ruta`, `isPrincipal`) VALUES ('4', '2', 'foto4', 'foto4', '/componentes/2_0.jpg', '1');
INSERT INTO `SubastasIU`.`FotoComponente` (`idFotoComp`, `idCompFoto`, `tituloFoto`, `descripcionFoto`, `ruta`, `isPrincipal`) VALUES ('5', '2', 'foto5', 'foto5', '/componentes/2_1.jpg', '0');
INSERT INTO `SubastasIU`.`FotoComponente` (`idFotoComp`, `idCompFoto`, `tituloFoto`, `descripcionFoto`, `ruta`, `isPrincipal`) VALUES ('6', '2', 'foto6', 'foto6', '/componentes/2_2.jpg', '0');

-- Datos de las lineas
INSERT INTO `SubastasIU`.`LineaPedido` (`idLineaPedido`, `idPedido`, `idComponente`, `precioLinea`, `numUnidades`) VALUES ('1', '1', '2', '20', '5');
INSERT INTO `SubastasIU`.`LineaPedido` (`idLineaPedido`, `idPedido`, `idComponente`, `precioLinea`, `numUnidades`) VALUES ('2', '2', '2', '30', '10');
INSERT INTO `SubastasIU`.`LineaPedido` (`idLineaPedido`, `idPedido`, `idComponente`, `precioLinea`, `numUnidades`) VALUES ('3', '3', '2', '40', '15');
INSERT INTO `SubastasIU`.`LineaPedido` (`idLineaPedido`, `idPedido`, `idComponente`, `precioLinea`, `numUnidades`) VALUES ('4', '4', '2', '50', '20');

-- Datos de subasta
INSERT INTO `SubastasIU`.`Subasta` (`idSubasta`, `idUsuCreador`, `idEstadoSub`, `idCompSub`, `numCompSub`, `titulo`, `descripcionBreve`, `descripcion`, `fechaCierre`, `fechaApertura`, `fechaCreacion`, `precioInicial`, `idFotoComp`, `tituloFotoSub`, `desFotoSub`, `rutaFotoSub`) VALUES ('1', '2', '1', '1', '5', 'Subasta prueba1', 'Descripcion breve de prueba', 'Descripcion extensa', '2013-11-10', '2013-11-11', '2013-11-10', '334', NULL, 'mifoto', 'mifoto descripcion', '/subastas/1.jpg');
INSERT INTO `SubastasIU`.`Subasta` (`idSubasta`, `idUsuCreador`, `idEstadoSub`, `idCompSub`, `numCompSub`, `titulo`, `descripcionBreve`, `descripcion`, `fechaCierre`, `fechaApertura`, `fechaCreacion`, `precioInicial`, `idFotoComp`, `tituloFotoSub`, `desFotoSub`, `rutaFotoSub`) VALUES ('2', '2', '2', '1', '5', 'Subasta prueba1', 'Descripcion breve de prueba', 'Descripcion extensa', '2013-11-10', '2013-11-11', '2013-11-10', '334', NULL, 'mifoto', 'mifoto descripcion', '/subastas/2.jpg');
INSERT INTO `SubastasIU`.`Subasta` (`idSubasta`, `idUsuCreador`, `idEstadoSub`, `idCompSub`, `numCompSub`, `titulo`, `descripcionBreve`, `descripcion`, `fechaCierre`, `fechaApertura`, `fechaCreacion`, `precioInicial`, `idFotoComp`, `tituloFotoSub`, `desFotoSub`, `rutaFotoSub`) VALUES ('3', '2', '3', '1', '5', 'Subasta prueba1', 'Descripcion breve de prueba', 'Descripcion extensa', '2013-11-10', '2013-11-11', '2013-11-10', '334', NULL, 'mifoto', 'mifoto descripcion', '/subastas/3.jpg');
INSERT INTO `SubastasIU`.`Subasta` (`idSubasta`, `idUsuCreador`, `idEstadoSub`, `idCompSub`, `numCompSub`, `titulo`, `descripcionBreve`, `descripcion`, `fechaCierre`, `fechaApertura`, `fechaCreacion`, `precioInicial`, `idFotoComp`, `tituloFotoSub`, `desFotoSub`, `rutaFotoSub`) VALUES ('4', '2', '4', '1', '5', 'Subasta prueba1', 'Descripcion breve de prueba', 'Descripcion extensa', '2013-11-10', '2013-11-11', '2013-11-10', '334', NULL, 'mifoto', 'mifoto descripcion', '/subastas/4.jpg');


-- Datos de puja
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('1', '2', '3', '1', '50', '2013-11-01');
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('2', '2', '3', '2', '40', '2013-11-01');
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('3', '2', '3', '2', '30', '2013-11-01');
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('4', '2', '3', '2', '20', '2013-11-01');
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('5', '2', '3', '2', '10', '2013-11-01');
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('6', '3', '4', '1', '50', '2013-11-01');
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('7', '3', '4', '2', '40', '2013-11-01');
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('8', '3', '4', '2', '30', '2013-11-01');
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('9', '3', '4', '2', '20', '2013-11-01');
INSERT INTO `SubastasIU`.`Puja` (`idPuja`, `idSubastaPuja`, `idUsuarioPuja`, `idEstPuja`, `cantPujada`, `fechaPuja`) VALUES ('10', '3', '4', '2', '10', '2013-11-01');

-- Datos de Notificacion
INSERT INTO `SubastasIU`.`Notificacion` (`idNotificacion`, `idEstadoNotificacion`, `idUsuarioOrigen`, `idUsuarioDestino`, `textoNot`, `asuntoNot`, `fechaEnvioNot`, `fechaLecturaNot`) VALUES ('1', '1', '0', '1', 'cuerpo del mensaje', 'asunto del mensaje', '2013-11-11', '2013-11-10');
INSERT INTO `SubastasIU`.`Notificacion` (`idNotificacion`, `idEstadoNotificacion`, `idUsuarioOrigen`, `idUsuarioDestino`, `textoNot`, `asuntoNot`, `fechaEnvioNot`, `fechaLecturaNot`) VALUES ('2', '2', '0', '1', 'cuerpo del mensaje', 'asunto del mensaje', '2013-11-11', '2013-11-10');
INSERT INTO `SubastasIU`.`Notificacion` (`idNotificacion`, `idEstadoNotificacion`, `idUsuarioOrigen`, `idUsuarioDestino`, `textoNot`, `asuntoNot`, `fechaEnvioNot`, `fechaLecturaNot`) VALUES ('3', '1', '0', '1', 'cuerpo del mensaje', 'asunto del mensaje', '2013-11-11', '2013-11-10');
INSERT INTO `SubastasIU`.`Notificacion` (`idNotificacion`, `idEstadoNotificacion`, `idUsuarioOrigen`, `idUsuarioDestino`, `textoNot`, `asuntoNot`, `fechaEnvioNot`, `fechaLecturaNot`) VALUES ('4', '2', '0', '1', 'cuerpo del mensaje', 'asunto del mensaje', '2013-11-11', '2013-11-10');
INSERT INTO `SubastasIU`.`Notificacion` (`idNotificacion`, `idEstadoNotificacion`, `idUsuarioOrigen`, `idUsuarioDestino`, `textoNot`, `asuntoNot`, `fechaEnvioNot`, `fechaLecturaNot`) VALUES ('5', '1', '0', '1', 'cuerpo del mensaje', 'asunto del mensaje', '2013-11-11', '2013-11-10');
INSERT INTO `SubastasIU`.`Notificacion` (`idNotificacion`, `idEstadoNotificacion`, `idUsuarioOrigen`, `idUsuarioDestino`, `textoNot`, `asuntoNot`, `fechaEnvioNot`, `fechaLecturaNot`) VALUES ('6', '2', '0', '2', 'cuerpo del mensaje', 'asunto del mensaje', '2013-11-11', '2013-11-10');
INSERT INTO `SubastasIU`.`Notificacion` (`idNotificacion`, `idEstadoNotificacion`, `idUsuarioOrigen`, `idUsuarioDestino`, `textoNot`, `asuntoNot`, `fechaEnvioNot`, `fechaLecturaNot`) VALUES ('7', '1', '0', '3', 'cuerpo del mensaje', 'asunto del mensaje', '2013-11-11', '2013-11-10');
INSERT INTO `SubastasIU`.`Notificacion` (`idNotificacion`, `idEstadoNotificacion`, `idUsuarioOrigen`, `idUsuarioDestino`, `textoNot`, `asuntoNot`, `fechaEnvioNot`, `fechaLecturaNot`) VALUES ('8', '2', '0', '4', 'cuerpo del mensaje', 'asunto del mensaje', '2013-11-11', '2013-11-10');

