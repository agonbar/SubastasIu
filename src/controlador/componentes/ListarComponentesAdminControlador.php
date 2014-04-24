<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Listar componentes
 * @author Santiago Iglesias
 */
class ListarComponentesAdminControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
	* Muestra un listado con los componentes a la venta en un momento determinado
	* @param $accion accion que el usuario desea realizar
	* @author Nuria Canle
	*/
	protected function ejecutar($accion) {
		switch($accion) {
						
			
		
			case "listarComponentes":
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, null, $max, null);
				$camposOrden = array("nombreComp" => "ordenacion.nombre",
					"usuario" => "ordenacion.usuario",
					"desBreve" => "ordenacion.descripcionBreve",
					"precio" => "ordenacion.precio");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaComponentesBean = new BusquedaComponentesBean();
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_COMPONENTES_BEAN, $busquedaComponentesBean);		
				
				// La factoria devuelve un objeto factoria de la fachada admin
				$fachada = FactoriaFachada::getAdminFachada();
				$listaComponentes = array();
				try {
					//desde este objeto se llama al metodo listarComponentes
					$fachada->listarComponentes($busquedaComponentesBean,$listaComponentes, $paginadoBean);
					//a la fachada se le pasa el objeto paginadoBean
					include (HTML_ADMIN_COMPONENTES_PATH."/compListadosAdmin.php");
				} catch (CompDatosFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_COMPONENTES_PATH."/errorListandoComp.php");
				}
				break;
		
			
				case "buscarComponentes":
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, null, $max, null);
				$camposOrden = array("nombreComp" => "ordenacion.nombre",
					"usuario" => "ordenacion.usuario",
					"desBreve" => "ordenacion.descripcionBreve",
					"precio" => "ordenacion.precio");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				// Obtenemos de la sesion los datos de la busqueda
				$busquedaComponentesBean = Session::get(BUSQUEDA_COMPONENTES_BEAN);
				// Si no existe un objeto busquedaComponentesBean lo creamos
				if (!isset($busquedaComponentesBean)) {
					$busquedaComponentesBean = new BusquedaComponentesBean();
				}
				$busquedaComponentesBean->setNombre($_REQUEST["nombre"]);
				$busquedaComponentesBean->setUsuarioVendedor($_REQUEST["vendedor"]);
				$busquedaComponentesBean->setPrecio($_REQUEST["precio"]);
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_COMPONENTES_BEAN, $busquedaComponentesBean);
				
				// La factoria devuelve un objeto factoria de la fachada admin
				$fachada = FactoriaFachada::getAdminFachada();
				$listaComponentes = array();
				try {
					//desde este objeto se llama al metodo listarComponentes
					$fachada->listarComponentes($busquedaComponentesBean,
						$listaComponentes, $paginadoBean);
					//a la fachada se le pasa el objeto paginadoBean
					include (HTML_ADMIN_COMPONENTES_PATH."/compListadosAdmin.php");
				} catch (CompDatosFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_COMPONENTES_PATH."/errorListandoComp.php");
				}
				break;
			
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>