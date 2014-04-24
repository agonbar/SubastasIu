<?php
/**
 *  * Clase utilidad que permite validar si funciona correctamente Aceptar Pedido
 * @author Santiago Iglesias
 */
class TestAceptarPedido extends AbstractUnitTest implements IUnitTest {
	/**
	 * Constructor por defecto.
	 */
	public function __construct() {

	}

	/**
	 * Test que comprueba que se Acepta un Pedido
	 */
	public function testAceptarPedido() {
		
		$fachada = FactoriaFachada::getPrivadaFachada();
		try {
			$fachada->aceptarPedido(7);
		} catch (SubDatosIncFacEx $ex) {
			return false;
		}

		return true;
	}

}
?>