<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso CambiarIdioma
 * @author Miguel Callon
 */
class CambiarIdiomaControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "cambiar":	
				$locale = $_REQUEST["idioma"];
				Session::set(LOCALE_KEY, $locale);
				header('Location: ./index.php');
				break;
			default:
				echo "accionNoEncontrada";
		}
	}
}
?>