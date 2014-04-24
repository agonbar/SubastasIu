<?php
/**
 * Clase que implementa los metodos de la fachada de administrador.
 * @author Miguel Callon
 */
class AdminFachada extends AbstractFachada implements IAdminFachada {
	/**
	 * Metodo que devuelve una lista de subastas.
	 * @param $busquedaSubastasBean Objeto con los datos de la busqueda
	 * @param $listaSubastas vector con las subastas a mostrar.
	 * @param $paginadoBean objeto que permite mostrar el listado de forma paginada.
	 * @author Santiago Iglesias
	 */
	function listarSubastas(BusquedaSubastasBean $busquedaSubastasBean, &$listaSubastas, PaginadoBean $paginadoBean) {
		$subastaDAO = new SubastaDAO();
		try {
			$subastaDAO -> listarSubastas($busquedaSubastasBean, $listaSubastas, $paginadoBean);
		} catch (ListarSubastasDAOEx $ex) {
			throw new ListarSubastasFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que modifica un componente.
	 * @param $compBean objeto que permite modificar el componente.
	 * @author Santiago Iglesias
	 */
	function modificarComponente($idComponente, ComponenteBean $componente) {
			
		ValidarCampos::validarModificarComponente($componente);
		
		$componenteDAO = new ComponenteDAO();
		try {
			
			$componenteDAO -> modificarComponente($idComponente, $componente);
			

		} catch (CompDatosFacEx $ex) {
			throw new CompDatosFacEx($ex -> getMessage());
		}
	}

/**
	 * Metodo que da de alta un nuevo componente
	 * @param $idComponente Identificador del componente
	 * @author Santiago Iglesias
	 */
	function altaComponente(ComponenteBean $componente) {
		// Comprobamos que los campos son correctos
		ValidarCampos::validarAltaComponente($componente);

		// Llamamos al DAO para e insertamos
		$componenteDAO = new ComponenteDAO();
		try {
			$componente -> setIdUsuVendedor(Session::get(ID_USUARIO_CONECTADO_KEY));
			$componenteDAO -> altaComponente($componente);
		} catch (AltaComponenteDAOEx $ex) {
			throw new AltaComponenteFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Insertar fotos del componente
	 * @param $componenteBean ComponenteBean con lista de fotos
	 * @author Miguel Callon
	 */
	function insertarFotosComponente(ComponenteBean $componenteBean) {
		try {
			$fotoComponenteDAO = new FotoComponenteDAO();
			// Guardamos las fotos del componente
			foreach ($componenteBean->getListaFotos() as $foto) {
				// insertar foto
				// Le ponemos a la foto el id del componente con el que esta relacionado
				$foto->setIdCompFoto($componenteBean->getIdComponente());
				// Guardamos las fotos
				$fotoComponenteDAO->altaFotoComponente($componenteBean->getIdComponente(), $foto);
			}
		} catch (AltaFotoComponenteDAOEx $ex) {
			throw new AltaFotoComponenteFacEx($ex -> getMessage());
		}
	}
	
	
	/**
	 * Metodo que da de baja componente
	 * @param $idComponente Identificador del componente
	 * @author Santiago Iglesias
	 */
	function bajaComponente($idComponente) {

		//validamos que los datos estén correctos
		//ValidarCampos::validarBajaComponente($idComponente);

		$compDAO = new ComponenteDAO();

		try {
			$compDAO -> bajaComponente($idComponente);
		} catch (BajaComponenteDAOEx $ex) {
			throw new BajaComponenteFacEx($ex -> getMessage());
		}
	}
	

	/**
	 * Metodo que anula una subasta.
	 * @param $idPedido identificador del pedido a anular
	 * @author Adrian Gonzalez
	 */
	function anularPedidoDelSistema($idPedido) {
		
		$pedidoDAO = new PedidoDAO();
		
		try {
			
			$pedidoDAO -> anularPedudoDelSistema($idPedido);
			
		} catch (AnularPedidoDelSistemaDAOEx $ex) {
			throw new AnularPedidoDelSistemaDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que devuelve una lista de usuarios.
	 * @param $busquedaUsuariosBean Objeto con los datos de la busqueda
	 * @param $listaUsuarios vector con los usuarios a mostrar.
	 * @param $paginadoBean objeto que permite mostrar el listado de forma paginada.
	 * @author Nuria Canle
	 */
	function listarUsuarios(BusquedaUsuariosBean $busquedaUsuariosBean, &$listaUsuarios, PaginadoBean $paginadoBean) {
		$userDAO = new UsuarioDAO();
		try {
			$userDAO -> listarUsuarios($busquedaUsuariosBean, $listaUsuarios, $paginadoBean);
		} catch (ListarUsuariosDAOEx $ex) {
			throw new ListarUsuariosFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Lista los pedidos del sistema pasandole los filtros en un objeto
	 * busqueda.
	 * @param $busquedaPedido Objeto con los filtros de busqueda
	 * @param $listaPedidos Array que se pasa por referencia para obtener
	 * los objetos PedidoBean
	 * @param $paginado Objeto que se utiliza para el paginado
	 * @author Santiago Iglesias
	 */
	function listarPedidos(BusquedaPedidosBean $busquedaPedidosBean, &$listaPedidos, PaginadoBean $paginadoBean) {
		$pedidoDAO = new PedidoDAO();
		try {
			$pedidoDAO -> listarPedidos($busquedaPedidosBean, $listaPedidos, $paginadoBean);
		} catch (ListarPedidosDAOEx $ex) {
			throw new ListarPedidosFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Lista los pedidos del sistema pasandole los filtros en un objeto
	 * busqueda.
	 * @param $busquedaPedido Objeto con los filtros de busqueda
	 * @param $listaComponentes Array que se pasa por referencia para obtener
	 * los objetos ComponenteBean
	 * @param $paginado Objeto que se utiliza para el paginado
	 * @author Santiago Iglesias
	 */
	 function listarComponentes(BusquedaComponentesBean $busquedaComponentesBean, &$listaComponentes,PaginadoBean $paginadoBean){
		$componenteDAO = new ComponenteDAO();
		try {
			$componenteDAO -> listarComponentesAdmin($busquedaComponentesBean, $listaComponentes, $paginadoBean);
		} catch (ListarComponentesDAOEx $ex) {
			throw new ListarComponentesFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Modifica un componente
	 * @param $idComponente id del componente a modifica
	 * @param $compBean objeto con los datos a mostrar
	 * @author Santiago Iglesias
	 */
	function consultarComponente($idComponente, ComponenteBean $compBean) {
		$compDAO = new ComponenteDAO();
		try {
			$compDAO -> consultarComponente($idComponente, $compBean);
		} catch (ConsultarComponenteDAOEx $ex) {
			throw new ConsultarComponenteFacEx($ex -> getMessage());

		}
	}	
	
	/**
	 * Consulta Usuario
	 * @param $idComponente id del componente a modifica
	 * @param $compBean objeto con los datos a mostrar
	 * @author Santiago Iglesias
	 */
	function consultarDatosUsuario($idUsuario, UsuarioBean $usuarioBean) {
		$usuarioDAO = new UsuarioDAO();
		try {
			$usuarioDAO -> consultarDatosUsuario($idUsuario, $usuarioBean);
		} catch (ConsultarUsuarioDAOEx $ex) {
			throw new ConsultarUsuarioFacEx($ex -> getMessage());

		}
	}
	
	 /** Metodo que devuelve una lista de informes.
	 * @param $busquedaInformesBean Objeto con los datos de la busqueda
	 * @param $listaInformes vector con los informes a mostrar.
	 * @param $paginadoBean objeto que permite mostrar el listado de forma paginada.
	 * @author Nuria Canle
	 */
	function listarInformes(BusquedaInformesBean $busquedaInformesBean, &$listaInformes, PaginadoBean $paginadoBean) {
		$informeDAO = new InformeDAO();
		try {
			$informeDAO -> listarInformes($busquedaInformesBean, $listaInformes, $paginadoBean);
		} catch (ListarInformesDAOEx $ex) {
			throw new ListarInformesFacEx($ex -> getMessage());

		}
	}
	
	/**
	 * Modifica el detalle de un informe
	 * @fecha Fecha del informe a modificar
	 * @informeBean Objeto informe con los datos a modificar
	 * @author Nuria Canle
	 */
	public function modificarInforme($fecha, InformeBean $informeBean) {
		$informeDAO = new InformeDAO();
		try {
			$informeDAO -> modificarInforme($fecha, $informeBean);
		} catch (ModificarInformeDAOEx $ex) {
			throw new ModificarInformeFacEx($ex -> getMessage());
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
	 * Actualizar fotos del componente
	 * @param $componenteBean ComponenteBean con lista de fotos
	 * @author Miguel Callon
	 */
	function modificarFotosComponente(ComponenteBean $componenteBean) {
		try {
			$fotoComponenteDAO = new FotoComponenteDAO();
			// Guardamos las fotos del componente
			foreach ($componenteBean->getListaFotos() as $foto) {
				// Actualiza solo aquellos que se hayan actualizado
				if ($foto->getActualizada()) {
					$fotoComponenteDAO->modificarFotoComponente($componenteBean->getIdComponente(), $foto);
				}
			}
		} catch (AltaFotoComponenteDAOEx $ex) {
			throw new AltaFotoComponenteFacEx($ex -> getMessage());
		}
	}
	
	
	
}
?>