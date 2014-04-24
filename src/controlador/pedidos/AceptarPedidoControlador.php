<?php


//namespace controlador;

/**
 * Clase controladora del caso de uso Aceptar Pedido
 * @author Santiago Iglesias
 */
class AceptarPedidoControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {						
		echo "ejecutar accion: $accion";
		switch($accion) {
						
			case "aceptarPedido":
				// Obtengo el idPedido de la request
				$idPedido = $_REQUEST["idPedido"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada->aceptarPedido($idPedido);
					include (HTML_PRIVADA_PEDIDOS_PATH."/pedidoAceptado.php");
				} catch (AceptarPedidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorAceptandoPedido.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}

   
   
   




?>