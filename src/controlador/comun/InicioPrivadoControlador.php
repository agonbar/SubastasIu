<?php
//namespace controlador;

/**
 * Clase controladora de inicio de la parte privada
 * @author Miguel Callon
 */
class InicioPrivadoControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrar":
				include (HTML_PRIVADA_PATH."/inicio.php");
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>