<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Modificar datos del usuario.
 * @author Adrián González
 */
class ModificarUsuarioControlador extends AdminControlador {
	public function __construct() {

	}

	/**
	 * Acepta los datos introducidos por un usuario para modificar el usuario
	 * @author Adrián González
	 */

	protected function ejecutar($accion) {
		switch($accion) {
			case "modificarUsuario" :
				//obtenemos el usuaro
				$usuario = new UsuarioBean();
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
				
				$telefono = $_REQUEST["telefono"];
				$usuario -> setTelefono($telefono);

				$clave = $_REQUEST["clave"];
				$usuario -> setClave($clave);

				$fechaNacimiento = $_REQUEST["fechaNacimiento"];
				$usuario -> setFechaNacimiento($fechaNacimiento);

				$cuentaPayPal = $_REQUEST["cuentaPayPal"];
				$usuario -> setCuentaPayPal($cuentaPayPal);

				$idEstadoUsuario = $_REQUEST["idEstadoUsuario"];
				$usuario -> setIdEstadoUsuario($idEstadoUsuario);

				$idUsuario = $_REQUEST["idUsuario"];
				$usuario -> setIdUsuario($idEstadoUsuario);
				
				$isAdmin = $_REQUEST["isAdmin"];
				$usuario -> setIsAdmin($isAdmin);
				
				$localidad = $_REQUEST["localidad"];
				$usuario -> setLocalidad($localidad);
				
				$provincia = $_REQUEST["provincia"];
				$usuario -> setProvincia($provincia);
				
				$cp = $_REQUEST["cp"];
				$usuario -> setCp($cp);
	
				
				

				//se llama a la fachada privada para poder ejecutar asi el metodo modificarDatos
				$fachada = FactoriaFachada::getPrivadaFachada();

				try {

					$fachada -> modificarUsuario($usuario);

				} catch (DatUserFacEX $ex) {
					$ERRORES_FORM = $ex -> getErrores();
					include (HTML_PUBLICA_PATH . "/inicio.php");
				}

				break;
			default :
				echo "accionNoEncontrada";
		}
	}

}
?>