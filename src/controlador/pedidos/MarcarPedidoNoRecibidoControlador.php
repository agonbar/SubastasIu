<?php
 
//namespace controlador;

/**
 * Clase controladora del caso de uso Marcar Pedido No Recibido
 * @author Santiago Iglesias
 */
class MarcarPedidoNoRecibidoControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		echo "ejecutar accion: $accion";
		switch($accion) {
						
			case "marcarPedidoNoRecibido":						
				// Obtengo el idPedido de la request
				$idPedido = $_REQUEST["idPedido"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada->marcarPedidoNoRecibido($idPedido);
					include (HTML_PRIVADA_PEDIDOS_PATH."/pedidoMarcadoNoRecibido.php");
				} catch (MarcarPedidoRecibidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorMarcandoPedidoNoRecibido.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
 
 
 
 
?>