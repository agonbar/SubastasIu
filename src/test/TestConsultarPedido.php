<?php
/**
 *  * Clase utilidad que permite validar si Consultar Pedido funciona correctamente.
 * @author Santiago Iglesias
 */
class TestConsultarPedido extends AbstractUnitTest implements IUnitTest {
	/**
	 * Constructor por defecto.
	 */
	public function __construct() {

	}

	/**
	 * Test que comprueba que se consulta un pedido
	 */
	public function testConsultarPedido() {
		
		$fachada = FactoriaFachada::getPrivadaFachada();
		try {
			$pedidoBean = new PedidoBean();
			$fachada -> consultarPedido(1, $pedidoBean);
		} catch (SubDatosIncFacEx $ex) {
			return false;
		}

		return true;
	}

}
?>