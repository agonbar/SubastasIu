<?php
//namespace controlador;

/**
 * Clase controladora del caso de uso Listar Mis Subastas
 * @author Miguel Callon
 */
class ListarMisSubastasControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "listarSubastasPrivada":
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("idPedido" => "ordenacion.id",
					"fechaEnvio" => "ordenacion.fechaEnvio",
					"usuario" => "ordenacion.usuario",
					"nombreEstPed" => "ordenacion.nombreEstPed");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaSubastasBean = new BusquedaSubastasBean();
				$idUsuarioCreador = Session::get(ID_USUARIO_CONECTADO_KEY);
				$busquedaSubastasBean->setIdUsuCreador($idUsuarioCreador);
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_SUBASTAS_BEAN, $busquedaSubastasBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaSubastas= array();
				try {
					$fachada->listarSubastas($busquedaSubastasBean, $listaSubastas, $paginadoBean);
					include (HTML_PRIVADA_SUBASTAS_PATH."/misSubastasListadas.php");
				} catch (SubDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorListandoSubastas.php");
				} catch (CrearSubastaFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconodio";
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorListandoSubastas.php");
				}
				break;
			case "buscarSubastasPrivada":
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("idPedido" => "ordenacion.id",
					"fechaEnvio" => "ordenacion.fechaEnvio",
					"usuario" => "ordenacion.usuario",
					"nombreEstPed" => "ordenacion.nombreEstPed");
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
					include (HTML_PRIVADA_SUBASTAS_PATH."/misSubastasListadas.php");
				} catch (SubDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorListandoSubastas.php");
				} catch (CrearSubastaFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconodio";
					include (HTML_PRIVADA_SUBASTAS_PATH."/errorListandoSubastas.php");
				}
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>