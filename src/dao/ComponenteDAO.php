<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL.
 * @author Nuria Canle
 */
class ComponenteDAO extends MysqlDAO implements IComponenteDAO {
	/**
	 * Lista los componentes de la base de datos
	 * @param $busqueda Busqueda de componentes
	 * @param &$listaComponentes coleccion de componentes.
	 * @param $paginadoBean informacion de paginado.
	 * @author Nuria Canle
	 */
	public function listarComponentes(BusquedaComponentesBean $busqueda, &$listaComponentes, $paginadoBean) {
		$filtro = "nombreComp like '%" . $busqueda -> getNombre() . "%'
				  and idUsuVendedor like '%" . $busqueda -> getIdUsuVendedor() . "%'";

		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total from Componente where $filtro";
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$consulta = mysql_query($sql);
			if (!$consulta) {
				throw new ListarComponentesDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($consulta);

			// Ahora obtenemos el numero de elementos del resultado de la busqueda(consulta)
			// y añadimos el paginadoBean
			$paginadoBean -> setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ListarComponentesDAOEx($ex -> getMessage());
		}

		// Consulta mysql. Ojo con el limit
		$sql = "select * from Componente c inner join Usuario u on c.idUsuVendedor = u.idUsuario
			inner join FotoComponente f on c.idComponente = f.idCompFoto and f.isPrincipal = 1  
			where $filtro
			limit " . $paginadoBean -> getInicioPagSQL() . "," . $paginadoBean -> getNumElemPag();
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql de nuevo
			$consulta = mysql_query($sql);
			if (!$consulta) {
				throw new ListarComponentesDAOEx(mysql_error());
			}

			// Ahora recorremos el array y vamos guardando
			//cada fila obtenida de la consulta sql en
			// un objeto componenteBean.
			while ($fila = mysql_fetch_assoc($consulta)) {
				$componenteBean = new ComponenteBean();
				$this -> fila2ComponenteBean($fila, $componenteBean);
				
				$usuarioDAO = new UsuarioDAO();
				$usuarioBean = new UsuarioBean();
				$usuarioDAO -> fila2UsuarioBean($fila, $usuarioBean);
				$componenteBean->setUsuarioVendedor($usuarioBean);
				
				$fotoComponenteBean = new FotoComponenteBean();
				$fotoComponenteDAO = new FotoComponenteDAO();
				$fotoComponenteDAO -> fila2FotoComponenteBean($fila, $fotoComponenteBean);
				
				$componenteBean->setFotoPrincipal($fotoComponenteBean);
				
				$listaComponentes[count($listaComponentes)] = $componenteBean;
			}
		} catch (Exception $ex) {
			throw new ListarComponentesDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Lista los componentes de la base de datos
	 * @param $busqueda Busqueda de componentes
	 * @param &$listaComponentes coleccion de componentes.
	 * @param $paginadoBean informacion de paginado.
	 * @author Santiago Iglesias
	 */
	public function listarComponentesAdmin(BusquedaComponentesBean $busqueda, &$listaComponentes, $paginadoBean) {
			$precio=$busqueda -> getPrecio();
			if($precio==null){
				$precio="%";
			}
		
		 $filtro = "nombreComp like '%".$busqueda->getNombre()."%'".
				 "and usuario like '%".$busqueda->getUsuarioVendedor()."%'".
				 "and precio like'".$precio."'";

		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total from Componente c inner join Usuario u on c.idUsuVendedor = u.idUsuario 
			where $filtro";
		
		try {
			// Ahora obtenemos la consulta sql
			$consulta = mysql_query($sql);
			if (!$consulta) {
				throw new ListarComponentesDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($consulta);

			// Ahora obtenemos el numero de elementos del resultado de la busqueda(consulta)
			// y añadimos el paginadoBean
			$paginadoBean -> setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ListarComponentesDAOEx($ex -> getMessage());
		}

		// Consulta mysql. Ojo con el limit
		$sql = "select * from Componente c inner join Usuario u on c.idUsuVendedor = u.idUsuario 
			where $filtro
			limit " . $paginadoBean -> getInicioPagSQL() . "," . $paginadoBean -> getNumElemPag();
		
		try {
			// Ahora obtenemos la consulta sql de nuevo
			$consulta = mysql_query($sql);
			if (!$consulta) {
				throw new ListarComponentesDAOEx(mysql_error());
			}

			// Ahora recorremos el array y vamos guardando
			//cada fila obtenida de la consulta sql en
			// un objeto componenteBean.
			while ($fila = mysql_fetch_assoc($consulta)) {
				$componenteBean = new ComponenteBean();
				$this -> fila2ComponenteBean($fila, $componenteBean);
				
				$usuarioDAO = new UsuarioDAO();
				$usuarioBean = new UsuarioBean();
				$usuarioDAO -> fila2UsuarioBean($fila, $usuarioBean);
				$componenteBean->setUsuarioVendedor($usuarioBean);
				
				$listaComponentes[count($listaComponentes)] = $componenteBean;
			}
		} catch (Exception $ex) {
			throw new ListarComponentesDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Convierte una fila de base de datos
	 * @param $fila Tupla de base de datos
	 * @param $componente Objeto de tipo ComponenteBean
	 * @author Miguel Callon
	 */
	public function fila2ComponenteBean($fila, ComponenteBean &$componente) {
		$componente -> setIdComponente($fila["idComponente"]);
		$componente -> setIdUsuVendedor($fila["idUsuVendedor"]);
		
		$componente -> setIdEstadoComp($fila["idEstadoComp"]);
		$componente -> setNombre($fila["nombreComp"]);
		$componente -> setDescripcionBreve($fila["desBreveComp"]);
		$componente -> setDescripcion($fila["desComp"]);
		$componente -> setPrecio($fila["precio"]);
		$componente -> setUnidadesStock($fila["unidadesStock"]);
	}
	
	/**
	 * Metodo que crea un componente con los datos del componente
	 * @param $componente datos del componente
	 * @author Almudena Novoa
	 */
	public function altaComponente(ComponenteBean $componente) {

		$sql = " insert into Componente (idEstadoComp, idUsuVendedor, nombreComp,
				 desBreveComp, desComp, precio, unidadesStock)
			 values ('". ESTADO_COMPONENTE_NUEVO . "',
			 '" . $componente -> getIdUsuVendedor() . "',
			 '" . $componente -> getNombre() . "',
			 '" . $componente -> getDescripcionBreve() . "',
			 '" . $componente -> getDescripcion() . "',
			 '" . $componente -> getPrecio() . "',
			 '" . $componente -> getUnidadesStock() . "')";
		//echo $sql;
		try {
			mysql_query($sql);
			$componente -> setIdComponente($this -> getIdUltimaInsercion());
		} catch (Exception $ex) {
			throw new AltaComponenteDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Modifica un componente
	 * @param $idComponente id del componente a modificar
	 * @param $componente Componente a modificar
	 * @author Miguel Callon
	 */
	public function modificarComponente($idComponente, ComponenteBean $componente) {

		$sql = " update Componente 
			 set idEstadoComp = '". ESTADO_COMPONENTE_NUEVO . "',
			 idUsuVendedor = '" . $componente -> getIdUsuVendedor() . "',
			 nombreComp = '" . $componente -> getNombre() . "',
			 desBreveComp = '" . $componente -> getDescripcionBreve() . "',
			 desComp = '" . $componente -> getDescripcion() . "',
			 precio = '" . $componente -> getPrecio() . "',
			 unidadesStock = '" . $componente -> getUnidadesStock() . "'
			 where idComponente = ".$componente->getIdComponente();
		//echo $sql;
		try {
			mysql_query($sql);
		} catch (Exception $ex) {
			throw new AltaComponenteDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que obtiene un componente de la base de datos pasandole un ComponenteBean
	 * con el id del componente que se quiere consultar.
	 * @param $idComponente identificador del componente a consultar
	 * @param $compBean PedidoBean con los datos del pedido
	 * @author Nuria Canle
	 */
	public function consultarComponente($idComponente, ComponenteBean $compBean) {
		if (!isset($idComponente)) {
			throw new ConsultarComponenteDAOEx("Id componente no especificado");
		}
		
		//se seleccionan de la BD los datos usados para construir el ComponenteBean
		$sql = "select * from Componente c where c.idComponente=" . $idComponente;
	
		try {
			//se cargan los datos del componente
			$consulta = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
			if (mysql_num_rows($consulta) > 0) {
				$fila = mysql_fetch_assoc($consulta);
				$this -> fila2ComponenteBean($fila, $compBean);

				// Obtenemos los datos del usuario vendedor
				$usuarioDAO = new UsuarioDAO();
				$usuarioVendedor = new UsuarioBean();
				$usuarioDAO -> consultarDatosUsuario($compBean -> getIdUsuVendedor(), $usuarioVendedor);
				$compBean->setUsuarioVendedor($usuarioVendedor);		
				$listaFotos = array();
				
				$fotoComponenteDAO = new FotoComponenteDAO();
				$fotoComponente = new FotoComponenteBean();
				$fotoComponenteDAO -> listarFotosComponente($compBean->getIdComponente(), $listaFotos);
				$compBean->setListaFotos($listaFotos);
				
				foreach ($listaFotos as $foto) {
					if ($foto->getIsPrincipal()) {
						$compBean->setFotoPrincipal($foto);
					}
				}
			} else {
				throw new ConsultarComponenteDAOEx("Componente no encontrado");
			}
		} catch (Exception $ex) {
			throw new ConsultarComponenteDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que elimina un componente de la base de datos pasandole un idcomponente
	 * @param $idComponente identificador del componente a dar de baja
	 * @author Adrian Gonzalez
	 */
	public function bajaComponente($idcomponente) {
		
		if (!isset($idComponente)) {
			throw new BajaComponenteDAOEx("Id componente no especificado");
		}
		
		$sql = "delete from Componente c where c.idComponente=" . $idcomponente;
		//se comprueba si el componente se elimino
		$comprobacion = "select from Componente c where c.idComponente=" . $idcomponente;
		$consulta = mysql_query($comprobacion) or die('Consulta fallida: ' . mysql_error());
		
		if (mysql_num_rows($consulta) > 0) {
			throw new BajaComponenteDAOEx($ex -> getMessage());
		}
	}
}
?>