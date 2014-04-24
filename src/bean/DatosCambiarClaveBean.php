<?php

/**
 * Clase que almacena los datos del formulario de cambio de clave del usuario
 * @author Miguel Callon
 */
class DatosCambiarClaveBean {
	var $claveActual;
	var $claveNueva;
	var $repetirClave;
	
	public function __construct() {
		
	}
	/**
	 * Obtiene la clave actual del usuario
	 * @author Miguel Callon
	 */	
	public function getClaveActual() {
		return $this->claveActual;
	}
	/**
	 * Asigna la clave actual del usuario
	 * @author Miguel Callon
	 */
	public function setClaveActual($claveActual) {
		$this->claveActual = $claveActual;
	}
	
	/**
	 * Obtiene la clave nueva del usuario 
	 * @author Miguel Callon
	 */	
	public function getClaveNueva() {
		return $this->claveNueva;
	}
	/**
	 * Asigna la clave actual del usuario
	 * @author Miguel Callon
	 */
	public function setClaveNueva($claveNueva) {
		$this->claveNueva = $claveNueva;
	}
	/**
	 * Obtiene si el envio se va a realizar con los datos
	 * por defecto o usando los datos de envio nuevos
	 * @author Miguel Callon
	 */	
	public function getRepetirClave() {
		return $this->repetirClave;
	}
	/**
	 * Asigna si el envio se va a realizar con los datos
	 * por defecto o usando los datos de envio nuevos
	 * @author Miguel Callon
	 */
	public function setRepetirClave($repetirClave) {
		$this->repetirClave = $repetirClave;
	}
	/**
	 * Metodo que muestra las propiedades del objeto en una cadena
	 * de texto
	 * @author Miguel Callon
	 */
	public function __toString() {		
		return "DatosCambiarClaveBean: claveActual = $this->claveActual,".
			   "claveNueva = $this->claveNueva,".
			   "repetirClave = $this->repetirClave,";
	}
}
?>