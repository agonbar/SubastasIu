<?php
/**
 * Clase generica de excepcion de la aplicacion.
 * @author Miguel Callon
 */
class GeneralException extends Exception {
	private $errores;
	public function setErrores($errores) {
		$this->errores = $errores;
	}
	public function getErrores() {
		return $this->errores;
	}
}
?>