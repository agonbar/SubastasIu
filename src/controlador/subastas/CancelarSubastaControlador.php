<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso CancelarSubasta
 * @author Miguel Callon
 */
class CancelarSubastaControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "cancelarSubasta":
				$idSubasta = $_REQUEST["idSubasta"];
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$subastaBean = new SubastaBean();
					$idUsuConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
					$fachada->cancelarSubasta($idSubasta, $idUsuConectado);
					
					include (HTML_PRIVADA_SUBASTAS_PATH."/subastaCancelada.php");
				} catch (CancelarSubastaFacEx $ex) {
					echo "error:".$ex->getMessage();
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorCancelandoSubasta.php");
				}
				
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>