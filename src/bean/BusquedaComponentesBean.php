<?php

/**
 * Clase que almacena los datos de la busqueda de un componente.
 * @author Miguel Callon
 */
class BusquedaComponentesBean {
	var $nombre;
	var $nombreV;
	var $idUsuVendedor;
	var $precio;
	
	/**
	 * Constructor de la clase
	 * @author Miguel Callon
	 */
	public function __construct() {
	}
	
	/**
	 * Obtiene el nombre
	 * @author Miguel Callon
	 */
	public function getUsuarioVendedor() {
		return $this->nombreV;
	}
	/**
	 * Asigna el nombre
	 * @author Miguel Callon
	 */
	public function setUsuarioVendedor($nombreV) {
		$this->nombreV = $nombreV;		
	}
	
	/**
	 * Obtiene el nombre
	 * @author Miguel Callon
	 */
	public function getNombre() {
		return $this->nombre;
	}
	/**
	 * Asigna el nombre
	 * @author Miguel Callon
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;		
	}
	
	/**
	 * Obtiene el precio
	 * @author Santiago Iglesias
	 */
	public function getPrecio() {
		return $this->precio;
	}
	/**
	 * Asigna el precio
	 * @author Santiago Iglesias
	 */
	public function setPrecio($precio) {
		$this->precio = $precio;		
	}
	
	/**
	 * Obtiene el id del vendedor
	 * @author Miguel Callon
	 */
	public function getIdUsuVendedor() {
		return $this->idUsuVendedor;
	}
	/**
	 * Asigna el id del vendedor
	 * @author Miguel Callon
	 */
	public function setIdUsuVendedor($idUsuVendedor) {
		$this->idUsuVendedor = $idUsuVendedor;		
	}
	/**
	 * Pasa el objeto a una cadena de texto
	 * @author Miguel Callon
	 */
	public function __toString() {
		return "BusquedaComponentesBean: nombre  = ".$this->nombre.
			", idUsuVendedor  = ".$this->idUsuVendedor;
	}
}
?>