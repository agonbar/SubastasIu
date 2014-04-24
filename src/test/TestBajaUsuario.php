<?php
/**
 * Clase utilidad que permite comprobar que Baja Usuario funciona correctamente
 * @author Santiago Iglesias
 */
class TestBajaUsuario extends AbstractUnitTest implements IUnitTest {
	/**
	 * Constructor por defecto.
	 */
	public function __construct() {
		
	}
	/**
	 * Test que comprueba que se da de baja un usuario del sistema
	 */
	public function testBajaUsuario() {
		$usuario = new UsuarioBean();
		$usuario->setIdUsuario(999);
		$usuario->setNombre("Paco");
		$usuario->setApellidos("de Lucía");
		$usuario->setLocalidad("Ribeira");
		$usuario->setProvincia("A Coruña");
		$usuario->setCP("15960");
		
		$fachada = FactoriaFachada::getPublicaFachada();
		try {
			$fachada->registrarUsuario($usuario);
		} catch (CrearUserFacEx $ex) {
			return false;	
		}
		$fachada = FactoriaFachada::getPrivadaFachada();
		try{
			$fachada->darBaja($usuario->getIdUsuario());
			} catch (DatUserFacEx $ex) {
			return false;	
		}
			return true;
		}
		
	}
	

?>