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
			case "crearUsuarioPrivilegiado" :

				$usuario = new UsuarioBean();				
				$idUsuario = $_REQUEST["idUsuario"];
				$usuario->setIdUsuario($idUsuario);

				//se llama a la fachada privada para poder ejecutar asi el metodo modificarDatos
				$fachada = FactoriaFachada::getPrivadaFachada();

				try {

					$fachada -> crearUsuarioPrivilegiado($usuario);

				} catch (DatUserIncFacEX $ex) {
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