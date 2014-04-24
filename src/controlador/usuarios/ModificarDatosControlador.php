<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Modificar Datos Propios
 * @author Adrián González
 */
class ModificarDatosControlador extends PrivadoControlador {
	public function __construct() {

	}

	/**
	 * Acepta los datos introducidos por un usuario para modificar el usuario
	 * @author Adrián González
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "modificarDatos" :
				//obtenemos el usuaro
				$usuario = new usuarioDAO();
				//obtenemos datos del usuario actualizados y los ponemos en el usuario
				$estadoUsuario = $_REQUEST["estadoUsuario"];
				$usuario -> setEstadoUsuario($estadoUsuario);

				$nombre = $_REQUEST["nombre"];
				$usuario -> setNombre($nombre);

				$apellidos = $_REQUEST["apellidos"];
				$usuario -> setApellidos($apellidos);

				$direccion = $_REQUEST["direccion"];
				$usuario -> setDireccion($direccion);

				$dni = $_REQUEST["dni"];
				$usuario -> setDni($dni);

				$email = $_REQUEST["email"];
				$usuario -> setEmail("email");

				$fechaNacimiento = $_REQUEST["fechaNacimiento"];
				$usuario -> setFechaNacimiento($fechaNacimiento);

				$cuentaPayPal = $_REQUEST["cuentaPayPal"];
				$usuario -> setCuentaPayPal($cuentaPayPal);

				$idEstadoUsuario = $_REQUEST["idEstadoUsuario"];
				$usuario -> setIdEstadoUsuario($idEstadoUsuario);

				Session::set(ID_USUARIO_CONECTADO_KEY,$usuario->getIdUsuario());

				//se llama a la fachada privada para poder ejecutar asi el metodo modificarDatos
				$fachada = FactoriaFachada::getPrivadaFachada();
				
				try {

					$fachada -> modificarDatos($usuario);
					include (HTML_PRIVADA_PATH . "/DatosModificadosUsuario.php");

				} catch (DatUserFacEX $ex) {
					$ERRORES_FORM = $ex -> getErrores();
					include (HTML_PRIVADA_PATH . "/errorDatosUsuario.php");
				}
			break;
			
			case "modificarContrasena" :
				$datosCambiarClaveBean = new DatosCambiarClaveBean();
				$datosCambiarClaveBean->setClaveActual($_REQUEST["claveActual"]);
				$datosCambiarClaveBean->setClaveNueva($_REQUEST["claveNueva"]);
				$datosCambiarClaveBean->setRepetirClave($_REQUEST["repetirClave"]);			
					
				$idUsuario = Session::get(ID_USUARIO_CONECTADO_KEY);

				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada -> modificarContrasena($idUsuario, $datosCambiarClaveBean);
					$usuarioBean = new UsuarioBean();
					$fachada -> consultarDatosUsuario($idUsuario, $usuarioBean);
					Session::set(USUARIO_CONECTADO_KEY, $usuarioBean);
					include (HTML_PRIVADA_USUARIOS_PATH."/claveModificada.php");
				} catch (DatPassFacEX $ex) {
					$ERRORES_FORM = $ex -> getErrores();
					foreach ($ERRORES_FORM as $clave => $valor) {
						echo "errores: $clave -> $valor";
					}
					include (HTML_PRIVADA_USUARIOS_PATH."/datosPropiosConsultado.php");
				} catch (DatUserIncFacEx $ex) {
					$ERRORES_FORM = $ex -> getErrores();
					foreach ($ERRORES_FORM as $clave => $valor) {
						echo "errores: $clave -> $valor";
					}
					include (HTML_PRIVADA_USUARIOS_PATH."/datosPropiosConsultado.php");	
				}
			break;
			
			default :
				echo "accionNoEncontrada";
		}
	}

}
?>