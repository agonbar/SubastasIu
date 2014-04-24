<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso modificar componente
 * @author Almudena Novoa
 */
class ModificarComponenteControlador extends PrivadoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrarFormulario":
				$idComponente = $_REQUEST["idComponente"];
				$fachada = FactoriaFachada::getPrivadaFachada();
				$compBean = new ComponenteBean();						
				try {
					$fachada->consultarComponente($idComponente, $compBean);		
					
					include (HTML_PRIVADA_COMPONENTES_PATH."/modificarComponente.php");
				} catch (CompDatosFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMPONENTES_PATH."/modificarComponente.php");				
				} catch (ConsultarComponenteFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMPONENTES_PATH."/errorConsultarComponente.php");
				}				
				break;
			case "modificarComponente":
				$idComponente = $_REQUEST["idComponente"];
				$fachada = FactoriaFachada::getPrivadaFachada();
				$compBean = new ComponenteBean();				
				try {
					$fachada->consultarComponente($idComponente, $compBean);		
					
					$compBean -> setNombre($_REQUEST["nombreComp"]);
					$compBean -> setDescripcionBreve($_REQUEST["desBreveComp"]);
					$compBean -> setDescripcion($_REQUEST["desComp"]);
					$compBean -> setPrecio($_REQUEST["precio"]);
					$compBean -> setUnidadesStock($_REQUEST["unidadesStock"]);
					
					$fachada->modificarComponente($idComponente, $compBean);
					
					// Para cada foto obtenemos sus datos
					$listaFotos = $compBean->getListaFotos();
					
					// Fotos a insertar
					$i = 0;
					foreach ($listaFotos as $foto) {
						$this->modificarFoto($foto, $i++);				
					}
					
					echo "ejecutar mofidicar";
					
					$fachada->modificarFotosComponente($compBean);	
					
					include (HTML_PRIVADA_COMPONENTES_PATH."/modificarComponente.php");
				} catch (CompDatosFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMPONENTES_PATH."/modificarComponente.php");				
				} catch (ConsultarComponenteFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_COMPONENTES_PATH."/errorConsultarComponente.php");
				}
				break;	
				
									
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
	
	private function modificarFoto(&$fotoComp, $num) {
		$paramFotos = array("foto1", "foto2", "foto3");
		$paramFoto = $paramFotos[$num];
		// Subimos el fichero y lo guardamos en la base de datos de la subasta
		$uploadDir = UPLOAD_FOTOS_COMPONENTES;
		// Guardamos cada una de las fotos
		if (isset($_FILES[$paramFoto]) && $_FILES[$paramFoto]['name'] != "") {
			$fotoComp->setTituloFoto($_FILES[$paramFoto]['name']);
			
			if ($_REQUEST["isPrincipal"] == "$paramFoto") {
				$fotoComp->setIsPrincipal("1");
			} else {
				$fotoComp->setIsPrincipal("0");
			}
			
			// Lo guardamos con este nombre para que no ponga caracteres
			// extranos
			$nombreFichero = $fotoComp->getIdCompFoto()."_".$num.".".
				Ficheros::getExtension($fotoComp->getTituloFoto());
			$fotoComp->setRuta($uploadDir.$nombreFichero);

			echo "fotoComp $nombreFichero";

			if (!Upload::subirFichero($paramFoto, $nombreFichero, $uploadDir)) {
				$ERRORES_FORM["upload"] = $_FILES[$paramFoto]['error'];
				if ($ERRORES_FORM["upload"] == UPLOAD_OK){
					//$ERRORES_FORM[$foto]=$ERRORES_FORM["upload"];
					//$fotoComp->setActualizada(true);
				}
			} else {
				$fotoComp->setActualizada(true);
			}
		}
	}
}
?>