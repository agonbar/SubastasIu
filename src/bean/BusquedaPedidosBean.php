<?php

/**
 * Clase que almacena los datos de la busqueda de un pedido.
 * @author Miguel Callon
 */
class BusquedaPedidosBean {
	var $idPedido;
	var $fechaCompraIni;
	var $fechaCompraFin;
	var $fechaActualizacionIni;
	var $fechaActualizacionFin;
	var $idEstadoPedido;
	var $usuarioVendedor;
	var $usuarioComprador;
	var $listado;
	var $estado;
	/**
	 * Constructor de la clase
	 * @author Miguel Callon
	 */
	public function __construct() {
	}
	/**
	 * Obtiene el identificador del pedido
	 * @author Miguel Callon
	 */
	public function getIdPedido() {
		return $this->idPedido;
	}
	/**
	 * Asigna el identificador del pedido
	 * @author Miguel Callon
	 */
	public function setIdPedido($idPedido) {
		$this->idPedido = $idPedido;		
	}
	/**
	 * Obtiene la fecha de compra inicial
	 * @author Miguel Callon
	 */
	public function getFechaCompraIni() {
		return $this->fechaCompraIni;
	}
	/**
	 * Asigna la fecha de compra inicial
	 * @author Miguel Callon
	 */
	public function setFechaCompraIni($fechaCompraIni) {
		$this->fechaCompraIni = $fechaCompraIni;		
	}
	/**
	 * Obtiene la fecha de compra final
	 * @author Miguel Callon
	 */
	public function getFechaCompraFin() {
		return $this->fechaCompraFin;
	}
	/**
	 * Asigna la fecha de compra final
	 * @author Miguel Callon
	 */
	public function setFechaCompraFin($fechaCompraFin) {
		$this->fechaCompraFin = $fechaCompraFin;		
	}
	/**
	 * Obtiene la fecha de actualizacion inicial
	 * @author Miguel Callon
	 */
	public function getFechaActualizacionIni() {
		return $this->fechaActualizacionIni;
	}
	/**
	 * Asigna la fecha de actualizacion inicial
	 * @author Miguel Callon
	 */
	public function setFechaActualizacionIni($fechaActualizacionIni) {
		$this->fechaActualizacionIni = $fechaActualizacionIni;		
	}
	/**
	 * Obtiene la fecha de actualizacion final
	 * @author Miguel Callon
	 */
	public function getFechaActualizacionFin() {
		return $this->fechaActualizacionFin;
	}
	/**
	 * Asigna la fecha de actualizacion final
	 */
	public function setFechaActualizacionFin($fechaActualizacionFin) {
		$this->fechaActualizacionFin = $fechaActualizacionFin;		
	}
	/**
	 * Obtiene el identificador del estado pedido
	 * @author Miguel Callon
	 */
	public function getIdEstadoPedido() {
		return $this->idEstadoPedido;
	}
	/**
	 * Asigna el identificador del estado pedido
	 * @author Miguel Callon
	 */
	public function setIdEstadoPedido($idEstadoPedido) {
		$this->idEstadoPedido = $idEstadoPedido;		
	}
	/**
	 * Obtiene el usuario del vendedor
	 * @author Miguel Callon
	 */
	public function getUsuarioVendedor() {
		return $this->usuarioVendedor;
	}
	/**
	 * Asigna el usuario del vendedor
	 * @author Miguel Callon
	 */
	public function setUsuarioVendedor($usuarioVendedor) {
		$this->usuarioVendedor = $usuarioVendedor;		
	}
	/**
	 * Obtiene el tipo de listado 
	 * @author Santiago Iglesias
	 */
	public function getListado() {
		return $this->listado;
	}
	/**
	 * Asigna el tipo de listado
	 * @author Santiago Iglesias
	 */
	public function setListado($listado) {
		$this->listado = $listado;		
	}
	
	
	/**
	 * Obtiene el usuario del comprador
	 * @author Santiago Iglesias
	 */
	public function getUsuarioComprador() {
		return $this->usuarioComprador;
	}
	/**
	 * Asigna el usuario del comprador
	 * @author Santiago Iglesias
	 */
	public function setUsuarioComprador($usuarioComprador) {
		$this->usuarioComprador = $usuarioComprador;		
	}
	/**
	 * Obtiene el nombre del estado del pedido
	 * @author Santiago Iglesias
	 */
	public function getEstadoPedido() {
		return $this->estado;
	}
	/**
	 * Asigna el nombre del estado del pedido
	 * @author Santiago Iglesias
	 */
	public function setEstadoPedido($estado) {
		$this->estado = $estado;		
	}
	
	/**
	 * Pasa el objeto a una cadena de texto
	 * @author Miguel Callon
	 */
	public function __toString() {
		return "EstadoUsuarioBean: idPedido  = $this->idPedido,".
			   "fechaCompraIni = $this->fechaCompraIni,".
			   "fechaCompraFin = $this->fechaCompraFin,".
			   "fechaActualizacionIni = $this->fechaActualizacionIni,".
			   "fechaActualizacionFin = $this->fechaActualizacionFin,".
			   "idEstadoPedido = $this->idEstadoPedido,".
			   "nombreVendedor = $this->usuarioVendedor";
	}
}
?>