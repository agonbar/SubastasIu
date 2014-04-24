<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso CancelarSubasta
 * @author Miguel Callon
 */
class ModificarFinDeSubastaControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "modificarFinDeSubasta":
				$idSubasta = $_REQUEST["idSubasta"];
				$nuevaFechaCierre = $_REQUEST["fechaCierre"];
				$nuevaHoraCierre = $_REQUEST["horaCierre"];
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$idUsuConectado = Session::get(ID_USUARIO_CONECTADO_KEY);
					// Modificar fin de subasta
					
					// Componemos la fecha de apertura de la fecha de cierre
					$nuevaFechaCierre = $nuevaFechaCierre." ".$nuevaHoraCierre;
					$nuevaFechaCierre = Fecha::formateaHtml2SQL($nuevaFechaCierre);;
					
					$fachada->modificarFinDeSubasta($idSubasta, $nuevaFechaCierre, $idUsuConectado);
					include (HTML_PRIVADA_SUBASTAS_PATH."/finDeSubastaModificado.php");
				} catch (ModificarFinDeSubastaFacEx $ex) {
					//echo "error:".$ex->getMessage();
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorModificandoFinDeSubasta.php");
				}
				
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>