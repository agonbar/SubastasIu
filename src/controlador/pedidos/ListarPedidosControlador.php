<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Listar Pedidos
 * @author Santiago Iglesias
 */
class ListarPedidosControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			
					
			case "listarPedidosEnviados":
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
				//Obtenemos el id del usuario
				$idUsuConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaPedidos= array();
				try {
					$fachada->listarPedidosEnviados($busquedaPedidosBean, $listaPedidos, $paginadoBean,$idUsuConectado);
					include (HTML_PRIVADA_PEDIDOS_PATH."/pedidosEnviadosListados.php");
				} catch (GeneralException $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorListandoPedidos.php");
				} 
				break;
				
			case "listarPedidosRecibidos":
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
				//Obtenemos el id del usuario
				$idUsuConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaPedidos= array();
				try {
					$fachada->listarPedidosRecibidos($busquedaPedidosBean, $listaPedidos, $paginadoBean,$idUsuConectado);
					include (HTML_PRIVADA_PEDIDOS_PATH."/pedidosRecibidosListados.php");
				} catch (GeneralException $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorListandoPedidos.php");
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
				$busquedaPedidosBean = new BusquedaPedidosBean();
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
				
				!isset($_REQUEST["usuarioVendedor"])?$busquedaPedidosBean->setUsuarioVendedor(""):$busquedaPedidosBean->setUsuarioVendedor($_REQUEST["usuarioVendedor"]);
				!isset($_REQUEST["usuarioComprador"])?$busquedaPedidosBean->setUsuarioComprador(""):$busquedaPedidosBean->setUsuarioComprador($_REQUEST["usuarioComprador"]);
				$busquedaPedidosBean->setListado($_REQUEST["listado"]);
				// Almacenamos en la sesion la busqueda
				Session::set(BUSQUEDA_PEDIDOS_BEAN, $busquedaPedidosBean);
				//Obtenemos el id del usuario
				$idUsuConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaPedidos= array();
				
				try {
					if($busquedaPedidosBean->getListado()=="enviados"){
					$fachada->listarPedidosEnviados($busquedaPedidosBean, $listaPedidos, $paginadoBean,$idUsuConectado);
					
					include (HTML_PRIVADA_PEDIDOS_PATH."/pedidosEnviadosListados.php");
					}else{
						
						$fachada->listarPedidosRecibidos($busquedaPedidosBean, $listaPedidos, $paginadoBean,$idUsuConectado);
						include (HTML_PRIVADA_PEDIDOS_PATH."/pedidosRecibidosListados.php");
					}
				} catch (GeneralException $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorListandoPedidos.php");
				}
				 
				break;	
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>