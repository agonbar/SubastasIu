<?php
 
/**
 * Clase controladora del caso de uso Consultar Notificaciones
 * @author Almudena Novoa
 */
class ConsultarNotificacionesControlador extends PrivadoControlador 
{
	public function __construct() 
	{
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "consultarNotificacion":
				// Obtengo el idNotificacion de la notificacion a consultar
				$idNotificacion = $_REQUEST["idNotificacion"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				//para poder llamar al metodo consultarNotificacion
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$notificacionBean=new NotificacionBean();
					$fachada->consultarNotificacion($idNotificacion, $notificacionBean);
										
					include (HTML_PRIVADA_NOTIFICACIONES_PATH."/NotificacionConsultada.php");

				} catch (ConsultarNotificacionFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_NOTIFICACIONES_PATH."/errorConsultarNotificacion.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}