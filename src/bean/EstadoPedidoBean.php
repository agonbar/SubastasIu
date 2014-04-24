<?php

/**
 * Clase que almacena los datos del estado del pedido.
 * @author Miguel Callon
 */
class EstadoPedidoBean {
	var $idEstadoPedido;
	var $nombre;
	var $descripcion;
	/**
	 * Constructor de la clase
	 * @author Miguel Callon
	 */
	public function __construct() {
	}
	
	/**
	 * Obtiene el atributo idEstadoPedido
	 * @return $idEstadoPedido Identificador del estado de pedido.
	 * @author Miguel Callon
	 */
	public function getIdEstadoPedido() {
		return $this->idEstadoPedido;
	}
	/**
	 * Asigna el atributo idEstadoPedido
	 * @param $idEstadoPedido identificador del estado de pedido.
	 * @author Miguel Callon
	 */
	public function setIdEstadoPedido($idEstadoPedido) {
		$this->idEstadoPedido = $idEstadoPedido;
	}
	/**
	 * Obtiene el atributo nombre.
	 * @return $nombre Nombre del estado.
	 * @author Miguel Callon
	 */
	public function getNombre() {
		return $this -> nombre;
	}
	/**
	 * Asigna el atributo nombre.
	 * @param $nombre Nombre del estado.
	 * @author Miguel Callon
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	/**
	 * Obtiene la descripcion del estado.
	 * @return $descripcion Descripcion del estado.
	 * @author Miguel Callon
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
	/**
	 * Asigna la descripcion del estado.
	 * @param $descripcion Descripcion del estado.
	 * @author Miguel Callon
	 */
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}
	
	public function __toString() {
		return "EstadoUsuarioBean: idEstadoPedido  = $this->idEstadoPedido,".
			   "nombre = $this->nombre,".
			   "descripcion = $this->descripcion" ;
	}
}
?>