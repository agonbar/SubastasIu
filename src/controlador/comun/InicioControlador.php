<?php
//namespace controlador;

/**
 * Clase controladora de inicio de la parte privada
 * @author Miguel Callon
 */
class InicioControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrar":
				$orden="idSubasta";
				$paginadoBean = new PaginadoBean(1, $orden, 20, null);
				$camposOrden = array("idPedido" => "ordenacion.id",
					"fechaEnvio" => "ordenacion.fechaEnvio",
					"usuario" => "ordenacion.usuario",
					"nombreEstPed" => "ordenacion.nombreEstPed");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaSubastasBean = new BusquedaSubastasBean();
				// Ojo solo mostramos las abiertas y las cerradas
				$busquedaSubastasBean->setIdEstadosSubasta(array(ESTADO_SUBASTA_EN_PROCESO, 
															ESTADO_SUBASTA_FINALIZADA));
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_SUBASTAS_BEAN, $busquedaSubastasBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaSubastas= array();
				try {
					$fachada->listarSubastas($busquedaSubastasBean, $listaSubastas, $paginadoBean);
					include (HTML_PUBLICA_PATH."/inicio.php");
				} catch (SubDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PUBLICA_PATH."/inicio.php");
				}
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>