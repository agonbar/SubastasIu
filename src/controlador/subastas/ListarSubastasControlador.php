<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Listar Subastas
 * @author Santiago Iglesias
 */
class ListarSubastasControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "listarSubastasPrivada":
				$this->isAutenticadoPrivado();
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("titulo" => "ordenacion.titulo",
					"usuario" => "ordenacion.usuario",
					"descripcionBreve" => "ordenacion.descripcionBreve",
					"fechaCierre" => "ordenacion.tiempoRestante");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaSubastasBean = new BusquedaSubastasBean();
				// Ojo solo mostramos las abiertas y las cerradas
				$busquedaSubastasBean->setIdEstadosSubasta(array(ESTADO_SUBASTA_EN_PROCESO, 
															ESTADO_SUBASTA_FINALIZADA));
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_SUBASTAS_BEAN, $busquedaSubastasBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaSubastas= array();
				try {
					$fachada->listarSubastas($busquedaSubastasBean, $listaSubastas, $paginadoBean);
					include (HTML_PRIVADA_SUBASTAS_PATH."/subastasListadas.php");
				} catch (SubDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorListandoSubastas.php");
				} catch (CrearSubastaFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconodio";
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorListandoSubastas.php");
				}
				break;
			case "buscarSubastasPrivada":
				$this->isAutenticadoPrivado();
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("titulo" => "ordenacion.titulo",
					"usuario" => "ordenacion.usuario",
					"descripcionBreve" => "ordenacion.descripcionBreve",
					"fechaCierre" => "ordenacion.tiempoRestante");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				// Obtenemos de la sesion los datos de la busqueda
				$busquedaSubastasBean = Session::get(BUSQUEDA_SUBASTAS_BEAN);
				// Si no existe un objeto busquedaPedidosBean lo creamos
				if (!isset($busquedaSubastasBean)) {
					$busquedaSubastasBean = new BusquedaSubastasBean();
				}
				// Recogemos los parametros de la request
				$busquedaSubastasBean->setNombreSubasta($_REQUEST["nombre"]);
				// Almacenamos en la sesion la busqueda
				Session::set(BUSQUEDA_SUBASTAS_BEAN, $busquedaSubastasBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaSubastas= array();
				try {
					$fachada->listarSubastas($busquedaSubastasBean, $listaSubastas, $paginadoBean);
					include (HTML_PRIVADA_SUBASTAS_PATH."/subastasListadas.php");
				} catch (SubDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorListandoSubastas.php");
				} catch (CrearSubastaFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconodio";
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorListandoSubastas.php");
				}
				break;					
			case "listarSubastasAdmin":
				// Comprobamos si es admin
				$this->isAutenticadoAdmin();
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("titulo" => "ordenacion.titulo",
					"usuario" => "ordenacion.usuario",
					"descripcionBreve" => "ordenacion.descripcionBreve",
					"fechaCierre" => "ordenacion.tiempoRestante");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaSubastasBean = new BusquedaSubastasBean();
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_SUBASTAS_BEAN, $busquedaSubastasBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaSubastas= array();
				try {
					$fachada->listarSubastas($busquedaSubastasBean, $listaSubastas, $paginadoBean);
					include (HTML_ADMIN_SUBASTAS_PATH."/subastasListadas.php");
				} catch (SubDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_SUBASTAS_PATH."/errorListandoSubastas.php");
				} catch (CrearSubastaFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconodio";
					include (HTML_ADMIN_SUBASTAS_PATH."/errorListandoSubastas.php");
				}
				break;
			case "buscarSubastasAdmin":
				// Comprobamos si es admin
				$this->isAutenticadoAdmin();
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("titulo" => "ordenacion.titulo",
					"usuario" => "ordenacion.usuario",
					"descripcionBreve" => "ordenacion.descripcionBreve",
					"fechaCierre" => "ordenacion.tiempoRestante");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				// Obtenemos de la sesion los datos de la busqueda
				$busquedaSubastasBean = Session::get(BUSQUEDA_SUBASTAS_BEAN);
				// Si no existe un objeto busquedaPedidosBean lo creamos
				if (!isset($busquedaSubastasBean)) {
					$busquedaSubastasBean = new BusquedaSubastasBean();
				}
				// Recogemos los parametros de la request
				$busquedaSubastasBean->setIdSubasta($_REQUEST["idSubasta"]);
				$busquedaSubastasBean->setNombreSubasta($_REQUEST["nombre"]);
				$busquedaSubastasBean->setNombreEstSub($_REQUEST["nombreEstSub"]);
				$busquedaSubastasBean->setIdUsuCreador($_REQUEST["idUsuCreador"]);
				$busquedaSubastasBean->setIdEstadosSubasta($_REQUEST["idEstadosSubasta"]);
				$busquedaSubastasBean->setIdUsuCreador($_REQUEST["idUsuCreador"]);
				$busquedaSubastasBean->setIdEstadosSubasta($_REQUEST["idEstadosSubasta"]);
				$busquedaSubastasBean->setNombreComp($_REQUEST["nombreComp"]);
				$busquedaSubastasBean->setNombreUsuario($_REQUEST["nombreUsuario"]);
				$busquedaSubastasBean->setFechaCreacionIni($_REQUEST["fechaCreacionIni"]);
				$busquedaSubastasBean->setFechaCreacionFin($_REQUEST["fechaCreacionFin"]);
				$busquedaSubastasBean->setFechaCierreIni($_REQUEST["fechaCierreIni"]);
				$busquedaSubastasBean->setFechaCierreFin($_REQUEST["fechaCierreFin"]);
				$busquedaSubastasBean->setFechaAperturaIni($_REQUEST["fechaAperturaIni"]);
				$busquedaSubastasBean->setFechaAperturaFin($_REQUEST["fechaAperturaFin"]);
				// Almacenamos en la sesion la busqueda
				Session::set(BUSQUEDA_SUBASTAS_BEAN, $busquedaSubastasBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaSubastas= array();
				try {
					$fachada->listarSubastas($busquedaSubastasBean, $listaSubastas, $paginadoBean);
					include (HTML_ADMIN_SUBASTAS_PATH."/subastasListadas.php");
				} catch (SubDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_SUBASTAS_PATH."/errorListandoSubastas.php");
				} catch (CrearSubastaFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconodio";
					include (HTML_ADMIN_SUBASTAS_PATH."/errorListandoSubastas.php");
				}
				break;					
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>