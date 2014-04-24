<?php
   

//namespace controlador;

/**
 * Clase controladora de la pagina de inicio
 * @author Miguel Callon
 */
class ComoFuncionaControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrar":
				include (HTML_PUBLICA_PATH."/comoFunciona.php");
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}

   
   
   
   
   
  
   
   
?>