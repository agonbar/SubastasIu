<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Login
 * @author Miguel Callon
 */
class LoginControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
 	* Acepta los datos introducidos por un usuario para iniciar sesion en el sistema
 	* @author Nuria Canle
 	*/
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrarFormulario":
				include (HTML_PUBLICA_PATH."/login.php");
				break;		
			case "autenticar":
				$usuario = $_REQUEST["usuario"];
				$clave = $_REQUEST["clave"];
				
				//se llama a la fachada publica para poder ejecutar asi el metodo consultarDatosUsuario
				$fachada = FactoriaFachada::getPublicaFachada();
				try {
					// Este metodo valida si el usuario y la clave estan vacios
					// por favor, no lo cambies <-- Miguel Callon
					ValidarCampos::validarLogin($usuario, $clave);
					
					$usuarioBean = new UsuarioBean();
					$fachada->consultarDatosUsuario($usuario, $clave, $usuarioBean);
					
					//tras haber validado los datos y comprobado 
					//que el usuario esta registrado, se inicia sesion
					Session::set(ID_USUARIO_CONECTADO_KEY,$usuarioBean->getIdUsuario());
					Session::set(USUARIO_CONECTADO_KEY, $usuarioBean);
					Session::set(IS_AUTENTICADO_KEY, true);
					
					// Se asigna un carrito vacio al usuario
					$carrito = new CarritoBean();
					Session::set(CARRITO_BEAN_KEY, $carrito);
					
					// Comprobamos si es un usuario administrador
					if ($usuarioBean->getIsAdmin() == "1") {
						Session::set(IS_ADMIN_KEY, true);
					} else { 
						Session::set(IS_ADMIN_KEY, false);
					}
					header('Location: ./index.php');
				} catch (LoginFacEx $loginFacEx) {
					$ERRORES_FORM = $loginFacEx->getErrores();
					include (HTML_PUBLICA_PATH."/login.php");
				}
				break;
			default:
				echo "accionNoEncontrada";
		}
	}
}
?>