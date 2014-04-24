<?php
/**
 * Clase utilidad que permite validar los campos de los formularios.
 * @author Miguel Callon
 */
class TestCrearSubasta extends AbstractUnitTest implements IUnitTest {
	/**
	 * Constructor por defecto.
	 */
	public function __construct() {
		
	}
	/**
	 * Test que comprueba que un usuario crea una subasta en la BD
	 */
	public function testCrearSubasta() {
		$subasta = new SubastaBean("999", "pruebanombre", "33");
		
		$fachada = FactoriaFachada::getPrivadaFachada();
		try {
			$fachada->crearSubasta($subasta);
		} catch (SubDatosIncFacEx $ex) {
			return false;	
		}
		
		return true;
	}
	
}
?>