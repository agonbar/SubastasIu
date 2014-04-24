<?php


//namespace controlador;

/**
 * Clase controladora del caso de uso Realizar Pago
 * @author Miguel Callon
 */
class RealizarPagoControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			// Mostrar formulario pago de pedido
			case "mostrarFormularioPagoCarrito": 
				$carritoBean = Session::get(CARRITO_BEAN_KEY);
				$usuarioComprador = Session::get(USUARIO_CONECTADO_KEY);
				
				include (HTML_PRIVADA_PEDIDOS_PATH."/formularioPagoCarrito.php");
				break;
			// Mostrar formulario pago de pedido
			case "mostrarFormularioPagoPedido": 
				// Obtengo el idPedido de la request
				$idPedido = $_REQUEST["idPedido"];
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$pedidoBean = new PedidoBean();
					$fachada->consultarPedido($idPedido, $pedidoBean);
					include (HTML_PRIVADA_PEDIDOS_PATH."/formularioPagoPedido.php");
				} catch (ConsultarPedidoFacEx $ex) {
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorConsultarPedido.php");
				}
				break;
			case "realizarPagoCarrito":
				$cuenta = $_REQUEST["cuenta"];
				$tipoEnvio = $_REQUEST["tipoEnvio"];
				$carritoBean = new CarritoBean();

				// La factoria devuelve un objeto factoria de la fachada privada
				//para poder llamar al metodo consultarCarrito
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {					
					// Sacamos de nuevo el carrito de session
					$carritoBean = Session::get("CARRITO_BEAN_KEY");
					
					//Listamos su contenido
					$lineasPedido = $carritoBean->getListaComponentes();
					foreach ($lineasPedido as $lineaPedido) {
						$pedidoBean = new PedidoBean();
						$pedidoBean->setIdUsuarioComprador(
								Session::get(ID_USUARIO_CONECTADO_KEY));
						$pedidoBean->setIdUsuarioVendedor(
									$lineaPedido->getVendedor()->getIdUsuario());
						$pedidoBean->setLineasPedido(array($lineaPedido));
						$fachada -> crearPedido($pedidoBean);
						
						$datosPagoBean = new DatosPagoBean();
						$datosPagoBean->setCuentaOrigen($cuenta);
						if ($tipoEnvio != TIPO_ENVIO_DEFAULT) {
							$datosPagoBean->setDireccionEnvio($_REQUEST["direccion"]);
							$datosPagoBean->setLocalidadEnvio($_REQUEST["localidad"]);
							$datosPagoBean->setProvinciaEnvio($_REQUEST["direccion"]);
						} else {
							$usuarioBean = Session::get(USUARIO_CONECTADO_KEY);
							$datosPagoBean->setDireccionEnvio($usuarioBean->getDireccion());
							$datosPagoBean->setLocalidadEnvio($usuarioBean->getLocalidad());
							$datosPagoBean->setProvinciaEnvio($usuarioBean->getProvincia());
						}
						$fachada->realizarPagoPedido($pedidoBean->getIdPedido(), $datosPagoBean);
					}	
					// Vacio el carrito de la session
					Session::set(CARRITO_BEAN_KEY, new CarritoBean());
					include (HTML_PRIVADA_PEDIDOS_PATH."/pagoRealizado.php");
				} catch (CrearPedidoFacEx $ex) {
					$ERRORES_FORM = $ex -> getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/formularioPagoPedido.php");
				}
				
				break;
			case "realizarPagoPedido":
				// Obtengo el idPedido de la request
				$idPedido = $_REQUEST["idPedido"];
				$cuenta = $_REQUEST["cuenta"];
				$tipoEnvio = $_REQUEST["tipoEnvio"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$pedidoBean = new PedidoBean();
					$fachada->consultarPedido($idPedido, $pedidoBean);
					
					$datosPagoBean = new DatosPagoBean();
					$datosPagoBean->setCuentaOrigen($cuenta);
					if ($tipoEnvio != TIPO_ENVIO_DEFAULT) {
						$datosPagoBean->setDireccionEnvio($_REQUEST["direccion"]);
						$datosPagoBean->setLocalidadEnvio($_REQUEST["localidad"]);
						$datosPagoBean->setProvinciaEnvio($_REQUEST["direccion"]);
					} else {
						$usuarioBean = Session::get(USUARIO_CONECTADO_KEY);
						$datosPagoBean->setDireccionEnvio($usuarioBean->getDireccion());
						$datosPagoBean->setLocalidadEnvio($usuarioBean->getLocalidad());
						$datosPagoBean->setProvinciaEnvio($usuarioBean->getProvincia());
					}
					$fachada->realizarPagoPedido($idPedido, $datosPagoBean);
					include (HTML_PRIVADA_PEDIDOS_PATH."/pagoRealizado.php");
				} catch (ConsultarPedidoFacEx $ex) {
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorConsultarPedido.php");
				} catch (RealizarPagoDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/formularioPagoPedido.php");
				} catch (RealizarPagoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorRealizarPago.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}

   
   
   




?>