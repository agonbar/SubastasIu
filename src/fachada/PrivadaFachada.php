<?php
/**
 * Clase que implementa los metodos de la fachada privada.
 * @author Miguel Callon
 */
class PrivadaFachada extends AbstractFachada implements IPrivadaFachada {
	/**
	 * Modifica el detalle de una subasta
	 * @idSubasta Identificador de la subasta a modificar
	 * @subasta Objeto subasta con los datos a modificar
	 * @author Miguel Callon
	 */
	public function consultarPujaGanadora($idSubasta, PujaBean $pujaGanadoraBean) {
		$pujaDAO = new PujaDAO();
		try {
			$pujaDAO -> consultarPujaGanadoraSubasta($idSubasta, $pujaGanadoraBean); 
		} catch (NoExistenPujasDAOEx $ex) {
			throw new NoExistenPujasFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que realiza una puja en una subasta
	 * @param $idSubasta Id de la subasta donde se puja
	 * @param $puja Objeto con los datos de la puja
	 * @author Miguel Callon
	 */
	function pujar ($idSubasta, PujaBean $puja) {
		// Comprobamos que los campos son correctos
		ValidarCampos::validarPuja($puja);

		// Llamamos al DAO para e insertamos
		$pujaDAO = new PujaDAO();
		$subastaDAO = new SubastaDAO();
		$subastaBean = new SubastaBean();
		
		// Comprobamos que la subasta esta abierta
		try {
			$subastaDAO -> consultarSubasta($idSubasta, $subastaBean,
										new PaginadoBean(1, null, 10, null));
			if ($subastaBean -> getIdEstadoSub() != ESTADO_SUBASTA_EN_PROCESO) {
				throw new PujarFacEx("La subasta no esta abierta");
			}
		} catch (ConsultarSubastaDAOEx $ex) {
			throw new PujarFacEx($ex->getMessage());
		}
		
		try {	
			// Obtenemos primero la puja ganadora si existe
			$pujaGanadora = new PujaBean();
			$pujaDAO -> consultarPujaGanadoraSubasta($idSubasta, $pujaGanadora); 
			
			// Comparamos la puja actual con la puja ganadora para 
			// comprobar si la cuentia es mayor
			$cantGanadora = $pujaGanadora->getCantPujada();
			$cantPujada = $puja -> getCantPujada();
			if ($cantPujada <= $cantGanadora) {
				throw new CantidadPujadaIncorrectaFacEx();
			}
			
			// Si la puja es correcta cambiamos el estado de la puja
			// ganadora a perdedora
			$pujaDAO -> marcarPujaPerdedora($pujaGanadora->getIdPuja());
		} catch (MarcarPujaPerdedoraDAOEx $ex) {
			 throw new PujarFacEx($ex->getMessage());
		} catch (NoExistenPujasDAOEx $ex) {
			// Comprobamos que la puja realizada es mayor que el precio
			// inicial de la subasta
			if ($puja -> getCantPujada() <= $subastaBean -> getPrecioInicial()) {
				throw new CantidadPujadaIncorrectaFacEx();
			}
		}
				
		try {
			// Obtenemos la puja ganadora
			$pujaDAO = $pujaDAO -> insertarPuja($idSubasta, $puja);
		} catch (ConsultarPujaGanadoraSubDAOEx $ex) {
			throw new PujarFacEx($ex->getMessage());
		}
	}
	/**
	 * Metodo que crea una subasta
	 * @param $subasta Datos de la subasta para crear
	 * @author Miguel Callon
	 */
	function crearSubasta(SubastaBean $subasta) {
		// Comprobamos que los campos son correctos
		ValidarCampos::validarCrearSubasta($subasta);

		// Llamamos al DAO para e insertamos
		$subastaDAO = new SubastaDAO();
		try {
			// Guardamos el id de usuario conectado
			$subasta -> setIdUsuCreador(Session::get(ID_USUARIO_CONECTADO_KEY));
			$fechaActual = new DateTime("now");
			// Guardamos la fecha de creacion
			$subasta -> setFechaCreacion($fechaActual -> format('Y-m-d H:i:s'));
			
			// Componemos la fecha de apertura de la fecha de cierre
			$fechaApertura = $subasta->getFechaApertura()." ".$subasta->getHoraApertura();
			$subasta->setFechaApertura(Fecha::formateaHtml2SQL($fechaApertura));
			$fechaCierre = $subasta->getFechaCierre()." ".$subasta->getHoraCierre();
			$subasta->setFechaCierre(Fecha::formateaHtml2SQL($fechaCierre));
			
			// El estado de la subasta sera creado
			$subasta -> setIdEstadoSub(ESTADO_SUBASTA_CREADA);
			
			$subastaDAO -> crearSubasta($subasta);
			// Iniciamos un proceso que controle el final de la subasta
			// No hay permisos para ejecutar la subasta
			// Procesos::crearMonitorSubasta($idSubasta);

		} catch (CrearSubastaDAOEx $ex) {
			throw new CrearSubastaFacEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que modifica la fecha de cierre de una subasta
	 * @param $idSubasta subasta a modificar
	 * @param $nuevaFechaCierre Datos de la subasta a modificar
	 * @param $idUsuCreador Id del usuario creador de la subasta
	 * @author Miguel Callon
	 */
	function modificarFinDeSubasta($idSubasta, $nuevaFechaCierre, $idUsuCreador) {
		// Llamamos al DAO para e insertamos
		$subastaDAO = new SubastaDAO();
		try {
			$subastaBean = new SubastaBean();
			$subastaDAO -> consultarSubasta($idSubasta, $subastaBean, new PaginadoBean(1, null, 10, null));
			// Comprobamos que el usuario creador de la subasta
			// es el usuario que quiere cancelarla
			if ($idUsuCreador != $subastaBean -> getIdUsuCreador()) {
				throw new ModificarFinDeSubastaFacEx("Usuario incorrecto");
			}

			// Cambiamos la fecha de cierre de la subasta
			$subastaDAO -> modificarFinDeSubasta($idSubasta, $nuevaFechaCierre);
		} catch (ModificarFinDeSubastaDAOEx $ex) {
			throw new ModificarFinDeSubastaFacEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que crea una subasta
	 * @param $subasta Datos de la subasta para crear
	 * @author Miguel Callon
	 */
	function cancelarSubasta($idSubasta, $idUsuCreador) {
		// Llamamos al DAO para e insertamos
		$subastaDAO = new SubastaDAO();
		try {
			$subastaBean = new SubastaBean();
			$subastaDAO -> consultarSubasta($idSubasta, $subastaBean, new PaginadoBean(1, null, 10, null));
			// Comprobamos que el usuario creador de la subasta
			// es el usuario que quiere cancelarla
			if ($idUsuCreador != $subastaBean -> getIdUsuCreador()) {
				throw new CancelarSubastaFacEx("Usuario incorrecto");
			}
			// Coomprobamos que la subasta esta abierta
			if ($subastaBean -> getIdEstadoSub() != ESTADO_SUBASTA_CREADA && $subastaBean -> getIdEstadoSub() != ESTADO_SUBASTA_EN_PROCESO) {
				throw new CancelarSubastaFacEx("Estado incorrecto");
			}
			// Guardamos en el historico el cambio de estado
			$historicoSubastaDAO = new HistoricoSubastaDAO();
			$historicoSubastaBean = new HistoricoSubastaBean();
			$historicoSubastaBean -> setIdSubasta($subastaBean -> getIdSubasta());
			$historicoSubastaBean -> setIdEstadoIniSub($subastaBean -> getIdEstadoSub());
			$historicoSubastaBean -> setIdEstadoFinSub(ESTADO_SUBASTA_CANCELADA);
			$historicoSubastaBean -> setIdEstadoFinSub(MOTIVO_CIERRE_PROPIETARIO_CANCELA);
			$historicoSubastaDAO -> insertarHistoricoSubasta($historicoSubastaBean);

			// Cambiamos el estado de la subasta
			$subastaDAO -> cancelarSubasta($idSubasta);
		} catch (CancelarSubastaDAOEx $ex) {
			throw new CancelarSubastaFacEx($ex -> getMessage());
		}
	}

	/**
	 * Modifica el detalle de una subasta
	 * @idSubasta Identificador de la subasta a modificar
	 * @subasta Objeto subasta con los datos a modificar
	 * @author Miguel Callon
	 */
	public function modificarSubasta($idSubasta, SubastaBean $subasta) {
		$subastaDAO = new SubastaDAO();
		try {
			$subastaDAO -> modificarSubasta($idSubasta, $subasta);
		} catch (ModificarSubastaDAOEx $ex) {
			throw new ModificarSubastaFacEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que devuelve detalle de una subasta
	 * @param $idSubasta Identificador de la subasta
	 * @param $subastaBean SubastaBean con los datos de la subasta
	 * @param $paginadoBean parametros del paginado
	 * @author Miguel Callon
	 */
	function consultarSubasta($idSubasta, SubastaBean &$subastaBean, PaginadoBean $paginadoBean) {
		$subastaDAO = new SubastaDAO();
		try {
			$subastaDAO -> consultarSubasta($idSubasta, $subastaBean, $paginadoBean);
		} catch (ConsultarSubastaDAOEx $ex) {
			throw new ConsultarSubastaFacEx($ex -> getMessage());
		}
	}

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
	 * Crear pedido
	 * @param $pedidoBean datos del pedido
	 * @author Miguel Callon
	 */
	public function crearPedido(PedidoBean $pedidoBean) {
		$pedidoDAO = new PedidoDAO();
		try {
			$pedidoDAO -> crearPedido($pedidoBean);
		} catch (CrearPedidoDAOEx $ex) {
			throw new CrearPedidoFacEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que devuelve un pedido por el identificador del pedido.
	 * @param $idPedido Identificador del pedido
	 * @param $pedidoBean PedidoBean con los datos del pedido
	 * @author Santiago Iglesias
	 */
	function consultarPedido($idPedido, PedidoBean $pedidoBean) {
		$pedidoDAO = new PedidoDAO();
		try {
			$pedidoDAO -> consultarPedido($idPedido, $pedidoBean);
		} catch (ConsultarPedidoDAOEx $ex) {
			throw new ConsultarPedidoDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que acepta un pedido por el identificador del pedido.
	 * @param $idPedido Identificador del pedido
	 * @author Santiago Iglesias
	 */
	function aceptarPedido($idPedido) {
		$pedidoDAO = new PedidoDAO();
		try {
			$pedidoBean = new PedidoBean();
			$pedidoDAO -> consultarPedido($idPedido, $pedidoBean);

			$usuarioVendedor = $pedidoBean -> getUsuarioVendedor();

			// Calculo de porcentaje que se lleva la plataforma
			$porcentagePlat = $pedidoBean -> getTotal() * PORCENTAJE_PLATAFORMA;

			// Pagamos el vendedor su parte
			$datosPago = new DatosPagoBean();
			$datosPago -> setCuentaOrigen(CUENTA_PAYPAL_PLATAFORMA);
			$datosPago -> setCuentaDestino($usuarioVendedor -> getCuentaPayPal());
			$datosPago -> setImporte($pedidoBean -> getTotal());

			$pago = new PagoPayPalAdaptador();
			$pagado = $pago -> pagar($datosPago);

			// Generamos una transaccion
			$transaccionDAO = new TransaccionDAO();
			// Transaccion del comprador a la plataforma
			$fecha = date("n/j/Y H:m:s");
			$tranCliPla = new TransaccionBean("", $idPedido, ID_USUARIO_ADMIN, $usuarioVendedor -> getIdUsuario(), $fecha, PAGO_PLATAFORMA_VENDEDOR, $datosPago -> getImporte() - PORCENTAJE_PLATAFORMA);
			$transaccionDAO -> insertarTransaccion($tranCliPla);

			// Transaccion indicando el porcentaje de la venta
			// que se lleva la plataforma
			$tranCliPla = new TransaccionBean("", $idPedido, $usuarioVendedor -> getIdUsuario(), ID_USUARIO_ADMIN, $fecha, PAGO_VENDEDOR_PLATAFORMA, PORCENTAJE_PLATAFORMA);
			$transaccionDAO -> insertarTransaccion($tranCliPla);

			$pedidoDAO -> aceptarPedido($idPedido);
		
			// Envio una notificacion al vendedor para que sepa que tiene
			// que confirmar el pedido
			$notificacionBean = new NotificacionBean();
			$notificacionBean->setIdUsuarioOrigen(ID_USUARIO_ADMIN_PRINCIPAL);
			$notificacionBean->setIdUsuarioDestino($pedidoBean->getUsuarioComprador()->getIdUsuario());
			$notificacionBean->setAsuntoNot(MultiIdioma::gettextoSinEcho("notificacion.espera_confirmacion_comprador"));
			$notificacionBean->setTextoNot(MultiIdioma::gettextoSinEcho("notificacion.espera_confirmacion_comprador.cuerpo"));
			$this->enviarNotificacion($notificacionBean);
		} catch (AceptarPedidoDAOEx $ex) {
			throw new AceptarPedidoDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que rechaza un pedido
	 * @param $idPedido Identificador del pedido
	 * @author Santiago Iglesias
	 */
	function rechazarPedido($idPedido) {
		$pedidoDAO = new PedidoDAO();
		try {
			$pedidoDAO -> rechazarPedido($idPedido);
		} catch (RechazarPedidoDAOEx $ex) {
			throw new RechazarPedidoDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Realizar pago
	 * @param $idPedido Identificador del pedido
	 * @param $datosPago Datos de pago del pedido
	 * @author Miguel Callon
	 */
	function realizarPagoPedido($idPedido, DatosPagoBean $datosPago) {
		try {
			$pedidoBean = new PedidoBean();
			$pedidoDAO = new PedidoDAO();
			$pedidoDAO -> consultarPedido($idPedido, $pedidoBean);
			// Introducimos los datos de envio, si quiere
			// utilizar sus datos de usuario por defecto
			// le introducimos los del comprador
			if ($datosPago -> getTipoEnvio() == TIPO_ENVIO_DEFAULT) {
				$usuarioComprador = $pedidoBean -> getUsuarioComprador();
			}
			// Comprobamos que los campos de envio son correctos
			ValidarCampos::validarDatosPago($datosPago);

			// Se realiza el pago contra la plataforma
			$pago = new PagoPayPalAdaptador();
			$pagado = $pago -> pagar($datosPago);
			if ($pagado == true) {
				// Generamos una transaccion
				$transaccionDAO = new TransaccionDAO();

				// Transaccion del comprador a la plataforma
				$fecha = date("n/j/Y H:m:s");
				$tranCliPla = new TransaccionBean("", $idPedido, $usuarioComprador -> getIdUsuario(), ID_USUARIO_ADMIN, $fecha, PAGO_COMPRADOR_PLATAFORMA, $datosPago -> getImporte() - PORCENTAJE_PLATAFORMA);
				$transaccionDAO -> insertarTransaccion($tranCliPla);

				// Cambiamos el pedido al nuevo estado
				$pedidoDAO -> marcarPedidoEnTramite($idPedido);

				// Envio una notificacion al vendedor para que sepa que tiene
				// que confirmar el pedido
				$notificacionBean = new NotificacionBean();
				$notificacionBean->setIdUsuarioOrigen(ID_USUARIO_ADMIN_PRINCIPAL);
				$notificacionBean->setIdUsuarioDestino($pedidoBean->getUsuarioVendedor()->getIdUsuario());
				$notificacionBean->setAsuntoNot(MultiIdioma::gettextoSinEcho("notificacion.espera_confirmacion_vendedor"));
				$notificacionBean->setTextoNot(MultiIdioma::gettextoSinEcho("notificacion.espera_confirmacion_vendedor.cuerpo"));
				$this->enviarNotificacion($notificacionBean);
			}
		} catch (ConsultarPedidoDAOEx $ex) {
			throw new ConsultarPedidoFacEx($ex -> getMessage());
		} catch (MarcarPedidoEnTramiteDAOEx $ex) {
			throw new MarcarPedidoEnTramiteFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Lista los pedidos del sistema pasandole los filtros en un objeto
	 * busqueda.
	 * @param $busquedaPedido Objeto con los filtros de busqueda
	 * @param $listaPedidos Array que se pasa por referencia para obtener
	 * los objetos PedidoBean
	 * @param $paginado Objeto que se utilia para el paginado
	 */
	function listarPedidosEnviados(BusquedaPedidosBean $busquedaPedido, &$listaPedidos, PaginadoBean $paginadoBean,$idUsuConectado) {
		$pedidoDAO = new PedidoDAO();
		try {
			$pedidoDAO -> listarPedidosEnviados($busquedaPedido, $listaPedidos, $paginadoBean,$idUsuConectado);
		} catch (ListarPedidosDAOEx $ex) {
			throw new ListarPedidosFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Lista los pedidos del sistema pasandole los filtros en un objeto
	 * busqueda.
	 * @param $busquedaPedido Objeto con los filtros de busqueda
	 * @param $listaPedidos Array que se pasa por referencia para obtener
	 * los objetos PedidoBean
	 * @param $paginado Objeto que se utilia para el paginado
	 */
	function listarPedidosRecibidos(BusquedaPedidosBean $busquedaPedido, &$listaPedidos, PaginadoBean $paginadoBean,$idUsuConectado) {
		$pedidoDAO = new PedidoDAO();
		try {
			$pedidoDAO -> listarPedidosRecibidos($busquedaPedido, $listaPedidos, $paginadoBean,$idUsuConectado);
		} catch (ListarPedidosDAOEx $ex) {
			throw new ListarPedidosFacEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que marca un pedido como recibido usando el identificador del pedido.
	 * @param $idPedido Identificador del pedido
	 * @author Santiago Iglesias
	 */
	function marcarPedidoRecibido($idPedido) {
		$pedidoDAO = new PedidoDAO();
		try {
			$pedidoDAO -> marcarPedidoRecibido($idPedido);
		} catch (MarcarPedidoRecibidoDAOEx $ex) {
			throw new MarcarPedidoRecibidoDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que marca un pedido como no recibido usando el identificador del pedido.
	 * @param $idPedido Identificador del pedido
	 * @author Santiago Iglesias
	 */
	function marcarPedidoNoRecibido($idPedido) {
		$pedidoDAO = new PedidoDAO();
		try {
			$pedidoDAO -> marcarPedidoNoRecibido($idPedido);
		} catch (MarcarPedidoNoRecibidoDAOEx $ex) {
			throw new MarcarPedidoNoRecibidoDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que da de alta un nuevo componente
	 * @param $idComponente Identificador del componente
	 * @author Almudena Novoa
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

	/**
	 * Metodo para modificar datos de un componente
	 * Valida previamente los campos y si todo esta correcto actualiza
	 * @param $componente Objeto con datos del componente para poder guardar en la BD
	 * @author Almudena Novoa
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
	 * Lista los componentes del sistema.
	 * @param $busqueda Filtro de busqueda
	 * @param $listaComponente Lista de componentes
	 * @param $paginadoBean Objeto con los datos del paginado
	 * @author Nuria Canle
	 */
	function listarComponentes(BusquedaComponentesBean $busqueda, &$listaComponentes, PaginadoBean $paginadoBean) {
		$componenteDAO = new ComponenteDAO();
		try {
			$componenteDAO -> listarComponentes($busqueda, $listaComponentes, $paginadoBean);

		} catch (ListarComponentesDAOEx $ex) {
			throw new ListarComponentesFacEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo para modificar datos de un usuario
	 * Valida previamente los campos y si todo esta correcto actualiza
	 * @param $datos Objeto con datos del usuario para poder guardar en la BD
	 * @author Adrian Gonzalez
	 */
	function modificarDatos(UsuarioBean $datos) {
		ValidarCampos::validarModificarDatos($datos);

		$usuarioDAO = new UsuarioDAO();

		try {

			$usuarioDAO -> modificarDatos($datos);

		} catch (DatUserDAOEX $ex) {
			throw new DatUserFacEx($ex -> getMessage());
		}
	}
	
		/**
	 * Metodo para modificar datos de un usuario
	 * Valida previamente los campos y si todo esta correcto actualiza
	 * @param $datos Objeto con datos del usuario para poder guardar en la BD
	 * @author Adrian Gonzalez
	 */
	function modificarUsuario(UsuarioBean $usuario) {
		ValidarCampos::validarModificarDatos($usuario);

		$usuarioDAO = new UsuarioDAO();

		try {

			$usuarioDAO -> modificarDatos($usuario);

		} catch (modificarUsuarioDAOEx $ex) {
			throw new modificarUsuarioDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo para modificar contrasena de un usuario
	 * Valida previamente los campos y si todo esta correcto actualiza
	 * @param $claveNueva la nueva contrasena para el usuario
	 * @param $usuario Objeto con datos del usuario para poder guardar en la BD
	 * @author Adrian Gonzalez
	 */
	function modificarContrasena($idUsuario, DatosCambiarClaveBean $datosCambiarClave) {
		ValidarCampos::validarCambiarClave($datosCambiarClave);
		$usuarioDAO = new UsuarioDAO();
		try {
			$usuarioBean = new UsuarioBean();
			// Obtenemos la clave del usuario
			$usuarioDAO->consultarDatosUsuario($idUsuario, $usuarioBean);
			
			echo "clave: ".$usuarioBean->getClave();
			echo "claveActual: ".$datosCambiarClave->getClaveActual();
			
			// Si la clave es incorrecta lanzamos la excepcion
			if ($usuarioBean->getClave() != $datosCambiarClave->getClaveActual()) {
				$exClaveIncorrecta = new DatUserIncFacEx();
				$errores = array("errorClaveIncorrecta" => true);
				$exClaveIncorrecta -> setErrores($errores);
				throw $exClaveIncorrecta;
			}
			
			// Si es correcta modificamos la contrasena
			$usuarioDAO -> modificarContrasena($idUsuario, $datosCambiarClave->getClaveNueva());
		} catch (datPassDAOEx $ex) {
			throw new datPassDAOEx($ex -> getMessage());
		}
	}
	
	/**
	* Metodo para recuperar contrasena de un usuario
	* Valida previamente los campos y si todo esta correcto obtiene datos
	* @param $usuario Objeto con idUsuario para poder consultar
	* @author Adrian Gonzalez
	*/
	 
	function recuperarContrasena(UsuarioBean $usuario) {
		ValidarCampos::validarModificarDatos($usuario);

		$usuarioDAO = new UsuarioDAO();

		try {

			$usuarioDAO -> recuperarContrasena($usuario);

		} catch (datPassDAOEx $ex) {
			throw new datPassFacEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que devuelve los datos de un componente al pasarle su identificador.
	 * @param $idComponente Identificador del componente a consultar.
	 * @param $compBean ComponenteBean con los datos del componente.
	 * @author Nuria Canle
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
	 * Metodo que elimina un componente al pasarle su identificador.
	 * @param $idComponente Identificador del componente a dar de baja.
	 * @author Adrian Gonzalez
	 */
	function bajaComponente($idComponente) {

		//validamos que los datos estén correctos
		ValidarCampos::validarBajaComponente($idComponente);

		$compDAO = new ComponenteDAO();

		try {
			$compDAO -> bajaComponente($idComponente);
		} catch (BajaComponenteDAOEx $ex) {
			throw new BajaComponenteFacEx($ex -> getMessage());
		}
	}

	/**
	 * @param $idFactura Identificador de la factura
	 * @param $facturaBean FacturaBean con los datos del pedido
	 * @author Adrian Gonzalez
	 */
	function consultarFactura($idFactura, FacturaBean $facturaBean) {
		$facturaDAO = new facturaDAO();
		try {
			$facturaDAO -> consultarFactura($idFactura, $facturaBean);
		} catch (ConsultarFacturaDAOEx $ex) {
			throw new ConsultarPedidoDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que devuelve los datos del carrito desde la sesion.
	 * @param $carritoBean Bean vacio del carrito a rellenar
	 * @author Hector Riopedre
	 */	 
	function consultarCarrito(CarritoBean $carritoBean) {
		try {
			$carritoBean = Session::get(CARRITO_BEAN_KEY);
			if (empty($carritoBean -> listaComponentes)){
				throw new ConsultarCarritoFacEx('Carrito vacio');
			}
		} catch (ConsultarCarritoFacEx $ex) {
			throw new ConsultarCarritoFacEx($ex -> getMessage());

		}
	}
	/**
	 * Metodo que inserta un componente al carrito.
	 * @param $lineaPedidoBean LineaPedidoBean del componente a insertar.
	 * @author Hector Riopedre
	 */
	function anhadirAlCarrito(LineaPedidoBean $lineaPedidoBean) {
		try {
			$carritoBean = Session::get(CARRITO_BEAN_KEY);
			$carritoBean -> addComponente($lineaPedidoBean);
			Session::set(CARRITO_BEAN_KEY, $carritoBean);
		} catch (ConsultarComponenteFacEx $ex) {
			throw new ConsultarComponenteFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que devuelve los datos del carrito desde la sesion.
	 * @param $carritoBean Bean vacio del carrito a rellenar
	 * @author Hector Riopedre
	 */	 
	function eliminarDeCarrito($id) {
		try {
			$carritoBean = Session::get(CARRITO_BEAN_KEY);
			$carritoBean -> removeComponente($id);
			Session::set(CARRITO_BEAN_KEY, $carritoBean);
			
		} catch (EliminarDeCarritoFacEx $ex) {
			throw new ConsultarCarritoFacEx($ex -> getMessage());

		}
	}
	
	
	/**
	 * Metodo que da de baja a un usuario
	 * @idUsuario Identificador del usuario conectado que se va a dar de baja
	 * @author Santiago Iglesias
	 */
	public function darBaja($idUsuario) {
		$usuarioDAO = new UsuarioDAO();
		try {
			$usuarioDAO -> darBajaUsuario($idUsuario);
		} catch (DatUserDAOEx $ex) {
			throw new DatUserFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo selecciona ese usuario como administrador.
	 * @param usuario UsuarioBean con el id del usuario a poner como administrador
	 * @author Adrian Gonzalez
	 */
	
	function crearUsuarioPrivilegiado($idUsuario) {
		
		ValidarCampos::validarNuevoUsuario($idUsuario);

		$usuarioDAO = new UsuarioDAO();

		try {

			$usuarioDAO -> crearUsuarioPrivilegiado($idUsuario);

		} catch (usuarioPrivilegiadoDAOEx $ex) {
			throw new usuarioPrivilegiadoDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo elimina usuario por Id
	 * @param usuario UsuarioBean con el id del usuario a eliminar
	 * @author Adrian Gonzalez
	 */
	
	function eliminarUsuario($idUsuario) {
		
		ValidarCampos::validarNuevoUsuario($idUsuario);

		$usuarioDAO = new UsuarioDAO();

		try {

			$usuarioDAO -> eliminarUsuario($idUsuario);

		} catch (eliminarUsuarioDAOEx $ex) {
			throw new eliminarUsuarioFacEx($ex -> getMessage());
		}
	}
	
	function consultarDatosUsuario($idUsuario, UsuarioBean $usuario) {
		ValidarCampos::validarModificarDatos($usuario);
		$usuarioDAO = new UsuarioDAO();
		try {
			$usuarioDAO -> consultarDatosUsuario($idUsuario, $usuario);
		} catch (consultarDatosUsuarioDAOEx $ex) {
			throw new consultarDatosUsuarioFacExx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que devuelve una lista de notificaciones.
	 * @param $busquedaNotificacionesBean Objeto con los datos de la busqueda
	 * @param $listaNotificaciones vector con las notificaciones a mostrar.
	 * @param $paginadoBean objeto que permite mostrar el listado de forma paginada.
	 * @author Miguel Callon
	 */
	function enviarNotificacion(NotificacionBean $notificacionBean) {
		$notificacionDAO = new NotificacionDAO();
		try {
			$notificacionDAO -> insertarNotificacion(
					$notificacionBean);
		} catch (InsertarNotificacionDAOEx $ex) {
			throw new EnviarNotificacionFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que devuelve el numero de mensajes que quedan sin leer
	 * para un usuario dado
	 * @param $idUsuario del usuario del que se consultan sus mensajes
	 * @return numero de mensajes sin leer
	 * @author Miguel Callon
	 */
	function numNotificacionesSinLeer($idUsuario) {
		$notificacionDAO = new NotificacionDAO();
		try {
			return $notificacionDAO -> consultarNumNotificacionesSinLeer($idUsuario);
		} catch (ListarNotificacionesDAOEx $ex) {
			throw new ListarNotificacionesFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que devuelve una lista de notificaciones.
	 * @param $busquedaNotificacionesBean Objeto con los datos de la busqueda
	 * @param $listaNotificaciones vector con las notificaciones a mostrar.
	 * @param $paginadoBean objeto que permite mostrar el listado de forma paginada.
	 * @author Miguel Callon
	 */
	function listarNotificaciones(BusquedaNotificacionesBean $busquedaNotificacionesBean,
		 &$listaNotificaciones, PaginadoBean $paginadoBean) {
		$notificacionDAO = new NotificacionDAO();
		try {
			$notificacionDAO -> listarNotificaciones(
					$busquedaNotificacionesBean, $listaNotificaciones, $paginadoBean);
		} catch (ListarNotificacionesDAOEx $ex) {
			throw new ListarNotificacionesFacEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que devuelve la informacion de una notificacion
	 * @param $idMensaje Identificador de la notificacion a consultar.
	 * @param $notificacionBean NotificacionBean con los datos de la notificacion.
	 * @author Almudena Novoa 
	 */
	 function consultarNotificacion($idNotificacion, NotificacionBean $notificacionBean){
	 	$notificacionDAO = new NotificacionDAO();
		try {
			$notificacionDAO -> consultarNotificacion($idNotificacion, $notificacionBean);
			
			// La marco como leida
			$notificacionDAO -> marcarNotificacionLeida($idNotificacion);
		} catch (MarcarNotificacionLeidaDAOEx $ex) {
			throw new ConsultarNotificacionFacEx($ex -> getMessage());
		} catch (ConsultarNotificacionDAOEx $ex) {
			throw new ConsultarNotificacionFacEx($ex -> getMessage());
		}
	 }

}
?>