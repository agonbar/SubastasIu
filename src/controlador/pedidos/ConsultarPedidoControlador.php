<?php
   

//namespace controlador;

/**
 * Clase controladora del caso de uso Consultar Pedido
 * @author Santiago Iglesias
 */
class ConsultarPedidoControlador extends PrivadoControlador {
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
					$idUsuarioComprador = $pedidoBean->getIdUsuarioComprador();
					$idUsuarioVendedor = $pedidoBean->getIdUsuarioVendedor();
					$idUsuarioConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
					
					if ($idUsuarioComprador == $idUsuarioConectado) {
						if ($pedidoBean->getIdEstadoPedido() == ESTADO_PEDIDO_NUEVO) {
							include (HTML_PRIVADA_PEDIDOS_PATH.
										"/pedidoConsultadoNuevoComprador.php");
						} else {
							include (HTML_PRIVADA_PEDIDOS_PATH.
										"/pedidoConsultadoComprador.php");
						}
					} elseif ($idUsuarioVendedor == $idUsuarioConectado) {
						include (HTML_PRIVADA_PEDIDOS_PATH."/pedidoConsultadoVendedor.php");
					}
				} catch (ConsultarPedidoFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_PEDIDOS_PATH."/errorConsultandoPedido.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}

   
   
   
   
   
  
   
   
?>