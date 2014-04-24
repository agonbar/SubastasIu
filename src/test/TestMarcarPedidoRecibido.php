<?php
/**
 *  * Clase utilidad que permite validar si se cambia el estado del pedido
 * @author Santiago Iglesias
 */
class TestMarcarPedidoRecibido extends AbstractUnitTest implements IUnitTest {
	/**
	 * Constructor por defecto.
	 */
	public function __construct() {

	}

	/**
	 * Test que comprueba que se marca pedido como recibido sin fallos
	 */
	public function testMarcarPedidoRecibido() {
		
		$fachada = FactoriaFachada::getPrivadaFachada();
		try {
			
			$fachada -> marcarPedidoRecibido(1);
		} catch (MarcarPedidoRecibidoFacEx $ex) {
			return false;
		}

		return true;
	}

}
?>