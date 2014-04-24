<?php
 
//namespace controlador;
/**
 * Clase controladora del caso de uso Consultar Componente
 * @author Nuria Canle
 */
class ConsultarComponenteControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "consultarComponente":
				// Obtengo el idComponente del componente a consultar
				$idComponente = $_REQUEST["idComponente"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				//para poder llamar al metodo consultarComponente
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$compBean=new ComponenteBean();
					$fachada->consultarComponente($idComponente, $compBean);
					
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
					
					include (HTML_PRIVADA_COMPONENTES_PATH."/componenteConsultado.php");

				} catch (ConsultarComponenteFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMPONENTES_PATH."/errorConsultarComponente.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}