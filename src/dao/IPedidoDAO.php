<?php
/**
 * Clase que almacena los datos de una subasta.
 * @author Santiago Iglesias
 */
 
 interface IPedidoDAO extends IDAO {
 	/**
	 * Crear pedido
	 * @param $pedidoBean datos del pedido
	 * @author Miguel Callon
	 */
	public function crearPedido(PedidoBean $pedidoBean);
	
	/**
	 * Metodo que obtiene un pedido pasando un PedidoBean con el id del pedido
	 * que se quiere consultar.
	 * @param $idPedido identificador del pedido a consultar
	 * @param $pedidoBean PedidoBean con los datos del pedido
	 * @author Santiago Iglesias
	 */
	public function consultarPedido($idPedido, PedidoBean $pedidoBean);

	/**
	 * Metodo que cambia el estado de un pedido a enviado
	 * @param $idPedido identificador del pedido
	 * @author Miguel Callon
	 */
	public function marcarPedidoEnTramite($idPedido);

	/**
	 * Lista los pedidos de la base de datos
	 * @param &$listaPedidos coleccion de pedidos
	 * @param $paginadoBean informacion de paginado.
	 * @author Santiago Iglesias
	 */
	public function listarPedidos(BusquedaPedidosBean $busquedaPedido, 
								   &$listaPedidos, PaginadoBean $paginadoBean);
}
?>