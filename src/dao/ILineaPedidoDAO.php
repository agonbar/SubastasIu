<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionado con la entidad
 * correspondiente.
 * @author Miguel Callon
 */
interface ILineaPedidoDAO extends IDAO {
	/**
	 * Inserta una linea de pedido en base de datos
	 * @param $lineaPedido Linea del pedido
	 * @author Miguel Callon
	 */
	public function insertarLineaPedido(LineaPedidoBean $lineaPedido);
	
	/**
	 * Consulta la lineaPedidoBean pasandole el identificador.
	 * @param $idPedido Identificador del pedido
	 * @param $lineasPedido coleccion de objeto de la clase LineaPedidoBean
	 * @author Miguel Callon
	 */
	public function consultarLineasPedidoPorPedido($idPedido, &$lineasPedido);
}
	
?>