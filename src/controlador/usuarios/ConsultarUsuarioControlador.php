<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso consultar usuario.
 * @author Adrián González
 */
class ConsultarUsuarioControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
 	* Obtiene y muestra datos del usuario
 	* @author Adrián González
 	*/
	protected function ejecutar($accion) {
		switch($accion) {
			case "consultarDatosPropios":
				//se crea una fachada privada para poder ejecutar asi el metodo consultarUsuario
				$fachada = FactoriaFachada::getPrivadaFachada();
				$usuarioBean = Session::get(USUARIO_CONECTADO_KEY);
				include (HTML_PRIVADA_USUARIOS_PATH."/datosPropiosConsultado.php");
				break;
			case "consultarDatos":
				$usuario = new UsuarioBean();
				$idUsuario = Session::get(ID_USUARIO_CONECTADO_KEY);
				//se crea una fachada privada para poder ejecutar asi el metodo consultarUsuario
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada->consultarDatosUsuario($idUsuario, $usuario);
					include (HTML_PRIVADA_USUARIOS_PATH."/datosConsultados.php");
					
				} catch (consultarUsuarioFacEX $datUserEx) {
					$ERRORES_FORM = $datUserEx->getErrores();
					include (HTML_PRIVADA_PATH."/errorConsultandoUsuario.php");
				}
				
				break;
			default:
				echo "accionNoEncontrada";
		}
	}
}
?>