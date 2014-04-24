<?php
    //namespace controlador;

/**
 * Clase controladora del caso de uso ModificarPedidodelSistema
 * @author Nuria Canle
 */
class ModificarPedidoControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "modificarPedido":
				$idPedido = $_REQUEST["idPedido"];
				// La factoria devuelve un objeto factoria de la fachada administrador
				$fachada = FactoriaFachada::getAdminFachada();
				try {
					$idUsuConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
					// Modificar pedido
					$fachada->modificarPedido($idPedido, $idUsuConectado);
					include (HTML_ADMIN_PEDIDOS_PATH."/pedidoModificado.php");
				} catch (ModificarPedidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_PEDIDOS_PATH."/errorModificandoPedido.php");
				}
				
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>