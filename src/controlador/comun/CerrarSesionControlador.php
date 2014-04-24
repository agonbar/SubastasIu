<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso CerrarSesion
 * @author Miguel Callon
 */
class CerrarSesionControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Cuando el usuario selecciona "Cerrar Sesi�n", velve a la 	 
	 * pantalla de inicio de la aplicaci�n y destruye la sesi�n.
	 * @param $accion accion que el usuario desea realizar
 	 * @author Nuria Canle
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "cerrar":
				Session::set(IS_AUTENTICADO_KEY, false);
				session_destroy();
				header('Location: ./index.php');
				break;
			default:
				echo "accionNoEncontrada";
		}
	}
}
?>