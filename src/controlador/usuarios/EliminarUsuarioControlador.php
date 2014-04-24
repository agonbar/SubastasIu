<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Eliminar usuario
 * @author Adrián González
 */
class ModificarDatosControlador extends AdminControlador {
	public function __construct() {

	}

	/**
	 * Acepta los datos introducidos por un usuario para modificar el usuario
	 * @author Adrián González
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "eliminarUsuario" :
			
				$usuario = new usuarioDAO();
			
				Session::set(ID_USUARIO_CONECTADO_KEY,$usuario->getIdUsuario());
				
				$fachada = FactoriaFachada::getPrivadaFachada();

				try {

					$fachada -> eliminarUsuario($usuario);

				} catch (eliminarUsuarioFacEX $ex) {
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