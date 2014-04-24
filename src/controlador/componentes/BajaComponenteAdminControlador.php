<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso baja componente
 * @author Santiago Iglesias
 */
class BajaComponenteAdminControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			
				case "bajaComponente":
				$listaIdComponente = $_REQUEST["idOption"];
				
				$fachada = FactoriaFachada::getAdminFachada();
							
				try {
					
					foreach ($listaIdComponente as $idComponente) {
						echo $idComponente;					
					$fachada->bajaComponente($idComponente);	
					echo $idComponente;
					}				
					include (HTML_ADMIN_COMPONENTES_PATH."/bajaComponenteAdmin.php");
					
				} catch (CompDatIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_COMPONENTES_PATH."/errorDatosComponenteAdmin.php");				
				}
					catch (BajaComponenteFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_COMPONENTES_PATH."/errorBajaComponenteAdmin.php");
				}		
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>