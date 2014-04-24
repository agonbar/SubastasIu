<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso baja componente
 * @author Adrián González
 */
class BajaComponenteControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "bajaComponente":
				$idComponente = $_REQUEST["idComponente"];
				
				$fachada = FactoriaFachada::getPrivadaFachada();
							
				try {
					$fachada->bajaComponente($idComponente);					
					include (HTML_PRIVADA_COMPONENTES_PATH."/bajaComponente.php");
					
				} catch (CompDatIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMPONENTES_PATH."/errorDatosComponente.php");				
				}
					catch (BajaComponenteFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMPONENTES_PATH."/errorBajaComponente.php");
				}		
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>