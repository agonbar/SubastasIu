<?php
//namespace controlador;

/**
 * Clase controladora utilizada para poner un fichero multiidioma
 * @author Miguel Callon
 */
class ParsearFicheroControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrar":
				$path = RUTA_RECURSOS_HTML_DIR.$_REQUEST["path"];
				
				
				//http://192.168.31.129/subastasiu/index.php?controlador=ParsearFicheroControlador&accion=mostrar&path=/js/funcionesValidar.js
				//http://192.168.31.129/subastasiu/index.php?index.php?controlador=ParsearFicheroControlador&accion=%22%22&path=/js/funcionesValidar.js
				
				include ($path);
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>