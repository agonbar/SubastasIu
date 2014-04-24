<?php
/**
 * Clase que almacena los datos de una puja.
 * @author Miguel Callon
 */
 
 interface IPujaDAO extends IDAO {
 	/**
	 * Pujar en una subasta
	 * @param $idPuja Identificador de la puja
	 * @author Miguel Callon
	 */
	public function marcarPujaPerdedora($idPuja);
 	/**
	 * Pujar en una subasta
	 * @param $idPedido Identificador del pedido
	 * @param $lineasPedido coleccion de objeto de la clase LineaPedidoBean
	 * @param $paginadoBean Datos del paginado
	 * @param PujarDAOEx Excepcion cuando el idSubasta no esta especificado
	 * @author Miguel Callon
	 */
	public function insertarPuja($idSubasta, PujaBean $puja);
	
	/**
	 * Obtener la puja ganadora de una subasta
	 * @param $idSubasta Identificador de la subasta
	 * @param $pujaBean Puja ganadora
	 * @throws ConsultarLineaPujaDAOEx si el idSubasta no esta especificado
	 * @author Miguel Callon
	 */
	public function consultarPujaGanadoraSubasta($idSubasta,
											 PujaBean $pujaBean);
	
 	/**
	 * Obtener las pujas de un pedido
	 * @param $idPedido Identificador del pedido
	 * @param $lineasPedido coleccion de objeto de la clase LineaPedidoBean
	 * @param $paginadoBean Datos del paginado
	 * @author Miguel Callon
	 */
	public function consultarPujasPorSubasta($idSubasta, &$lineasPuja,
											 PaginadoBean $paginadoBean);
	/**
	 * Metodo que convierte una puja de base de datos
	 * en una objeto PujaBean.
	 * @param $fila una tupla de PujaBean de base de datos.
	 * @param $pujaBean un objeto de tipo PujaBean.
	 * @author Miguel Callon
	 */
	public function fila2PujaBean ($fila, PujaBean $pujaBean);
}
?>