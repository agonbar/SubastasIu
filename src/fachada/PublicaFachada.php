<?php
/**
 * Clase que implementa los metodos de la fachada publica.
 * @author Miguel Callon
 */
class PublicaFachada extends AbstractFachada implements IPublicaFachada {
	/**
	 * Se utiliza para actualizar las subastas y cambiar su estado
	 * @author Miguel Callon
	 */
	function comprobarSubastas() {
		$numPag = 1;
		$numElemPorPagina = 10;
		$paginadoBean = new PaginadoBean($numPag, "", $numElemPorPagina, "");
		$subastaDAO = new SubastaDAO();
		try {
			$busquedaSubastaBean = new BusquedaSubastasBean();
			$busquedaSubastaBean->setIdEstadosSubasta(array(ESTADO_SUBASTA_CREADA,
														ESTADO_SUBASTA_EN_PROCESO));
			$listaSubastas = array();
			$subastaDAO->listarSubastas($busquedaSubastaBean,
								   $listaSubastas, $paginadoBean);
			
			$fechaActual = new DateTime("now");
			$fechaActual = Fecha::formateaHtml2SQL($fechaActual->format("Y-m-d H:i:s"));
			foreach ($listaSubastas as $subasta) {
				if ($subasta->getIdEstadoSub() == ESTADO_SUBASTA_CREADA) {
					$fechaApertura = Fecha::formateaHtml2SQL($subasta->getFechaApertura());					
					if ($fechaActual >= $fechaApertura) {
						$subastaDAO->marcarSubastaAbierta($subasta->getIdSubasta());
					}
				} elseif ($subasta->getIdEstadoSub() == ESTADO_SUBASTA_EN_PROCESO) {
					$fechaCierre = Fecha::formateaHtml2SQL($subasta->getFechaCierre());
					if ($fechaActual >= $fechaCierre) {
						// Marcamos la subasta como cerrada
						$subastaDAO->marcarSubastaCerrada($subasta->getIdSubasta());
						
						$subastaBean = new SubastaBean();
						$subastaDAO->consultarSubasta($subasta->getIdSubasta(), $subastaBean,
									 new PaginadoBean(1, null, 10, null));
						// Si hay pujas creamos el pedido del ganador
						if (count($subastaBean->getListaPujas()) > 0) {
							$pedidoBean = new PedidoBean();
							$pedidoBean->setIdUsuarioComprador(
									$subastaBean->getPujaGanadora()->getIdUsuarioPuja());
							$pedidoBean->setIdUsuarioVendedor(
										$subastaBean->getCompSub()->getUsuarioVendedor()->getIdUsuario());
							$lineaPedido = new LineaPedidoBean();
							$lineaPedido->setComponente($subastaBean->getCompSub());
							$lineaPedido->setUnidades(1);
							$lineaPedido->setPrecioUnidad($subastaBean->getPujaGanadora()->getCantPujada());
							$pedidoBean->setLineasPedido(array($lineaPedido));
							
							$fachadaPrivada = FactoriaFachada::getPrivadaFachada();
							$fachadaPrivada -> crearPedido($pedidoBean);
							
							// Se envía una notificacion al propietario de la puja ganadora para que formalice
							// su pedido
							$notificacionBean = new NotificacionBean();
							$notificacionBean->setIdUsuarioOrigen(ID_USUARIO_ADMIN_PRINCIPAL);
							$notificacionBean->setIdUsuarioDestino(
										$subastaBean->getPujaGanadora()->getIdUsuarioPuja());
							$notificacionBean->setAsuntoNot(MultiIdioma::gettextoSinEcho("notificacion.subasta_ganadora"));
							$notificacionBean->setTextoNot(MultiIdioma::gettextoSinEcho("notificacion.subasta_ganadora.cuerpo"));
							$fachadaPrivada->enviarNotificacion($notificacionBean);
							
							// Se le envia una notificacion al propietario de la subasta de que se ha cerrado
							$notificacionBean = new NotificacionBean();
							$notificacionBean->setIdUsuarioOrigen(ID_USUARIO_ADMIN_PRINCIPAL);
							$notificacionBean->setIdUsuarioDestino(
										$subastaBean->getCompSub()->getUsuarioVendedor()->getIdUsuario());
							$notificacionBean->setAsuntoNot(MultiIdioma::gettextoSinEcho("notificacion.subasta_cerrada"));
							$notificacionBean->setTextoNot(MultiIdioma::gettextoSinEcho("notificacion.subasta_cerrada.cuerpo"));
							$fachadaPrivada->enviarNotificacion($notificacionBean);
						}
					}
				}
			}
		} catch (ListarSubastasDAOEx $ex) {
			throw new ListarSubastasFacEx($ex->getMessage());
		}
	}
	function listarSubastas(&$listaSubastas){		//santi
		$numPag = 0;
		$numElemPorPagina = 10;
		$paginadoBean = new PaginadoBean($numPag, "", $numElemPorPagina);
		$subastaDAO = new SubastaDAO();
		try {
			$subastaDAO->listarSubastas($listaSubastas, $paginadoBean);
			
		} catch (ListarSubastasDAOEx $ex) {
			throw new ListarSubastasFacEx($ex->getMessage());
		}
	}
	
	/**
	* Metodo que accede a la base de datos de usuarios mediante UsuarioDAO para consultar los datos de un usuario
	* @param $login login del usuario que se quiere consultar
	* @param $password password del usuario a buscar en la BD
	* @param $usuarioBean objeto bean del usuario que se busca
	* @author Nuria Canle
	*/
	function consultarDatosUsuario($login, $password, &$usuarioBean) {
		
		$userDAO = new UsuarioDAO();
		
		try {
			$userDAO->verificarLogin($login, $password, $usuarioBean);
			
		} catch (ClaveIncorrectaDAOEx $ex) {
			throw new LoginFacEx($ex->getMessage());
		}
	}
	
	/**
	* Metodo que accede a la base de datos de componentes y proporciona una lista de ellos siguiendo un paginado
	* @param $listaComponentes coleccion de componentes
	* @author Nuria Canle
	*/
	function listarComponentes (&$listaComponentes){
		$numPag = 0;
		$numElemPorPagina = 10;
		$paginadoBean = new PaginadoBean($numPag, "", $numElemPorPagina);
		$componenteDAO = new ComponenteDAO();
		try {
			$componenteDAO->listarComponentes($listaComponentes, $paginadoBean);
			
		} catch (ListarComponentesDAOEx $ex) {
			throw new ListarComponentesFacEx($ex->getMessage());
		}
	}
	
	/**
	 * Registra a un usuario.
	 * @param $busqueda Filtro de busqueda
	 * @param $listaComponente Lista de componentes
	 * @param $paginadoBean Objeto con los datos del paginado
	 * @author Miguel Callon
	 */
	function registrarUsuario (UsuarioBean $usuarioBean) {
		$usuarioDAO = new UsuarioDAO();
		try {
			// Comprobamos que no hay otro usuario en el sistema con el mismo usuario
			//$usuarioDAO->listarUsuarios($busquedaUsuariosBean, $listaUsuarios, 
			//	new PaginadoBean(1, null, 10, null));
			$usuarioBean->setIdEstadoUsuario(ESTADO_USUARIO_HABILITADO);
			$usuarioBean->setIsAdmin(ES_USUARIO_NORMAL);
			$usuarioDAO->registrarUsuario($usuarioBean);
		} catch (CrearUserDAOEx $ex) {
			throw new CrearUserFacEx($ex->getMessage());
		}
	}
}
?>