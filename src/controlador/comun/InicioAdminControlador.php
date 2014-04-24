<?php
//namespace controlador;

/**
 * Clase controladora de inicio de la parte privada
 * @author Miguel Callon
 */
class InicioAdminControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrar":
				include (HTML_ADMIN_PATH."/inicio.php");
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>