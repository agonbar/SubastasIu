<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL.
 * @author Almudena Novoa
 */
class NotificacionDAO extends MysqlDAO implements INotificacionDAO {
	
	/**
	 * Convierte una fila de base de datos
	 * @param $fila Tupla de base de datos
	 * @param $notificacion Objeto de tipo NotificacionBean
	 * @author Almudena Novoa
	 */
	public function fila2NotificacionBean($fila, NotificacionBean $notificacionBean) {
		$notificacionBean -> setIdNotificacion($fila["idNotificacion"]);
		$notificacionBean -> setIdEstadoNotificacion($fila["idEstadoNotificacion"]);		
		$notificacionBean -> setIdUsuarioOrigen($fila["idUsuarioOrigen"]);
		$notificacionBean -> setIdUsuarioDestino($fila["idUsuarioDestino"]);
		$notificacionBean -> setTextoNot($fila["textoNot"]);
		$notificacionBean -> setAsuntoNot($fila["asuntoNot"]);
		$notificacionBean -> setFechaEnvioNot($fila["fechaEnvioNot"]);
		$notificacionBean -> setFechaLecturaNot($fila["fechaLecturaNot"]);
	}	
	
	/**
	 * Marca una notificacion como leida
	 * @param $idNotificacion id de la notificacion
	 * @author Miguel Callon
	 */
	public function marcarNotificacionLeida($idNotificacion) {
		$fechaHoy = new DateTime("now");
		$sql = "update Notificacion set idEstadoNotificacion = ".ESTADO_NOTIFICACION_LEIDO.",
				fechaLecturaNot = '".$fechaHoy -> format('Y-m-d H:i:s')."'
				where idNotificacion = ".$idNotificacion;		
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
		} catch (Exception $ex) {
			throw new MarcarNotificacionLeidaDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Inserta una notificacion
	 * @param $notificacionBean Una clase NotificacionBean
	 * @author Miguel Callon
	 */
	public function insertarNotificacion(NotificacionBean $notificacionBean) {
		$fechaHoy = new DateTime("now");
		$sql = "insert into Notificacion (idEstadoNotificacion, idUsuarioOrigen, idUsuarioDestino,
								  textoNot, asuntoNot, fechaEnvioNot, fechaLecturaNot) 
								  VALUES (
								  '".ESTADO_NOTIFICACION_NO_LEIDO."', '".$notificacionBean->getIdUsuarioOrigen()."',
								  '".$notificacionBean->getIdUsuarioDestino()."', '".$notificacionBean->getTextoNot()."',
								  '".$notificacionBean->getAsuntoNot()."', '".$fechaHoy -> format('Y-m-d H:i:s')."',
								  '".$notificacionBean->getFechaLecturaNot()."');";
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
		} catch (Exception $ex) {
			throw new InsertarNotificacionDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que devuelve el numero de mensajes que quedan sin leer
	 * para un usuario dado
	 * @param $idUsuario del usuario del que se consultan sus mensajes
	 * @return numero de mensajes sin leer
	 * @author Miguel Callon
	 */
	public function consultarNumNotificacionesSinLeer($idUsuario) {
		$sql = "select count(*) as total from Notificacion n 
				where idEstadoNotificacion = ".ESTADO_NOTIFICACION_NO_LEIDO.
				" and n.idUsuarioDestino = ".$idUsuario;
		//echo $sql;
		try {
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ConsultarNumNotificacionesDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($cursor);
			
			return $fila["total"];
		} catch (Exception $ex) {
			throw new ConsultarNumNotificacionesDAOEx($ex -> getMessage());
		}
		return 0;
	}
	
	/**
	 * Lista las notificaciones de la base de datos
	 * @param $busquedaNotificacionesBean Objeto con la informacion de busqueda
	 * @param &$listaNotificaciones coleccion de notificaciones.
	 * @param $paginadoBean informacion de paginado.
	 * @author Miguel Callon
	 */
	public function listarNotificaciones(BusquedaNotificacionesBean $busquedaNotificacionesBean,
								   &$listaNotificaciones, PaginadoBean $paginadoBean) {
		$filtro = "1 = 1
				   and idUsuarioDestino = '".$busquedaNotificacionesBean->getIdUsuarioDestino()."'";
				   
		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total, idNotificacion, idEstadoNotificacion, idUsuarioOrigen,
				idUsuarioDestino, textoNot, asuntoNot, fechaEnvioNot, fechaLecturaNot,
				origen.usuario as usuarioOrigen, destino.usuario as usuarioDestino
				from Notificacion n
				inner join Usuario origen on n.idUsuarioOrigen = origen.idUsuario
				inner join Usuario destino on n.idUsuarioDestino = destino.idUsuario
			where $filtro";
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarNotificacionesDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($cursor);
			
			// Ahora obtemos el numero de elementos del cursor
			// y lo ponemos el paginadoBean
			$paginadoBean->setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ListarNotificacionesDAOEx($ex -> getMessage());
		}
		
		// Consulta mysql. Ojo con el limit
		$sql = "select idNotificacion, idEstadoNotificacion, idUsuarioOrigen, idUsuarioDestino,
				textoNot, asuntoNot, fechaEnvioNot, fechaLecturaNot,
				origen.usuario as usuarioOrigen, destino.usuario as usuarioDestino
				from Notificacion n
				inner join Usuario origen on n.idUsuarioOrigen = origen.idUsuario
				inner join Usuario destino on n.idUsuarioDestino = destino.idUsuario
				where $filtro
				order by ".$paginadoBean->getCampoOrdenSelec()."
				limit ".$paginadoBean->getInicioPagSQL().",".$paginadoBean->getNumElemPag();	
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarComponentesDAOEx(mysql_error());
			}
			
			// Ahora recorremos el array y vamos guardando cada fila en
			// un objeto subastaBean.
			while ($fila = mysql_fetch_assoc($cursor)) {
				$notificacionBean = new NotificacionBean();
				$this->fila2NotificacionBean($fila, $notificacionBean);
				
				$usuarioOrigen = new UsuarioBean();
				$usuarioOrigen->setIdUsuario($fila["idUsuarioOrigen"]);
				$usuarioOrigen->setUsuario($fila["usuarioOrigen"]);
				$notificacionBean->setUsuarioOrigen($usuarioOrigen);
				
				$usuarioDestino = new UsuarioBean();
				$usuarioDestino->setIdUsuario($fila["idUsuarioDestino"]);
				$usuarioDestino->setUsuario($fila["usuarioDestino"]);
				$notificacionBean->setUsuarioOrigen($usuarioDestino);
				
				$listaNotificaciones[count($listaNotificaciones)] = $notificacionBean;
			}
		} catch (Exception $ex) {
			throw new ListarComponentesDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que obtiene una notificacion de la base de datos pasandole un NotificacionBean
	 * con el id de la notificaion que se quiere consultar.
	 * @param $idNotificacion identificador de la notificacion
	 * @param $notificacionBean NotificacionBean con los datos de la notificacion
	 * @author Almudena Novoa
	 */
	public function consultarNotificacion($idNotificacion, NotificacionBean $notificacionBean) {
		if (!isset($idNotificacion)) {
			throw new ConsultarNotificacionDAOEx("Id notificacion no especificado");
		}
		//se seleccionan de la BD los datos usados para construir NotificacionBean
		$sql = "select idNotificacion, idEstadoNotificacion, idUsuarioOrigen, idUsuarioDestino,
				textoNot, asuntoNot, fechaEnvioNot, fechaLecturaNot,
				origen.usuario as usuarioOrigen, destino.usuario as usuarioDestino
				from Notificacion n
				inner join Usuario origen on n.idUsuarioOrigen = origen.idUsuario
				inner join Usuario destino on n.idUsuarioDestino = destino.idUsuario
				where idNotificacion = ".$idNotificacion;
		try {
			//se cargan los datos de la notificacion
			$consulta = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
			if (mysql_num_rows($consulta) > 0) {
				$fila = mysql_fetch_assoc($consulta);
				$this -> fila2NotificacionBean($fila, $notificacionBean);
				
				$usuarioOrigen = new UsuarioBean();
				$usuarioOrigen->setIdUsuario($fila["idUsuarioOrigen"]);
				$usuarioOrigen->setUsuario($fila["usuarioOrigen"]);
				$notificacionBean->setUsuarioOrigen($usuarioOrigen);
				
				$usuarioDestino = new UsuarioBean();
				$usuarioDestino->setIdUsuario($fila["idUsuarioDestino"]);
				$usuarioDestino->setUsuario($fila["usuarioDestino"]);
				$notificacionBean->setUsuarioOrigen($usuarioDestino);
			} else {
				throw new ConsultarNotificacionDAOEx("Notificacion no encontrada");
			}
		} catch (Exception $ex) {
			throw new ConsultarNotificacionDAOEx($ex -> getMessage());
		}
	}
	
	
}
?>