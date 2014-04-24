<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL.
 * @author Miguel Callon
 */
class SubastaDAO extends MysqlDAO implements ISubastaDAO {
	/**
	 * Pone la subasta en estado abierta
	 * @param $idSubasta Id de subasta
	 * @author Miguel Callon
	 */
	public function marcarSubastaAbierta($idSubasta) {
		if (!isset($idSubasta)) {
			throw new MarcarSubastaAbiertaDAOEx("Id subasta no especificado");
		}
			
		$sql = "update Subasta set idEstadoSub = ".ESTADO_SUBASTA_EN_PROCESO." where
				idSubasta = ".$idSubasta;
		try {
			mysql_query($sql);
		} catch (Exception $ex) {
			throw new MarcarSubastaAbiertaDAOEx($ex -> getMessage());
		}			
	}
	/**
	 * Pone la subasta en estado cerrado
	 * @param $idSubasta Id de subasta
	 * @author Miguel Callon
	 */
	public function marcarSubastaCerrada($idSubasta) {
		if (!isset($idSubasta)) {
			throw new MarcarSubastaCerradaDAOEx("Id subasta no especificado");
		}
			
		$sql = "update Subasta set idEstadoSub = ".ESTADO_SUBASTA_FINALIZADA." where
				idSubasta = ".$idSubasta;
		try {
			mysql_query($sql);
		} catch (Exception $ex) {
			throw new MarcarSubastaCerradaDAOEx($ex -> getMessage());
		}			
	}
	
	public function crearSubasta(SubastaBean $subasta) {
		//echo "<br/>insertar:".$subasta->toString();
		$sql = " insert into Subasta (idUsuCreador, idEstadoSub, idCompSub,
									  numCompSub,						  
									  titulo, descripcionBreve, descripcion,
									  fechaCierre, fechaApertura,
									  fechaCreacion, precioInicial,
									  idFotoComp, tituloFotoSub,
									  desFotoSub, rutaFotoSub)
			 values ('" . $subasta -> getIdUsuCreador() . "',
			 '" . $subasta->getIdEstadoSub(). "',
			 '". $subasta->getIdCompSub() ."',
			 '". $subasta->getNumCompSub() ."',
			 '" . $subasta -> getTitulo() . "',
			 '" . $subasta -> getDescripcionBreve() . "',
			 '" . $subasta -> getDescripcion() . "',
			 '" . Fecha::formateaHtml2SQL($subasta -> getFechaCierre())."',
			 '" . Fecha::formateaHtml2SQL($subasta -> getFechaApertura())."',
			 '" . Fecha::formateaHtml2SQL($subasta -> getFechaCreacion())."',
			 '" . $subasta -> getPrecioInicial()."',
			 '" . $subasta -> getIdFotoComp()."',
			 '" . $subasta -> getTituloFotoSub()."',
			 '" . $subasta -> getDesFotoSub()."',
			 '" . $subasta -> getRutaFotoSub()."'
			 )";
		//echo $sql;
		try {
			mysql_query($sql);
			// Obtenemos el identificador de la ultima insercion
			$id = $this->getIdUltimaInsercion();			
			$subasta->setIdSubasta($id);
		} catch (Exception $ex) {
			throw new CrearSubastaDAOEx($ex -> getMessage());
		}
	}
	/**
	 * Modifica el detalle de una subasta
	 * @idSubasta Identificador de la subasta a modificar
	 * @subasta Objeto subasta con los datos a modificar
	 * @author Miguel Callon
	 */
	public function modificarSubasta($idSubasta, SubastaBean $subasta) {
		//echo "<br/>insertar:".$subasta->toString();
		$sql = "update Subasta set 
			idUsuCreador = '".$subasta -> getIdUsuCreador()."',
			idEstadoSub = '".$subasta -> getIdEstadoSub()."' ,
			idCompSub = '".$subasta -> getIdCompSub()."' ,
			numCompSub = '".$subasta -> getNumCompSub()."' ,
			titulo = '".$subasta -> getTitulo()."' ,
			descripcionBreve = '".$subasta -> getDescripcionBreve()."' ,
			descripcion = '".$subasta -> getDescripcion()."',
			fechaCierre = '".$subasta -> getFechaCierre()."',
			fechaApertura = '".$subasta -> getFechaApertura()."',
			fechaCreacion = '".$subasta -> getFechaCreacion()."',
			precioInicial = '".$subasta -> getPrecioInicial()."',
			idFotoComp = '".$subasta -> getIdFotoComp()."',
			tituloFotoSub = '".$subasta -> getTituloFotoSub()."',
			desFotoSub = '".$subasta -> getDesFotoSub()."',
			rutaFotoSub = '".$subasta -> getRutaFotoSub()."'
			where idSubasta = ".$subasta->getIdSubasta()."
			;";
		//echo $sql;
		try {
			mysql_query($sql);
		} catch (Exception $ex) {
			throw new CrearSubastaDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que cancela una subasta
	 * @param $idSubasta Identificador de subasta
	 * @param $nuevaFechaCierre Objeto con la fecha de cierre
	 * @author Miguel Callon
	 */
	public function modificarFinDeSubasta($idSubasta, $nuevaFechaCierre) {
		if (!isset($idSubasta)) {
			throw new ModificarFinDeSubastaDAOEx("Id subasta no especificado");
		}
		if (!isset($nuevaFechaCierre)) {
			throw new ModificarFinDeSubastaDAOEx("Fecha cierre no especificado");
		}
		$sql = "update Subasta set fechaCierre = '".$nuevaFechaCierre."'";
		//echo $sql;
		try {
			//se cargan los datos
			$cursor = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch (Exception $ex) {
			throw new ModificarFinDeSubastaDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que cancela una subasta
	 * @param $idSubasta Identificador de subasta
	 * @author Miguel Callon
	 */
	public function cancelarSubasta($idSubasta) {
		if (!isset($idSubasta)) {
			throw new CancelarSubastaDAOEx("Id subasta no especificado");
		}
		$sql = "update Subasta set idEstadoSub = ".ESTADO_SUBASTA_CANCELADA."
			    where idSubasta = ".$idSubasta;
		//echo $sql;
		try {
			//se cargan los datos
			$cursor = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch (Exception $ex) {
			throw new CancelarSubastaDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que obtiene una subasta pasando un SubastaBean con el id de la subasta
	 * que se quiere consultar.
	 * @param $idSubasta identificador de la subasta a consultar
	 * @param $subastaBean SubastaBean con los datos de la subasta
	 * @param $paginadoBean PaginadoBean datos del paginado
	 * @author Miguel Callon
	 */
	public function consultarSubasta($idSubasta, SubastaBean $subastaBean,
									 PaginadoBean $paginadoBean) {
		if (!isset($idSubasta)) {
			throw new ConsultarSubastaDAOEx("Id subasta no especificado");
		}
		
		//se seleccionan de la BD los datos usados para construir el subastaBean
		$sql = "select * from Subasta s where s.idSubasta=" . $idSubasta;		
		//echo $sql;
		try {
			//se cargan los datos
			$cursor = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
			//se crean las lineas con los datos y se introducen en el vector
			$lineasPuja = array(); //se crea un array para almacenar las lineas del pedido
			if (mysql_num_rows($cursor) > 0) {
				$fila = mysql_fetch_assoc($cursor);
				$this->fila2SubastaBean ($fila, $subastaBean);
				
				// Obtenemos los datos del usuario comprador
				$usuarioDAO = new UsuarioDAO();
				$usuarioBean= new UsuarioBean();
				$usuarioDAO->consultarDatosUsuario($subastaBean->getIdUsuCreador(), $usuarioBean);
				$subastaBean->setUsuarioCreador($usuarioBean);
				
				// Obtenemos las lineas de un pedido
				$pujaDAO = new PujaDAO();
				$pujaGanadoraBean = new PujaBean();
				try {
					$pujaDAO -> consultarPujaGanadoraSubasta($idSubasta, $pujaGanadoraBean);
					$subastaBean->setPujaGanadora($pujaGanadoraBean);
				} catch (NoExistenPujasDAOEx $ex) {
					// Dejamos vacio el campo $subastaBean->pujaGanadora
				}
				
				// Obtenemos el componente
				$componenteDAO = new ComponenteDAO();
				$componenteBean = new ComponenteBean();
				$componenteDAO->consultarComponente($subastaBean->getIdCompSub(), $componenteBean);
				$subastaBean->setCompSub($componenteBean);
				
				// Si existe el pedido en la base de datos, recuperamos sus lineas de pedido
				$pujaDAO->consultarPujasPorSubasta($idSubasta, $lineasPuja, $paginadoBean);
			} else {
				throw new ConsultarSubastaDAOEx("Subasta no encontrada");

			}
			$subastaBean->setListaPujas($lineasPuja);
		} catch (Exception $ex) {
			throw new ConsultarSubastaDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Lista las subastas de la base de datos
	 * @param $busquedaSubastasBean Objeto con la informacion de busqueda
	 * @param &$listaSubastas coleccion de subastas.
	 * @param $paginadoBean informacion de paginado.
	 * @author Santiago Iglesias
	 */
	public function listarSubastas(BusquedaSubastasBean $busquedaSubastasBean,
								   &$listaSubastas, PaginadoBean $paginadoBean) {
		$filtro = "
			 titulo like '%".$busquedaSubastasBean->getNombreSubasta()."%' 
			 and idUsuCreador like '%".$busquedaSubastasBean->getIdUsuCreador()."' 
			 and nombreEstSub like '%".$busquedaSubastasBean->getNombreEstSub()."' 
			 and c.nombreComp like '%".$busquedaSubastasBean->getNombreComp()."'
			 and u.nombre like '%".$busquedaSubastasBean->getNombreUsuario()."'"
			 ;
		// Para filtrar entre rangos de fecha
		// Fecha creacion
		if ($busquedaSubastasBean->getFechaCreacionIni() != "") {
			$filtro .= " and fechaCreacion between '".$busquedaSubastasBean->getFechaCreacionIni()."'
					 and '".$busquedaSubastasBean->getFechaCreacionFin()."'";
		}
		// Fecha apertura
		if ($busquedaSubastasBean->getFechaAperturaIni() != "") {
			$filtro .= " and fechaApertura between '".$busquedaSubastasBean->getFechaAperturaIni()."'
					 and '".$busquedaSubastasBean->getFechaAperturaFin()."'";
		}
		if ($busquedaSubastasBean->getFechaCierreIni() != "") {
			$filtro .= " and fechaCierre between '".$busquedaSubastasBean->getFechaCierreIni()."'
					 and '".$busquedaSubastasBean->getFechaCierreFin()."'";
		}
		// Para filtrar por varios estados de subasta
		$filtroIdsEstadosSubasta = $busquedaSubastasBean->getIdEstadosSubasta();
		if (isset($filtroIdsEstadosSubasta)) {
			$i = 0;
			foreach ($filtroIdsEstadosSubasta as $idEstadoSubasta) {
				if ($i == 0) {
					$filtro .= " and ( s.idEstadoSub = '".$idEstadoSubasta."'";
				} else {
					$filtro .= " or s.idEstadoSub = '".$idEstadoSubasta."'";
				}
				$i++;
			}
			$filtro .= ")";
		}
	
		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total from Subasta s 
			inner join Componente c on s.idCompSub = c.idComponente
			inner join EstadoSubasta e on s.idEstadoSub = e.IdEstadoSub
			inner join Usuario u on s.idUsuCreador = u.idUsuario 
		    left join Puja p on s.idSubasta = p.idSubastaPuja and
			p.idEstPuja = ".ESTADO_PUJA_GANADORA."
			where $filtro";
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarSubastasDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($cursor);
			
			// Ahora obtemos el numero de elementos del cursor
			// y lo ponemos el paginadoBean
			$paginadoBean->setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ListarSubastasDAOEx($ex -> getMessage());
		}
		
		// Consulta mysql. Ojo con el limit
		$sql = "select * from Subasta s inner join Componente c on s.idCompSub = c.idComponente
			inner join EstadoSubasta e on s.idEstadoSub = e.IdEstadoSub
			inner join Usuario u on s.idUsuCreador = u.idUsuario 
		    left join Puja p on s.idSubasta = p.idSubastaPuja and
			p.idEstPuja = ".ESTADO_PUJA_GANADORA."
			where $filtro
			limit ".$paginadoBean->getInicioPagSQL().",".$paginadoBean->getNumElemPag();	
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarSubastasDAOEx(mysql_error());
			}
			
			// Ahora recorremos el array y vamos guardando cada fila en
			// un objeto subastaBean.
			while ($fila = mysql_fetch_assoc($cursor)) {
				$subastaBean = new SubastaBean();
				$this->fila2SubastaBean($fila, $subastaBean);
				
				// Guardamos el estado de la subasta
				$estadoSubastaDAO = new EstadoSubastaDAO();
				$estadoSubastaBean = new EstadoSubastaBean();
				$estadoSubastaDAO->fila2EstadoSubastaBean($fila, $estadoSubastaBean);
				$subastaBean->setEstadoSubasta($estadoSubastaBean);
				
				// Guardamos el componente
				$componenteBean = new ComponenteBean();
				$componenteDAO = new ComponenteDAO();
				$componenteDAO->fila2ComponenteBean($fila, $componenteBean);
				$subastaBean->setCompSub($componenteBean);
				
				// Guardamos el vendedor
				$usuarioCreador = new UsuarioBean();
				$usuarioDAO = new UsuarioDAO();
				$usuarioDAO->fila2UsuarioBean($fila, $usuarioCreador);
				$subastaBean->setUsuarioCreador($usuarioCreador);
				
				// Guardamos la puja
				$pujaDAO = new PujaDAO();
				$pujaBean = new PujaBean();
				$pujaDAO->fila2PujaBean($fila, $pujaBean);
				$subastaBean->setPujaGanadora($pujaBean);
					
				$listaSubastas[count($listaSubastas)] = $subastaBean;
			}
		} catch (Exception $ex) {
			throw new ListarSubastasDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que convierte una pedido de base de datos
	 * en una objeto PedidoBean.
	 * @param $fila una tupla de PedidoBean de base de datos.
	 * @param $pedidoBean un objeto de tipo LineaPedidoBean.
	 * @author Miguel Callon
	 */
	private function fila2SubastaBean ($fila, SubastaBean $subastaBean) {
		$subastaBean->setIdSubasta($fila["idSubasta"]);
		$subastaBean->setIdUsuCreador($fila["idUsuCreador"]);
		$subastaBean->setIdEstadoSub($fila["idEstadoSub"]);
		$subastaBean->setTitulo($fila["titulo"]);
		$subastaBean->setDescripcionBreve($fila["descripcionBreve"]);
		$subastaBean->setDescripcion($fila["descripcion"]);
		$subastaBean->setFechaCierre(Fecha::formateaSQL2Html($fila["fechaCierre"]));
		$subastaBean->setFechaApertura(Fecha::formateaSQL2Html($fila["fechaApertura"]));
		$subastaBean->setPrecioInicial($fila["precioInicial"]);
		$subastaBean->setIdCompSub($fila["idCompSub"]);
		$subastaBean->setIdFotoComp($fila["idFotoComp"]);
		$subastaBean->setDesFotoSub($fila["desFotoSub"]);
		$subastaBean->setNumCompSub($fila["numCompSub"]);
		$subastaBean->setRutaFotoSub($fila["rutaFotoSub"]);	
	}
}
?>