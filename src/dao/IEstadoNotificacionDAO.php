<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionado con la entidad
 * correspondiente.
 * @author Almudena Novoa
 */
interface IEstadoNotificacionDAO extends IDAO {
	/**
	 * Metodo que convierte un registro de usuario de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de Estado notificacion de base de datos.
	 * @param $estadoNotificacionBean un objeto de tipo estadoNotificacion.
	 * @author Almudena Novoa
	 */
	public function fila2EstadoNotificacionBean ($fila, EstadoNotificacionBean $estadoNotificacionBean);
}
?>