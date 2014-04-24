<?php
 
//namespace controlador;

/**
 * Clase controladora del caso de uso Marcar Pedido Recibido
 * @author Santiago Iglesias
 */
class MarcarPedidoRecibidoControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		echo "ejecutar accion: $accion";
		switch($accion) {
						
			case "marcarPedidoRecibido":						
				// Obtengo el idPedido de la request
				$idPedido = $_REQUEST["idPedido"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada->marcarPedidoRecibido($idPedido);
					include (HTML_PRIVADA_PEDIDOS_PATH."/pedidoMarcadoRecibido.php");
				} catch (MarcarPedidoRecibidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorMarcandoPedidoRecibido.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
 
 
 
 
?>