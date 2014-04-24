<?php
   

//namespace controlador;

/**
 * Clase controladora del caso de uso Consultar Factura
 * @author Adrian Gonzalez
 */
class ConsultarFacturaControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "consultarFactura":
				// Obtengo el dato clave de la request
				$idfactura = $_REQUEST["idFactura"];
				
				// La factoria devuelve un objeto factoria de la fachada privada
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					
					$facturaBean=new FacturaBean();
					$fachada->consultarFactura($idfactura, $facturaBean);
					
				} catch (ConsultarFacturaFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_FACTURAS_PATH."/errorConsultandoFactura.php");
				}
				break;
			
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}

   
   
   
   
   
  
   
   
?>