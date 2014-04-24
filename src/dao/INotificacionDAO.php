<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionados con componentes.
 * @author Almudena Novoa
 */
interface INotificacionDAO extends IDAO {
	/**
	 * Marca una notificacion como leida
	 * @param $idNotificacion id de la notificacion
	 * @author Miguel Callon
	 */
	public function marcarNotificacionLeida($idNotificacion);
	
	/**
	 * Inserta una notificacion
	 * @param $notificacionBean Una clase NotificacionBean
	 * @author Miguel Callon
	 */
	public function insertarNotificacion(NotificacionBean $notificacionBean);
	
	/**
	 * Metodo que devuelve el numero de mensajes que quedan sin leer
	 * para un usuario dado
	 * @param $idUsuario del usuario del que se consultan sus mensajes
	 * @return numero de mensajes sin leer
	 * @author Miguel Callon
	 */
	public function consultarNumNotificacionesSinLeer($idUsuario);
	
	/**
	 * Lista las notificaciones de la base de datos
	 * @param $busquedaNotificacionesBean Objeto con la informacion de busqueda
	 * @param &$listaNotificaciones coleccion de notificaciones.
	 * @param $paginadoBean informacion de paginado.
	 * @author Miguel Callon
	 */
	public function listarNotificaciones(BusquedaNotificacionesBean $busquedaNotificacionesBean,
								   &$listaNotificaciones, PaginadoBean $paginadoBean);
	
	/**
	 * Metodo que obtiene una notificacion de la base de datos pasandole un NotificacionBean
	 * con el id de la notificaion que se quiere consultar.
	 * @param $idNotificacion identificador de la notificacion
	 * @param $notificacionBean NotificacionBean con los datos de la notificacion
	 * @author Almudena Novoa
	 */
	public function consultarNotificacion($idNotificacion, NotificacionBean $notificacionBean);	
}
?>