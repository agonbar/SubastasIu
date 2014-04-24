<?php
 
//namespace controlador;

/**
 * Clase controladora del caso de uso Marcar Pedido Recibido
 * @author Santiago Iglesias
 */
class MarcarPedidoRecibidoAdminControlador extends AdminControlador {
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
				
				// La factoria devuelve un objeto factoria de la fachada administrador
				$fachada = FactoriaFachada::getAdminFachada();
				try {
					$fachada->marcarPedidoRecibido($idPedido);
					include (HTML_ADMIN_PEDIDOS_PATH."/pedidoMarcadoRecibidoAdmin.php");
				} catch (MarcarPedidoRecibidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_PEDIDOS_PATH."/errorMarcandoPedidoRecibidoAdmin.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
 
 
 
 
?>