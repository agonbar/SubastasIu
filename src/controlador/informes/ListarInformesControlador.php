<?php
    //namespace controlador;

/**
 * Clase controladora del caso de uso listar informes.
 * @author Nuria Canle
 */
class ListarInformesControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	protected function ejecutar($accion) {
		switch($accion) {					
			case "listarInformes":
				// Comprobamos si es admin
				$this->isAutenticadoAdmin();
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("fecha" => "ordenacion.fecha",
					"numPedidos" => "ordenacion.numPedidos",
					"numSubastas" => "ordenacion.numSubastas",
					"ganancia" => "ordenacion.ganancia");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaInformesBean = new BusquedaInformesBean();
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_INFORMES_BEAN, $busquedaInformesBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getAdminFachada();
				$listaInformes= array();
				try {
					$fachada->listarInformes($busquedaInformesBean, $listaInformes, $paginadoBean);
					include (HTML_ADMIN_INFORMES_PATH."/informesListados.php");
				} catch (InfDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_INFORMES_PATH."/errorListandoInformes.php");
				} catch (CrearInformeFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconocido";
					include (HTML_ADMIN_INFORMES_PATH."/errorListandoInformes.php");
				}
				break;
			case "buscarInformesAdmin":
				// Comprobamos si es admin
				$this->isAutenticadoAdmin();
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("fecha" => "ordenacion.fecha",
					"numPedidos" => "ordenacion.numPedidos",
					"numSubastas" => "ordenacion.numSubastas",
					"numPujas" => "ordenacion.numPujas",
					"ganancia" => "ordenacion.ganancia",
					"pagosRecibidos" => "ordenacion.pagosRecibidos",
					"pagosEnviados" => "ordenacion.pagosEnviados");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				// Obtenemos de la sesion los datos de la busqueda
				$busquedaInformesBean = Session::get(BUSQUEDA_INFORMES_BEAN);
				// Si no existe un objeto busquedaPedidosBean lo creamos
				if (!isset($busquedaInformesBean)) {
					$busquedaInformesBean = new BusquedaInformesBean();
				}
				// Recogemos los parametros de la request
				/*$busquedaInformesBean->setFecha($_REQUEST["fecha"]);
				$busquedaInformesBean->setNumPedidos($_REQUEST["numPedidos"]);
				$busquedaInformesBean->setNumSubastas($_REQUEST["numSubastas"]);
				$busquedaInformesBean->setNumPujas($_REQUEST["numPujas"]);
				$busquedaInformesBean->setGanancia($_REQUEST["ganancia"]);
				$busquedaInformesBean->setPagosRecibidos($_REQUEST["pagosRecibidos"]);
				$busquedaInformesBean->setPagosEnviados($_REQUEST["pagosEnviados"]);*/
				$busquedaInformesBean->setFechaIni($_REQUEST["fechaIni"]);
				$busquedaInformesBean->setFechaFin($_REQUEST["fechaFin"]);
			
				// Almacenamos en la sesion la busqueda
				Session::set(BUSQUEDA_INFORMES_BEAN, $busquedaInformesBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getAdminFachada();
				$listaInformes= array();
				try {
					$fachada->listarInformes($busquedaInformesBean, $listaInformes, $paginadoBean);
					include (HTML_ADMIN_INFORMES_PATH."/informesListados.php");
				} catch (InfDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_INFORMES_PATH."/errorListandoInformes.php");
				} catch (CrearInformeFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconocido";
					include (HTML_ADMIN_INFORMES_PATH."/errorListandoInformes.php");
				}
				break;					
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
	}
?>