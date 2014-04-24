<?php


//namespace controlador;

/**
 * Clase controladora creada para facilitar la implementacion de la vista
 * @author Miguel Callon
 */
class CambiarEstadoPedidoControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {	
			case "cambiarEstado":
				// Recogemos los parametros
				$nuevoEstado = $_REQUEST["nuevoEstado"];
				$idPedido = $_REQUEST["idPedido"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$pedidoBean = new PedidoBean();
					$fachada->consultarPedido($idPedido, $pedidoBean);
		
					if ($nuevoEstado == ESTADO_PEDIDO_ACEPTADO) {
						$fachada->aceptarPedido($idPedido);
						include (HTML_PRIVADA_PEDIDOS_PATH."/pedidoAceptado.php");
					} elseif ($nuevoEstado == ESTADO_PEDIDO_RECHAZADO) {
						$fachada->rechazarPedido($idPedido);
						include (HTML_PRIVADA_PEDIDOS_PATH."/pedidoRechazado.php");
					} elseif ($nuevoEstado == ESTADO_PEDIDO_RECIBIDO) {
						$fachada->marcarPedidoRecibido($idPedido);
						include (HTML_PRIVADA_PEDIDOS_PATH."/pedidoMarcadoRecibido.php");
					} elseif ($nuevoEstado == ESTADO_PEDIDO_NO_RECIBIDO) {
						$fachada->marcarPedidoNoRecibido($idPedido);
						include (HTML_PRIVADA_PEDIDOS_PATH."/pedidoMarcadoNoRecibido.php");
					} else {
						include (HTML_PRIVADA_PEDIDOS_PATH."/errorCambiarEstadoPedido.php");
					}
				} catch (ConsultarPedidoFacEx $ex) {
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorConsultarPedido.php");
				} catch (MarcarPedidoNoRecibidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorCambiarEstadoPedido.php");
				} catch (MarcarPedidoRecibidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorCambiarEstadoPedido.php");
				} catch (AceptarPedidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorCambiarEstadoPedido.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}

   
   
   




?>