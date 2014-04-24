<?php

/**
 * Clase que almacena los datos de un usuario.
 * @author Miguel Callon
 */
class DatosPagoBean {
	var $cuentaOrigen;
	var $cuentaDestino;
	var $tipoEnvio;
	var $direccionEnvio;
	var $localidadEnvio;
	var $provinciaEnvio;
	var $importe;
	
	public function __construct() {
		
	}
	/**
	 * Obtiene si el envio se va a realizar con los datos
	 * por defecto o usando los datos de envio nuevos
	 * @author Miguel Callon
	 */	
	public function getTipoEnvio() {
		return $this->tipoEnvio;
	}
	/**
	 * Asigna si el envio se va a realizar con los datos
	 * por defecto o usando los datos de envio nuevos
	 * @author Miguel Callon
	 */
	public function setTipoEnvio($tipoEnvio) {
		$this->tipoEnvio = $tipoEnvio;
	}
	/**
	 * Obtiene la cuenta origen de pago
	 */	
	public function getCuentaOrigen() {
		return $this->cuentaOrigen;
	}
	/**
	 * Asigna la cuenta destino del pago
	 */
	public function setCuentaOrigen($cuentaOrigen) {
		$this->cuentaOrigen = $cuentaOrigen;
	}
	/**
	 * Obtiene la cuenta destino de pago
	 */	
	public function getCuentaDestino() {
		return $this->cuentaDestino;
	}
	/**
	 * Asigna la cuenta destino del pago
	 */
	public function setCuentaDestino($cuentaDestino) {
		$this->cuentaDestino = $cuentaDestino;
	}
	/**
	 * Obtiene la direccion de envio
	 * @author Miguel Callon
	 */
	public function getDireccionEnvio() {
		return $this->direccionEnvio;
	}
	/**
	 * Asigna la direccion de envio
	 * @author Miguel Callon
	 */
	public function setDireccionEnvio($direccionEnvio) {
		$this->direccionEnvio = $direccionEnvio;
	}
	/**
	 * Obtiene la localidad de envio
	 * @author Miguel Callon
	 */
	public function getLocalidadEnvio() {
		return $this->localidadEnvio;
	}
	/**
	 * Asigna la localidad de envio
	 * @author Miguel Callon
	 */
	public function setLocalidadEnvio($localidadEnvio) {
		$this->localidadEnvio = $localidadEnvio;
	}
	/**
	 * Obtiene la provincia de envio
	 * @author Miguel Callon
	 */
	public function getProvinciaEnvio() {
		return $this->provinciaEnvio;
	}
	/**
	 * Asigna la provincia de envio
	 * @author Miguel Callon
	 */
	public function setProvinciaEnvio($provinciaEnvio) {
		$this->provinciaEnvio = $provinciaEnvio;
	}
	/**
	 * Obtiene el importe del pedido
	 * @author Miguel Callon
	 */
	public function getImporte() {
		return $this->importe;
	}
	/**
	 * Asigna el importe del pedido
	 * @author Miguel Callon
	 */
	public function setImporte($importe) {
		$this->importe = $importe;
	}
	/**
	 * Metodo que muestra las propiedades del objeto en una cadena
	 * de texto
	 * @author Miguel Callon
	 */
	public function __toString() {		
		return "DatosPagoBean: cuentaOrigen = $this->cuentaOrigen,".
			   "tipoEnvio = $this->tipoEnvio,".
			   "direccionEnvio = $this->direccionEnvio,".
			   "localidadEnvio = $this->localidadEnvio".
			   "provinciaEnvio = $this->provinciaEnvio";
	}
}
?>