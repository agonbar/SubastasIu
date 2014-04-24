<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Baja de Usuario
 * @author Santiago Iglesias
 */
class BajaUsuarioControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
		protected function ejecutar($accion) {
		switch($accion) {
			case "bajaUsuario":
					$fachada=FactoriaFachada::getPrivadaFachada();
				try{
					//obtenemos el id del usuario para poder darlo de baja
					$idUsuConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
					$fachada->darBaja($idUsuConectado);
					header('Location: index.php?controlador=CerrarSesionControlador&accion=cerrar');
				} catch (DatUserFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMUN_PATH."/errorBaja.php");
				}
				
				break;
			default:
				echo "accionNoEncontrada";
		}
	}
}
?>