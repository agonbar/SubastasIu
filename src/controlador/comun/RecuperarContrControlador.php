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
			
			case "recuperarContrasena" :
			
				$usuario = new usuarioDAO();
			
				Session::set(ID_USUARIO_CONECTADO_KEY,$usuario->getIdUsuario());
				
				$fachada = FactoriaFachada::getPrivadaFachada();

				try {

					$fachada -> recuperarContrasena($usuario);

				} catch (DatPassFacEX $ex) {
					$ERRORES_FORM = $ex -> getErrores();
					include (HTML_PRIVADA_PATH . "/errorRecuContra.php");
				}

			break;
			
			default :
				echo "accionNoEncontrada";
		}
	}

}
?>