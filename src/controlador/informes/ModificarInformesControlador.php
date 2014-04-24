<?php
    //namespace controlador;

/**
 * Clase controladora del caso de uso modificar informes.
 * @author Nuria Canle
 */
class ModificarInformesControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	protected function ejecutar($accion) {
		switch($accion) {					
			case "modificarInformes":
				// Comprobamos si es admin
				$this->isAutenticadoAdmin();
				$fechaInf = $_REQUEST["fecha"];
				// La factoria devuelve un objeto factoria de la fachada administrador
				$fachada = FactoriaFachada::getAdminFachada();
				try {
					$idUsuConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
					// Modificar informe
					$fachada->modificarInforme($fechaInf, $idUsuConectado);
					include (HTML_ADMIN_INFORMES_PATH."/informeModificado.php");
				} catch (ModificarInformeFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_INFORMES_PATH."/errorModificandoInforme.php");
				}
				
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>