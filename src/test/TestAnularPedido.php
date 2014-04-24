<?php
/**
 *  * Clase utilidad que permite validar los campos de los formularios.
 * @author Adrián González
 */
class TestAnularPedido extends AbstractUnitTest implements IUnitTest {
	/**
	 * Constructor por defecto.
	 */
	public function __construct() {

	}

	/**
	 * Test que comprueba que se Anula un Pedido
	 */
	public function testAnularPedido() {
		
		$fachada = FactoriaFachada::getAdminFachada();
		try {
			$fachada->anularPedido(7);
		} catch (SubDatosIncFacEx $ex) {
			return false;
		}

		return true;
	}

}
?>