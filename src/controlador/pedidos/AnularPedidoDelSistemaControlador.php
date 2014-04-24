<?php


//namespace controlador;

/**
 * Clase controladora del caso de uso Anular Pedido Del Sistema
 * @author Adrián González
 */
class AnularPedidoDelSistemaControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		echo "ejecutar accion: $accion";
		switch($accion) {
						
			case "anularPedidoDelSistema":
				// Obtengo el idPedido de la request
				$idPedido = $_REQUEST["idPedido"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getAdminFachada();
				try {
					$fachada->anularPedidoDelSistema($idPedido);
					include (HTML_ADMIN_PEDIDOS_PATH."/pedidoAnulado.php");
				} catch (AnularPedidoDelSistemaFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_PEDIDOS_PATH."/errorAnulandoPedido.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}

   
   
   




?>