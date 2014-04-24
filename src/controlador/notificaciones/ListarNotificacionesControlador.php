<?php

/**
 * Clase controladora del caso de uso Listar Notificaciones
 * @author Almudena Novoa
 */
class ListarNotificacionesControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "listarNotificacionesPrivada":
				$this->isAutenticadoPrivado();
				$orden = !isset($_REQUEST["orden"])?"fechaEnvioNot DESC":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("idNotificacion DESC" => "listadoNotificaciones.id",
					"asuntoNot DESC" => "listadoNotificaciones.asunto",
					"usuarioOrigen DESC" => "listadoNotificaciones.fecha_hora_envio",
					"idEstadoNotificacion DESC" => "listadoNotificaciones.estado");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaNotificacionesBean = new BusquedaNotificacionesBean();
				$busquedaNotificacionesBean->setIdUsuarioDestino(Session::get(ID_USUARIO_CONECTADO_KEY));
				
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_NOTIFICACIONES_BEAN, $busquedaNotificacionesBean);
				
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaNotificaciones= array();
				try {
					$fachada->listarNotificaciones($busquedaNotificacionesBean, $listaNotificaciones, $paginadoBean);
					include (HTML_PRIVADA_NOTIFICACIONES_PATH."/notificacionesListadas.php");
				} catch (NotDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_PRIVADA_NOTIFICACIONES_PATH."/errorListandoNotificaciones.php");
				} 
				
				break;					
			case "listarNotificacionesAdmin":
				// Comprobamos si es admin
				$this->isAutenticadoAdmin();
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("id" => "ordenacion.id",
					"asunto" => "ordenacion.asunto",
					"destinatario" => "ordenacion.destinatario",
					"estado" => "ordenacion.estado");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaNotificacionesBean = new BusquedaNotificacionesBean();
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_NOTIFICACIONES_BEAN, $busquedaNotificacionesBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaNotificaciones= array();
				try {
					$fachada->listarNotificaciones($busquedaNotificacionesBean, $listaNotificaciones, $paginadoBean);
					include (HTML_ADMIN_NOTIFICACIONES_PATH."/notificacionesListadas.php");
				} catch (NotDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_SUBASTAS_PATH."/errorListandoNotificaciones.php");
				} 
				break;
			case "buscarNotificacionesAdmin":
				// Comprobamos si es admin
				$this->isAutenticadoAdmin();
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				$camposOrden = array("id" => "ordenacion.id",
					"asunto" => "ordenacion.asunto",
					"destinatario" => "ordenacion.destinatario",
					"estado" => "ordenacion.estado");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				// Obtenemos de la sesion los datos de la busqueda
				$busquedaNotificacionesBean = Session::get(BUSQUEDA_NOTIFICACIONES_BEAN);
				// Si no existe un objeto busquedaPedidosBean lo creamos
				if (!isset($busquedaNotificacionesBean)) {
					$busquedaNotificacionesBean = new BusquedaNotificacionesBean();
				}
				// Recogemos los parametros de la request
				$busquedaNotificacionesBean->setIdNotificacion($_REQUEST["idNotificacion"]);
				$busquedaNotificacionesBean->setIdEstadoNotificacion($_REQUEST["idEstadoNotificacion"]);
				$busquedaNotificacionesBean->setIdUsuarioOrigen($_REQUEST["idUsuarioOrigen"]);
				$busquedaNotificacionesBean->setIdUsuarioDestino($_REQUEST["idUsuarioDestino"]);
				$busquedaNotificacionesBean->setTextoNot($_REQUEST["textoNot"]);
				$busquedaNotificacionesBean->setAsuntoNot($_REQUEST["asuntoNot"]);
				// Almacenamos en la sesion la busqueda
				Session::set(BUSQUEDA_NOTIFICACIONES_BEAN, $busquedaNotificacionesBean);
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getPrivadaFachada();
				$listaNotificaciones= array();
				try {
					$fachada->listarNotificaciones($busquedaNotificacionesBean, $listaNotificaciones, $paginadoBean);
					include (HTML_ADMIN_NOTIFICACIONES_PATH."/notificacionesListadas.php");
				} catch (NotDatosIncFacEx $ex) {
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_NOTIFICACIONES_PATH."/errorListandoNotificaciones.php");
				} 
				break;					
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>