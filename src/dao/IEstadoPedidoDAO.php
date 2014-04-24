<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionado con la entidad
 * correspondiente.
 * @author Miguel Callon
 */
interface IEstadoPedidoDAO extends IDAO {
	/**
	 * Metodo que obtiene un EstadoUsuario de base de datos pasandole
	 * un EstadoUsuarioBean con el idEstadoUsuario.
	 * @param $idEstadoUsuario Identificador del estado de usuario
	 * @param $estadoUsuarioBean objeto de la base de datos que tiene los
	 * datos de un estado usuario.
	 * @author Miguel Callon
	 */
	public function consultarEstadoPedido($idEstadoPedido, 
										   EstadoPedidoBean $estadoPedidoBean);
}
?>