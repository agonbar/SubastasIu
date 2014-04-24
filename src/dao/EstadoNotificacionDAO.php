<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL
 * de la entidad EstadoNotificacion
 * @author Almudena Novoa
 */
class EstadoNotificacionDAO extends MysqlDAO implements IEstadoNotificacionDAO {
	/**
	 * Metodo que convierte un registro de una notificacion de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de EstadoNotificacion de base de datos.
	 * @param $estadoNotificacionBean un objeto de tipo estado notificacion.
	 * @author Almudena Novoa
	 */
	public function fila2EstadoNotificacionBean ($fila, EstadoNotificacionBean $estadoNotificacionBean) {
		$estadoNotificacionBean->setIdEstadoNotificacion($fila["idEstadoNotificacion"]);
		$estadoNotificacionBean->setNombreEstNot($fila["nombreEstNot"]);
		$estadoNotificacionBean->setDesEstNot($fila["desEstNot"]);
	}
}
?>