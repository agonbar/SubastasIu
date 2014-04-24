<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Subasta
 * @author Miguel Callon
 */
class CrearSubastaControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrarFormulario":
				// Muestra el formulario de subastas
				include (HTML_PRIVADA_SUBASTAS_PATH."/crearSubasta.php");
				break;
			case "crearSubasta":
				$subasta = new SubastaBean();
				$subasta->setTitulo($_REQUEST["titulo"]);
				$subasta->setDescripcionBreve($_REQUEST["descripcionBreve"]);
				$subasta->setDescripcion($_REQUEST["descripcion"]);
				$subasta->setFechaApertura($_REQUEST["fechaApertura"]);
				$subasta->setFechaCierre($_REQUEST["fechaCierre"]);
				$subasta->setHoraApertura($_REQUEST["horaApertura"]);
				$subasta->setHoraCierre($_REQUEST["horaCierre"]);
				$subasta->setPrecioInicial($_REQUEST["precioInicial"]);
				$subasta->setIdCompSub($_REQUEST["idCompSub"]);
				// Obtener el nombre de la foto
				$subasta->setTituloFotoSub($_FILES['userfile']['name']);
				//$subasta->setDesFotoSub($_REQUEST["desFotoSub"]);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				try {
					$fachada->crearSubasta($subasta);
					// Subimos el fichero y lo guardamos en la base de datos de la subasta
					$uploadDir = UPLOAD_FOTOS_SUBASTAS;
					// Lo guardamos con este nombre para que no ponga caracteres
					// extranos
					$nombreFichero = $subasta->getIdSubasta().".".
						Ficheros::getExtension($subasta->getTituloFotoSub());
					$subasta->setRutaFotoSub($uploadDir.$nombreFichero);
					
					// Actualizamos la informacion de la subasta con la ruta de la imagen
					$fachada->modificarSubasta($subasta->getIdSubasta(),$subasta);
				
					if (!Upload::subirFichero("userfile", $nombreFichero,$uploadDir)) {
						$ERRORES_FORM["upload"] = $_FILES['userfile']['error'];
						if ($ERRORES_FORM["upload"] != UPLOAD_OK){
							throw new CrearSubastaFacEx($ERRORES_FORM["upload"]);
						}
					}
					
					include (HTML_PRIVADA_SUBASTAS_PATH."/subastaCreada.php");
				} catch (SubDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/crearSubasta.php");
				} catch (CrearSubastaFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconocido";
					include (HTML_PRIVADA_SUBASTAS_PATH."/crearSubasta.php");
				}
				
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>