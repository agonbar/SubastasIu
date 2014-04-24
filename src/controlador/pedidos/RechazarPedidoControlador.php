<?php


//namespace controlador;

/**
 * Clase controladora del caso de uso Rechazar Pedido
 * @author Santiago Iglesias
 */
class RechazarPedidoControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		echo "ejecutar accion: $accion";
		switch($accion) {
						
			case "rechazarPedido":
				// Obtengo el idPedido de la request
				$idPedido = $_REQUEST["idPedido"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada->rechazarPedido($idPedido);
					include (HTML_PRIVADA_PEDIDOS_PATH."/pedidoRechazado.php");
				} catch (RechazarPedidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorRechazandoPedido.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}

   
   
   




?>