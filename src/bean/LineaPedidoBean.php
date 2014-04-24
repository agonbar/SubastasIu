<?php
 /**
 * Clase que almacena los datos de una linea de pedido.
 * @author Santiago Iglesias
 */
class LineaPedidoBean {
	var $idLineaPedido;
	var $idPedido;
	var $idComponente;
	var $componente;
	var $vendedor;
	var $unidades;
	var $precioUnidad;
	var $totalLinea;
	
	public function __construct(){
	}
	public function getIdLineaPedido() {
		return $this->idLineaPedido;
	}
	public function setIdLineaPedido($idLineaPedido) {
		$this->idLineaPedido = $idLineaPedido;
	}
	/**
	 * Obtiene el id del pedido
	 * @return $idPedido id del pedido
	 * @author Miguel Callon
	 */
	public function getIdPedido() {
		return $this->idPedido;
	}
	/**
	 * Asigna el id del pedido
	 * @param $idPedido id del pedido
	 * @author Miguel Callon
	 */
	public function setIdPedido($idPedido) {
		$this->idPedido = $idPedido;
	}
	public function getIdComponente() {
		return $this->idComponente;
	}
	public function setIdComponente($idComponente) {
		$this->idComponente = $idComponente;
	}
	public function getComponente() {
		return $this->componente;
	}
	public function setComponente($componente) {
		$this->componente = $componente;
	}
	
	public function getPrecioUnidad() {
		return $this->precioUnidad;
	}
	public function setPrecioUnidad($precioUnidad) {
		$this->precioUnidad = $precioUnidad;
	}
	public function getPrecioTotal() {
		return ($this->precioUnidad * $this->unidades);
	}
	public function getVendedor() {
		return $this->vendedor;
	}
	public function setVendedor($vendedor) {
		$this->vendedor = $vendedor;
	}
	
	public function getUnidades() {
		return $this->unidades;
	}
	public function setUnidades($unidades) {
		$this->unidades = $unidades;
	}
	/**
	 * Obtener el total de la linea
	 * @author Miguel Callon
	 */
	public function getTotalLinea() {
		return $this->unidades * $this->precioUnidad;
	}
	
	public function __toString() {
		return "LineaPedidoBean: id:".$this->idLineaPedido.
			 ", Nombre".$this->idComponente.
			 ",Unidades".$this->unidades.
			 ", Precio Unidad:.".$this->precioUnidad.
			 ", Vendedor:.".$this->vendedor.
			 ", Precio Total:.".$this->getPrecioTotal();
	}
}

?>