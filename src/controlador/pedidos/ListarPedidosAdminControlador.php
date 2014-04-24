<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Listar Pedidos
 * @author Santiago Iglesias
 */
class ListarPedidosAdminControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			
			case "listarPedidos":
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				// Asignamos los campos por los que podemos filtrar
				$camposOrden = array("idPedido" => "ordenacion.id",
					"fechaEnvio" => "ordenacion.fechaEnvio",
					"usuario" => "ordenacion.usuario",
					"nombreEstPed" => "ordenacion.nombreEstPed");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaPedidosBean = new BusquedaPedidosBean();
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_PEDIDOS_BEAN, $busquedaPedidosBean);
				
				// La factoria devuelve un objeto factoria de la fachada administrador
				$fachada = FactoriaFachada::getAdminFachada();
				$listaPedidos= array();
				try {
					$fachada->listarPedidos($busquedaPedidosBean, $listaPedidos, $paginadoBean);
					include (HTML_ADMIN_PEDIDOS_PATH."/pedidosListadosAdmin.php");
				} catch (GeneralException $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_PEDIDOS_PATH."/errorListandoPedidosAdmin.php");
				} 
				break;
			
				
			case "buscarPedidos":
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("idPedido" => "ordenacion.id",
					"fechaEnvio" => "ordenacion.fechaEnvio",
					"usuario" => "ordenacion.usuario",
					"nombreEstPed" => "ordenacion.nombreEstPed");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				// Obtenemos de la sesion los datos de la busqueda
				$busquedaPedidosBean = Session::get(BUSQUEDA_PEDIDOS_BEAN);
				// Si no existe un objeto busquedaPedidosBean lo creamos
				if (!isset($busquedaPedidosBean)) {
					$busquedaPedidosBean = new BusquedaPedidosBean();
				}
				// Recogemos los parametros de la request
				$busquedaPedidosBean->setIdPedido($_REQUEST["idPedido"]);
				$busquedaPedidosBean->setEstadoPedido($_REQUEST["estadoPedido"]);
				$busquedaPedidosBean->setFechaCompraIni($_REQUEST["fechaCompraIni"]);
				$busquedaPedidosBean->setFechaCompraFin($_REQUEST["fechaCompraFin"]);
				$busquedaPedidosBean->setFechaActualizacionIni($_REQUEST["fechaActualizacionIni"]);
				$busquedaPedidosBean->setFechaActualizacionFin($_REQUEST["fechaActualizacionFin"]);
				$busquedaPedidosBean->setUsuarioVendedor($_REQUEST["usuarioVendedor"]);
				$busquedaPedidosBean->setUsuarioComprador($_REQUEST["usuarioComprador"]);
				
				// Almacenamos en la sesion la busqueda
				Session::set(BUSQUEDA_PEDIDOS_BEAN, $busquedaPedidosBean);
				
				// La factoria devuelve un objeto factoria de la fachada administrador
				$fachada = FactoriaFachada::getAdminFachada();
				$listaPedidos= array();
				try {
					
					$fachada->listarPedidos($busquedaPedidosBean, $listaPedidos, $paginadoBean);
						include (HTML_ADMIN_PEDIDOS_PATH."/pedidosListadosAdmin.php");
					}
				 catch (GeneralException $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_PEDIDOS_PATH."/errorListandoPedidosAdmin.php");
				}	
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>