<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso consultar usuario.
 * @author Santiago Iglesias
 * 
 **/
class ConsultarUsuarioAdminControlador extends AdminControlador {
	public function __construct() {
		
	}
	
		protected function ejecutar($accion) {
		switch($accion) {
			
			case "consultarDatos":
				$listaIdUsuarios = $_REQUEST["idOption"];
				
				if(count($listaIdUsuarios)==1){
					
					// La factoria devuelve un objeto factoria de la fachada administrador
					//para poder llamar al metodo consultarDatosUsuario
					$fachada = FactoriaFachada::getAdminFachada();
					try {
						$usuarioBean=new UsuarioBean();
					
						$fachada->consultarDatosUsuario($listaIdUsuarios[0], $usuarioBean);
																		
						include (HTML_ADMIN_USUARIOS_PATH."/datosConsultados.php");
	
					} catch (DatUserFacEx $ex) {
					
						$ERRORES_FORM = $ex->getErrores();
						include (HTML_ADMIN_USUARIOS_PATH."/errorConsultandoUsuario.php");
					}
				}else{
					
					include (HTML_ADMIN_COMPONENTES_PATH . "/errorConsultandoUsuario.php");
				}
				break;
			default:
				echo "accionNoEncontrada";
		}
	}
}
?>