<?php
    //namespace controlador;

/**
 * Clase controladora del caso de uso listar usuarios.
 * @author Nuria Canle
 */
class ListarUsuariosControlador extends AdminControlador {
	public function __construct() {
		
	}
	
	/**
 	* Obtiene y muestra una lista de usuarios.
 	* @author Nuria Canle
 	*/
	protected function ejecutar($accion) {
		switch($accion) {				
			case "listarUsuariosAdmin":
				// Comprobamos si es admin
				$this->isAutenticadoAdmin();
				
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				// Asignamos los campos por los que podemos filtrar
				$camposOrden = array("idPedido" => "ordenacion.id",
					"fechaEnvio" => "ordenacion.fechaEnvio",
					"usuario" => "ordenacion.usuario",
					"nombreEstPed" => "ordenacion.nombreEstPed");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				$busquedaUsuariosBean = new BusquedaUsuariosBean();
				// Inicializamos en la sesion los datos de la busqueda
				Session::set(BUSQUEDA_USUARIOS_BEAN, $busquedaUsuariosBean);
				
				// La factoria devuelve un objeto factoria de la fachada de administrador
				$fachada = FactoriaFachada::getAdminFachada();//////////////////////////////
				$listaUsuarios= array();
				try {
					$fachada->listarUsuarios($busquedaUsuariosBean, $listaUsuarios, $paginadoBean);
					include (HTML_ADMIN_USUARIOS_PATH."/usuariosListados.php");
					
				} catch (SubDatosIncFacEx $ex) {/////////////////////////////////////////////////////
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_USUARIOS_PATH."/errorListandoUsuarios.php");
				} catch (ListarUsuariosFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconocido";
					include (HTML_ADMIN_USUARIOS_PATH."/errorListandoUsuarios.php");
				}
				break;
			case "buscarUsuariosAdmin":
				// Comprobamos si es admin
				$this->isAutenticadoAdmin();
				$orden = !isset($_REQUEST["orden"])?"":$_REQUEST["orden"]; // Nombre de los campos por los que ordena
				$pag = !isset($_REQUEST["pag"])?NUM_PAG_DEFAULT:$_REQUEST["pag"]; // Pagina actual
				$max = !isset($_REQUEST["max"])?NUM_ELEM_PAG_DEFAULT:$_REQUEST["max"]; // Num Elem por pagina
				$paginadoBean = new PaginadoBean($pag, $orden, $max, null);
				// Asignamos los campos por los que podemos filtrar
				$camposOrden = array("idPedido" => "ordenacion.id",
					"fechaEnvio" => "ordenacion.fechaEnvio",
					"usuario" => "ordenacion.usuario",
					"nombreEstPed" => "ordenacion.nombreEstPed");
				$paginadoBean->setCamposOrden($camposOrden);
				
				// Busqueda
				// Obtenemos de la sesion los datos de la busqueda
				$busquedaUsuariosBean = Session::get(BUSQUEDA_USUARIOS_BEAN);
				// Si no existe un objeto busquedaUsuariosBean lo creamos
				if (!isset($busquedaUsuariosBean)) {
					$busquedaUsuariosBean = new BusquedaUsuariosBean();
				}
				// Recogemos los parametros de la request
				$busquedaUsuariosBean->setIdUsuario($_REQUEST["idUsuario"]);
				$busquedaUsuariosBean->setNombre($_REQUEST["nombre"]);
				$busquedaUsuariosBean->setApellidos($_REQUEST["apellidos"]);
			;
				$busquedaUsuariosBean->setUsuario($_REQUEST["usuario"]);
				
				
				// Almacenamos en la sesion la busqueda
				Session::set(BUSQUEDA_USUARIOS_BEAN, $busquedaUsuariosBean);//////////////////////////////////////
				
				// La factoria devuelve un objeto factoria de la fachada publica
				$fachada = FactoriaFachada::getAdminFachada();
				$listaUsuarios= array();
				try {
					$fachada->listarUsuarios($busquedaUsuariosBean, $listaUsuarios, $paginadoBean);
					include (HTML_ADMIN_USUARIOS_PATH."/usuariosListados.php");
				} catch (SubDatosIncFacEx $ex) {/////////////////////////////////////////////////////////
					$ERRORES_FORM = $ex->getErrores();
					include (HTML_ADMIN_USUARIOS_PATH."/errorListandoUsuarios.php");
				} catch (ListarUsuariosFacEx $ex) {
					$ERRORES_FORM["error"] = "Error desconocido";
					include (HTML_ADMIN_USUARIOS_PATH."/errorListandoUsuarios.php");
				}		
				
				break;
			default:
				echo "accionNoEncontrada";
		}
	}
}
?>