<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso alta componente
 * @author Santiago Iglesias
 */
class AltaComponenteAdminControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			
				case "mostrarFormulario":
				// Muestra el formulario de componentes
				include (HTML_ADMIN_COMPONENTES_PATH."/altaComponenteAdmin.php");
				break;
				
				
				case "altaComponente":
				$componente = new ComponenteBean();
				$componente -> setNombre($_REQUEST["nombreComp"]);
				$componente -> setDescripcionBreve($_REQUEST["desBreveComp"]);
				$componente -> setDescripcion($_REQUEST["desComp"]);
				$componente -> setPrecio($_REQUEST["precio"]);
				$componente -> setUnidadesStock($_REQUEST["unidadesStock"]);
				$componente -> setListaFotos(array());
				
				// Obtener el nombre de la foto
				
				// La factoria devuelve un objeto factoria de la fachada admin
				$fachada = FactoriaFachada::getAdminFachada();
				try {
					$componente->setListaFotos(array());
					$fachada->altaComponente($componente);					
					
					$paramFotos = array("foto1", "foto2", "foto3");
					foreach ($paramFotos as $foto) {
						$this->insertarFoto($foto, $componente);
					}
					
					$fachada->insertarFotosComponente($componente);					
					include (HTML_ADMIN_COMPONENTES_PATH."/componenteCreadoAdmin.php");
				} catch (CompDatosFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_COMPONENTES_PATH."/altaComponenteAdmin.php");
				} catch (AltaComponenteFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconocido";
					include (HTML_ADMIN_COMPONENTES_PATH."/altaComponenteAdmin.php");
				}
				
				break;
				
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
	private function insertarFoto($foto, ComponenteBean $componente) {
		// Subimos el fichero y lo guardamos en la base de datos de la subasta
		$uploadDir = UPLOAD_FOTOS_COMPONENTES;
		// Guardamos cada una de las fotos
		if (isset($_FILES[$foto])) {
			$fotoComp = new FotoComponenteBean();
			$fotoComp->setTituloFoto($_FILES[$foto]['name']);
			
			if ($_REQUEST["isPrincipal"] == "$foto") {
				$fotoComp->setIsPrincipal("1");
			} else {
				$fotoComp->setIsPrincipal("0");
			}
			
			$listaFotos = $componente->getListaFotos();
			// Lo guardamos con este nombre para que no ponga caracteres
			// extranos
			$nombreFichero = $componente->getIdComponente()."_".count($listaFotos).".".
				Ficheros::getExtension($fotoComp->getTituloFoto());
			$fotoComp->setRuta($uploadDir.$nombreFichero);

			$listaFotos[count($listaFotos)] = $fotoComp;
			$componente->setListaFotos($listaFotos);
		
			if (!Upload::subirFichero($foto, $nombreFichero,$uploadDir)) {
				$ERRORES_FORM["upload"] = $_FILES[$foto]['error'];
				if ($ERRORES_FORM["upload"] == UPLOAD_OK){
					//$ERRORES_FORM[$foto]=$ERRORES_FORM["upload"];
				}
			}
		
		}
	}
}
?>