<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Pujar
 * @author Miguel Callon
 */
class PujarControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "pujar":
				$pujaBean = new PujaBean();
				$idSubasta = $_REQUEST["idSubasta"];
				$pujaBean->setCantPujada($_REQUEST["cantPujada"]);
				$pujaBean->setIdUsuarioPuja(Session::get(ID_USUARIO_CONECTADO_KEY));
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada->pujar($idSubasta, $pujaBean);
						
					include (HTML_PRIVADA_SUBASTAS_PATH."/pujaRealizada.php");
				} catch (CantidadPujadaIncorrectaFacEx $ex) {
					//echo "CantidadPujadaIncorrectaFacEx";
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorCuantiaPuja.php");
				} catch (PujarFacEx $ex) {
					echo $ex->getMessage();
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorPujando.php");
				} catch (PujaDatosIncFacEx $ex) {
					echo $ex->getMessage();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorCuantiaPuja.php");
				}
				
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>