<?php
/**
 *  * Clase utilidad que permite validar si se cambia el estado del pedido
 * @author Santiago Iglesias
 */
class TestMarcarPedidoNoRecibido extends AbstractUnitTest implements IUnitTest {
	/**
	 * Constructor por defecto.
	 */
	public function __construct() {

	}

	/**
	 * Test que comprueba que se marca pedido como no recibido sin fallos
	 */
	public function testMarcarPedidoNoRecibido() {
		
		$fachada = FactoriaFachada::getPrivadaFachada();
		try {
			
			$fachada -> marcarPedidoNoRecibido(1);
		} catch (MarcarPedidoNoRecibidoFacEx $ex) {
			return false;
		}

		return true;
	}

}
?>