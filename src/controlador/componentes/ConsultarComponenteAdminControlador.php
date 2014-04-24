<?php
 
//namespace controlador;
/**
 * Clase controladora del caso de uso Consultar Componente
 * @author Santiago Iglesias
 */
class ConsultarComponenteAdminControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			
				case "consultarComponente":
				// Obtengo el id del componente a consultar
				$listaIdComponente = $_REQUEST["idOption"];
				
				if(count($listaIdComponente)==1){
					
					// La factoria devuelve un objeto factoria de la fachada administrador
					//para poder llamar al metodo consultarComponente
					$fachada = FactoriaFachada::getAdminFachada();
					try {
						$compBean=new ComponenteBean();
						$fachada->consultarComponente($listaIdComponente[0], $compBean);
						
						// Obtenemos el numero de fotos
						$listaFotosComp = $compBean->getListaFotos();
						$listaFotos = array();
						if (isset($listaFotosComp)) {
							foreach ($listaFotosComp as $foto) {
								if ($foto->getTituloFoto() != "") {
									$listaFotos[count($listaFotos)] = $foto;
								}
							}
						}
						
						include (HTML_ADMIN_COMPONENTES_PATH."/componenteConsultadoAdmin.php");
	
					} catch (ConsultarComponenteFacEx $ex) {
					
						$ERRORES_FORM = $ex->getErrores();
						include (HTML_ADMIN_COMPONENTES_PATH."/errorSeleccionandoComponenteAdmin.php");
					}
				}else{
					
					include (HTML_ADMIN_COMPONENTES_PATH . "/errorConsultarComponenteAdmin.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}