<?php
 
//namespace controlador;

/**
 * Clase controladora del caso de uso Marcar Pedido No Recibido
 * @author Santiago Iglesias
 */
class MarcarPedidoNoRecibidoAdminControlador extends AdminControlador {
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
				
				// La factoria devuelve un objeto factoria de la fachada administrador
				$fachada = FactoriaFachada::getAdmindaFachada();
				try {
					$fachada->marcarPedidoNoRecibido($idPedido);
					include (HTML_ADMIN_PEDIDOS_PATH."/pedidoMarcadoNoRecibidoAdmin.php");
				} catch (MarcarPedidoRecibidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_PEDIDOS_PATH."/errorMarcandoPedidoNoRecibidoAdmin.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
 
 
 
 
?>