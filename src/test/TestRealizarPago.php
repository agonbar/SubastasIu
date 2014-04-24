<?php
/**
 * Clase utilidad que permite realizar prueba sobre el caso de uso 
 * Realizar Pago
 * @author Miguel Callon
 */
class TestRealizarPago extends AbstractUnitTest implements IUnitTest {
	/**
	 * Constructor por defecto.
	 */
	public function __construct() {

	}

	/**
	 * Test que comprueba que se realiza un ciclo de pedido completo
	 */
	public function testRealizarPago() {
		// Primero se crea un pedido
		// TODO Pendiente del caso de uso crear pedido
		$idPedido = 1;
		$fachada = FactoriaFachada::getPrivadaFachada();
		
		try {
			$pedidoBean = new PedidoBean();
			$fachada->consultarPedido($idPedido, $pedidoBean);
			
			if ($pedidoBean->getIdEstadoPedido() != ESTADO_PEDIDO_NUEVO) return false;
			
			$usuarioComprador = $pedidoBean->getUsuarioComprador();
			
			// Realizamos la compra del pedido
			$datosPago = new DatosPagoBean();
			$datosPago->setCuentaOrigen("cuentaPrueba");
			$datosPago->setDireccionEnvio("direccionPrueba");
			$datosPago->setLocalidadEnvio("localidadPrueba");
			$datosPago->setProvinciaEnvio("provinciaPrueba");
			$fachada->realizarPago($idPedido, $datosPago);
			$fachada->consultarPedido($idPedido, $pedidoBean);
			
			if ($pedidoBean->getIdEstadoPedido() != ESTADO_PEDIDO_EN_TRAMITE) return false;
			
			$fachada->consultarPedido($idPedido, $pedidoBean);
			// Aceptamos el pedido por parte del fabricante
			$fachada->aceptarPedido($idPedido);
			
			$fachada->consultarPedido($idPedido, $pedidoBean);
			if ($pedidoBean->getIdEstadoPedido() != ESTADO_PEDIDO_ACEPTADO) return false;
		} catch (Exception $ex) {
			echo "Excepcion: ".$ex->__toString();
			echo "Errores: ".$ex->getErrores();
			return false;
		}		
		return true;
	}

}
?>