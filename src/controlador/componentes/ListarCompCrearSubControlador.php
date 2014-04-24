<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Listar componentes
 * @author Nuria Canle
 */
class ListarCompCrearSubControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "listarComponentes":
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, null, $max, null);
						
				// Busqueda
				$busquedaComponentesBean = new BusquedaComponentesBean();
				$idUsuVendedor = Session::get(ID_USUARIO_CONECTADO_KEY);
				$busquedaComponentesBean->setIdUsuVendedor($idUsuVendedor);
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_COMPONENTES_BEAN, $busquedaComponentesBean);		
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaComponentes = array();
				try {
					//desde este objeto se llama al metodo listarComponentes
					$fachada->listarComponentes($busquedaComponentesBean,
							$listaComponentes, $paginadoBean);
					//a la fachada se le pasa el objeto paginadoBean
					include (HTML_PRIVADA_COMPONENTES_PATH."/compListadosCrearSub.php");
				} catch (CompDatosFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMPONENTES_PATH."/errorListandoComp.php");
				}
				break;
			case "buscarComponentes":
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, null, $max, null);
						
				// Busqueda
				// Obtenemos de la sesion los datos de la busqueda
				$busquedaComponentesBean = Session::get(BUSQUEDA_COMPONENTES_BEAN);
				// Si no existe un objeto busquedaComponentesBean lo creamos
				if (!isset($busquedaComponentesBean)) {
					$busquedaComponentesBean = new BusquedaComponentesBean();
				}
				$busquedaComponentesBean->setNombre($_REQUEST["nombre"]);
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_COMPONENTES_BEAN, $busquedaComponentesBean);		
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaComponentes = array();
				try {
					//desde este objeto se llama al metodo listarComponentes
					$fachada->listarComponentes($busquedaComponentesBean,
						$listaComponentes, $paginadoBean);
					//a la fachada se le pasa el objeto paginadoBean
					include (HTML_PRIVADA_COMPONENTES_PATH."/compListadosCrearSub.php");
				} catch (CompDatosFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMPONENTES_PATH."/errorListandoComp.php");
				}
				break;
			
			
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>