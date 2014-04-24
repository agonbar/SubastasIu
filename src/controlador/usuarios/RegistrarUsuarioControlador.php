<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso RegistrarUsuario
 * @author Miguel Callon
 */
class RegistrarUsuarioControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
 	* Registra un usuario en la aplicacion
 	* @author Miguel Callon
 	*/
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrarFormulario":
				include (HTML_PUBLICA_PATH."/registro.php");
				break;		
			case "registrarUsuario":
				$usuarioBean = new UsuarioBean();
				$usuarioBean->setNombre($_REQUEST["nombre"]);
				$usuarioBean->setApellidos($_REQUEST["apellidos"]);
				$usuarioBean->setDiaNacimiento($_REQUEST["diaNacimiento"]);
				$usuarioBean->setMesNacimiento($_REQUEST["mesNacimiento"]);
				$usuarioBean->setAnhoNacimiento($_REQUEST["anhoNacimiento"]);
				$usuarioBean->setDni($_REQUEST["dni"]);
				$usuarioBean->setTelefono($_REQUEST["telefono"]);
				$usuarioBean->setEmail($_REQUEST["email"]);
				$usuarioBean->setDireccion($_REQUEST["direccion"]);
				$usuarioBean->setLocalidad($_REQUEST["localidad"]);
				$usuarioBean->setProvincia($_REQUEST["provincia"]);
				$usuarioBean->setCP($_REQUEST["codigoPostal"]);
				$usuarioBean->setUsuario($_REQUEST["usuario"]);
				$usuarioBean->setClave($_REQUEST["clave"]);
				$usuarioBean->setCuentaPayPal($_REQUEST["cuentaPayPal"]);
				
				//se llama a la fachada publica para poder ejecutar asi el metodo consultarDatosUsuario
				$fachada = FactoriaFachada::getPublicaFachada();
				try {
					ValidarCampos::validarNuevoUsuario($usuarioBean);
					
					// Formamos el campo fechaNacimiento con dia/mes/anhio
					$fechaNacimiento = $usuarioBean->getDiaNacimiento()."/".
									   $usuarioBean->getMesNacimiento()."/".
									   $usuarioBean->getAnhoNacimiento();
					$usuarioBean->setFechaNacimiento($fechaNacimiento);
					
					$fachada->registrarUsuario($usuarioBean);
					include (HTML_PUBLICA_PATH."/usuarioRegistrado.php");
				} catch (DatUserIncFacEx $ex) {
					echo "error1: ".$ex->getMessage();
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PUBLICA_PATH."/registro.php");
				} catch (CrearUserFacEx $ex) {
					echo "error2: ".$ex->getMessage();
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PUBLICA_PATH."/errorRegistrandoUsuario.php");
				}
				break;
			default:
				echo "accionNoEncontrada";
		}
	}
}
?>