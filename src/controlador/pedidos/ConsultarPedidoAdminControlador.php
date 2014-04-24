<?php
   

//namespace controlador;

/**
 * Clase controladora del caso de uso Consultar Pedido
 * @author Santiago Iglesias
 */
class ConsultarPedidoControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "consultarPedido":
				// Obtengo el idPedido de la request
				$idPedido = $_REQUEST["idPedido"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$pedidoBean=new PedidoBean();
					$fachada->consultarPedido($idPedido, $pedidoBean);
					include(HTML_ADMIN_PEDIDOS_PATH."/PedidoConsultadoAdmin.php");
					
					
				} catch (ConsultarPedidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_PEDIDOS_PATH."/errorConsultandoPedidoAdmin.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}

   
   
   
   
   
  
   
   
?>