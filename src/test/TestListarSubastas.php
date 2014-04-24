
  
<?php
/**
 * Clase utilidad que permite validar si Listar Subastas funciona correctamente.
 * @author Santiago Iglesias
 */
class TestListarSubastas extends AbstractUnitTest implements IUnitTest {
	/**
	 * Constructor por defecto.
	 */
	public function __construct() {
		
	}
	/**
	 * Test que comprueba que lista las subasta de la parte privada la BD
	 */
	public function testListarSubastasPrivada() {
		$paginadoBean = new PaginadoBean(1, null, 20, null);		
		
		$fachada = FactoriaFachada::getPrivadaFachada();
		try {
			$fachada->listarSubastas($subasta, $paginadoBean);
		} catch (SubDatosIncFacEx $ex) {
			return false;	
		}
		
		return true;
	}
}
	
  
  
  
?>