<?php

/**
 * Clase que implementa los metodos de base de datos contra MySQL.
 * @author Santiago Iglesias
 */
class PedidoDAO extends MysqlDAO implements IPedidoDAO {
	/**
	 * Crear pedido
	 * @param $pedidoBean datos del pedido
	 * @author Miguel Callon
	 */
	public function crearPedido(PedidoBean $pedidoBean) {
		$fechaHoy = new DateTime("now");
		$sql = "insert into Pedido (idEstadoPedido, idUsuarioComprador, 
									idUsuarioVendedor, fechaEnvio, fechaAlta,
								    fechaActualizacion, total) VALUES 
								    ('".ESTADO_PEDIDO_NUEVO."',
								     '".$pedidoBean->getIdUsuarioComprador()."',
								     '".$pedidoBean->getIdUsuarioVendedor()."',
								     '".$fechaHoy -> format('Y-m-d H:i:s')."',
								     '".$fechaHoy -> format('Y-m-d H:i:s')."',
								     '".$fechaHoy -> format('Y-m-d H:i:s')."',
								     '".$pedidoBean->getTotal()."')";
		//echo $sql;
		try {
			//se cargan los datos
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
			$idPedido = $this->getIdUltimaInsercion();
			$pedidoBean->setIdPedido($idPedido);
			
			$lineaPedidoDAO = new LineaPedidoDAO();
			$lineasPedido = $pedidoBean->getLineasPedido();
			foreach ($lineasPedido as $lineaPedido) {
				$lineaPedido->setIdPedido($idPedido);
				$lineaPedidoDAO->insertarLineaPedido($lineaPedido);
			}
		} catch (InsertarLineaPedidoDAOEx $ex) {
			throw new CrearPedidoDAOEx($ex -> getMessage());
		} catch (Exception $ex) {
			throw new CrearPedidoDAOEx($ex -> getMessage());
		}
	}
	/**
	 * Metodo que obtiene un pedido pasando un PedidoBean con el id del pedido
	 * que se quiere consultar.
	 * @param $idPedido identificador del pedido a consultar
	 * @param $pedidoBean PedidoBean con los datos del pedido
	 * @author Santiago Iglesias
	 */
	public function consultarPedido($idPedido, PedidoBean $pedidoBean) {
		if (!isset($idPedido)) {
			throw new ConsultarPedidoDAOEx("Id pedido no especificado");
		}
		
		//se seleccionan de la BD los datos usados para construir el pedidoBean
		$sql = "select * from Pedido p where p.idPedido=" . $idPedido;		
		try {
			//se cargan los datos
			$cursor = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
			//se crean las lineas con los datos y se introducen en el vector
			if (mysql_num_rows($cursor) > 0) {
				$fila = mysql_fetch_assoc($cursor);
				$this->fila2PedidoBean ($fila, $pedidoBean);
				// Obtenemos los datos del usuario comprador
				$usuarioDAO = new UsuarioDAO();
				$usuarioComprador = new UsuarioBean();
				$usuarioDAO->consultarDatosUsuario($pedidoBean->getIdUsuarioComprador(), $usuarioComprador);
				$usuarioVendedor = new UsuarioBean();
				$usuarioDAO->consultarDatosUsuario($pedidoBean->getIdUsuarioVendedor(), $usuarioVendedor);
				
				$pedidoBean->setUsuarioComprador($usuarioComprador);
				$pedidoBean->setUsuarioVendedor($usuarioVendedor);
				
				// Obtenemos las lineas de un pedido
				$lineaPedidoDAO = new LineaPedidoDAO();
				
				$lineasPedido = $pedidoBean->getLineasPedido();
				// Si existe el pedido en la base de datos, recuperamos sus lineas de pedido
				$lineaPedidoDAO->consultarLineasPedidoPorPedido($idPedido, $lineasPedido);
				$pedidoBean->setLineasPedido($lineasPedido);
				
				// Obtenemos el estado del pedido
				$estadoPedidoBean = new EstadoPedidoBean();
				$estadoPedidoDAO = new EstadoPedidoDAO();
				$estadoPedidoDAO->consultarEstadoPedido($pedidoBean->getIdEstadoPedido(), $estadoPedidoBean);
				$pedidoBean->setEstadoPedido($estadoPedidoBean);
			} else {
				throw new ConsultarPedidoDAOEx("Pedido no encontrado");
			}
		} catch (Exception $ex) {
			throw new ConsultarPedidoDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que cambia el estado de un pedido a enviado
	 * @param $idPedido identificador del pedido
	 * @author Miguel Callon
	 */
	public function marcarPedidoEnTramite($idPedido) {
		if (!isset($idPedido)) {
			throw new AceptarPedidoDAOEx("Id pedido no especificado");
		}
		$sql = "update Pedido set idEstadoPedido = '".ESTADO_PEDIDO_EN_TRAMITE."' 
				where idPedido = $idPedido";
		try{
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		}catch(Exception $ex) {
			throw new MarcarPedidoEnviadoDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que cambia el estado de un pedido a recibido
	 * @param $idPedido identificador del pedido
	 * @author Santiago Iglesias
	 */
	public function marcarPedidoRecibido($idPedido) {
		if (!isset($idPedido)) {
			throw new MarcarPedidoRecibidoDAOEx("Id pedido no especificado");
		}
		$sql = "update Pedido set idEstadoPedido = '".ESTADO_PEDIDO_RECIBIDO."' 
				where idPedido = $idPedido";
		//echo $sql;
		try{
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		}catch(Exception $ex) {
			throw new MarcarPedidoRecibidoDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que cambia el estado de un pedido a no recibido
	 * @param $idPedido identificador del pedido
	 * @author Santiago Iglesias
	 */
	public function marcarPedidoNoRecibido($idPedido) {
		if (!isset($idPedido)) {
			throw new MarcarPedidoNoRecibidoDAOEx("Id pedido no especificado");
		}
		$sql = "update Pedido set idEstadoPedido = '".ESTADO_PEDIDO_NO_RECIBIDO."' 
				where idPedido = $idPedido";
		try{
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		}catch(Exception $ex) {
			throw new MarcarPedidoNoRecibidoDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que convierte una pedido de base de datos
	 * en una objeto PedidoBean.
	 * @param $fila una tupla de PedidoBean de base de datos.
	 * @param $pedidoBean un objeto de tipo LineaPedidoBean.
	 * @author Miguel Callon
	 */
	private function fila2PedidoBean ($fila,PedidoBean $pedidoBean) {
		$pedidoBean->setIdPedido($fila["idPedido"]);
		$pedidoBean->setIdEstadoPedido($fila["idEstadoPedido"]);
		$pedidoBean->setIdUsuarioComprador($fila["idUsuarioComprador"]);
		$pedidoBean->setIdUsuarioVendedor($fila["idUsuarioVendedor"]);
		$pedidoBean->setFechaEnvio(Fecha::formateaSQL2Html($fila["fechaEnvio"]));
		$pedidoBean->setFechaAlta(Fecha::formateaSQL2Html($fila["fechaAlta"]));
		$pedidoBean->setFechaActualizacion(Fecha::formateaSQL2Html($fila["fechaActualizacion"]));
		$pedidoBean->setTotal($fila["total"]);
	}
	/**
	 * Metodo que cambia el estado del pedido a aceptado
	 * @param $idPedido identificador del pedido a consultar
	 * @author Santiago Iglesias
	 */
	public function aceptarPedido ($idPedido) {
		if (!isset($idPedido)) {
			throw new AceptarPedidoDAOEx("Id pedido no especificado");
		}
		$sql="update Pedido set idEstadoPedido='".ESTADO_PEDIDO_ACEPTADO."'
			  where idPedido=".$idPedido;
		try{
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		}catch(Exception $ex) {
			throw new AceptarPedidoDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que cambia el estado del pedido a anulado
	 * @param $idPedido identificador del pedido a consultar
	 * @author Adrián González
	 */
	public function anularPedidoDelSistema ($idPedido) {
		if (!isset($idPedido)) {
			throw new anularPedidoDelSistemaDAOEx("Id pedido no especificado");
		}
		$sql="update Pedido set idEstadoPedido='".ESTADO_PEDIDO_ANULADO."'
			  where idPedido=".$idPedido;
		try{
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		}catch(Exception $ex) {
			throw new AnularPedidoDelSistemaDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que cambia el estado del pedido a rechazado
	 * @param $idPedido identificador del pedido a consultar
	 * @author Santiago Iglesias
	 */
	public function rechazarPedido ($idPedido) {
		if (!isset($idPedido)) {
			throw new RechazarPedidoDAOEx("Id pedido no especificado");
		}
		$sql="update Pedido set idEstadoPedido='".ESTADO_PEDIDO_RECHAZADO."'
			  where idPedido=".$idPedido;
		try{
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		}catch(Exception $ex) {
			throw new RechazarPedidoDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Lista los pedidos de la base de datos
	 * @param &$listaPedidos coleccion de pedidos.
	 * @param $paginadoBean informacion de paginado.
	 * @author Santiago Iglesias
	 */
	public function listarPedidos(BusquedaPedidosBean $busquedaPedido, 
								   &$listaPedidos, PaginadoBean $paginadoBean) {							   	
		$filtro = "p.idPedido like '%".$busquedaPedido->getIdPedido()."%'";
				
				
				if ($busquedaPedido->getFechaCompraIni() != "" &&
				$busquedaPedido->getFechaCompraFin() != "") {
				$filtro .= " and fechaAlta between '".Fecha::formateaHtml2SQL(
																$busquedaPedido->getFechaCompraIni())."'
						     and '".Fecha::formateaHtml2SQL($busquedaPedido->getFechaCompraFin())."'";
				}
								
				if ($busquedaPedido->getFechaActualizacionIni() != "" &&
				$busquedaPedido->getFechaActualizacionFin() != "") {
				$filtro .= " and fechaActualizacion between '".Fecha::formateaHtml2SQL(
																$busquedaPedido->getFechaActualizacionIni())."'
						     and '".Fecha::formateaHtml2SQL($busquedaPedido->getFechaActualizacionFin())."'";
				}
				
			$filtro .= 	"and nombreEstPed like '%".$busquedaPedido->getEstadoPedido()."%'".
						"and uV.usuario like '%".$busquedaPedido->getUsuarioVendedor()."%'".
						"and uC.usuario like '%".$busquedaPedido->getUsuarioComprador()."%'";
				
		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total from Pedido p inner join Usuario as uV
				on p.idUsuarioVendedor = uV.idUsuario inner join Usuario uC on p.idUsuarioComprador = uC.idUsuario inner join EstadoPedido e on p.idEstadoPedido = e.idEstadoPedido where $filtro";
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarPedidosDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($cursor);
			
			// Ahora obtemos el numero de elementos del cursor
			// y lo ponemos el paginadoBean
			$paginadoBean->setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ListarPedidosDAOEx($ex -> getMessage());
		}
		
		// Si no se ha establecido un campo por el que ordene
		// se pone un campo por defecto
		if ($paginadoBean->getCampoOrdenSelec() == null) {
			$paginadoBean->setCampoOrdenSelec("fechaEnvio");
		}
		// Consulta mysql. Ojo con el limit
		$sql = "select idPedido,p.idEstadoPedido, nombreEstPed, desEstPed, idUsuarioComprador,uC.usuario as usuarioC,uV.usuario as usuarioV, idUsuarioVendedor,fechaEnvio,fechaAlta,fechaActualizacion,total from Pedido p inner join Usuario as uV
				on p.idUsuarioVendedor = uV.idUsuario inner join Usuario uC on p.idUsuarioComprador = uC.idUsuario 
				inner join EstadoPedido e on p.idEstadoPedido = e.idEstadoPedido    
				where $filtro
				order by ".$paginadoBean->getCampoOrdenSelec()."
			    limit ".$paginadoBean->getInicioPagSQL().",".$paginadoBean->getNumElemPag();
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarPedidosDAOEx(mysql_error());
			}
			
			// Ahora recorremos el array y vamos guardando cada fila en
			// un objeto PedidoBean.
			while ($fila = mysql_fetch_assoc($cursor)) {
				$pedidoBean = new PedidoBean();
				$this->fila2PedidoBean($fila, $pedidoBean);
				
				$usuarioVendedor = new UsuarioBean();
				$usuarioVendedor->setIdUsuario($pedidoBean->getIdUsuarioVendedor());
				$usuarioVendedor->setUsuario($fila["usuarioV"]);
				$pedidoBean->setUsuarioVendedor($usuarioVendedor);
				
				$usuarioComprador = new UsuarioBean();
				$usuarioComprador->setIdUsuario($pedidoBean->getIdUsuarioComprador());
				$usuarioComprador->setUsuario($fila["usuarioC"]);
				$pedidoBean->setUsuarioComprador($usuarioComprador);
				
				$estadoPedido = new EstadoPedidoBean();
				$estadoPedido->setIdEstadoPedido($pedidoBean->getIdEstadoPedido());
				$estadoPedido->setNombre($fila["nombreEstPed"]);
				$estadoPedido->setDescripcion($fila["desEstPed"]);
				$pedidoBean->setEstadoPedido($estadoPedido);
				
				$listaPedidos[count($listaPedidos)] = $pedidoBean;				
			}
		} catch (Exception $ex) {
			throw new ListarPedidosDAOEx($ex -> getMessage());
		}
	}


/**
	 * Lista los pedidos de la base de datos
	 * @param &$listaPedidos coleccion de pedidos.
	 * @param $paginadoBean informacion de paginado.
	 * @author Santiago Iglesias
	 */
	public function listarPedidosEnviados(BusquedaPedidosBean $busquedaPedido, 
								   &$listaPedidos, PaginadoBean $paginadoBean,$idUsuConectado) {							   	
		$filtro = "p.idPedido like '%".$busquedaPedido->getIdPedido()."%'";
				
		if ($busquedaPedido->getFechaCompraIni() != "" &&
				$busquedaPedido->getFechaCompraFin() != "") {
				$filtro .= " and fechaAlta between '".Fecha::formateaHtml2SQL(
																$busquedaPedido->getFechaCompraIni())."'
						     and '".Fecha::formateaHtml2SQL($busquedaPedido->getFechaCompraFin())."'";
				}
				
		if ($busquedaPedido->getFechaActualizacionIni() != "" &&
				$busquedaPedido->getFechaActualizacionFin() != "") {
				$filtro .= " and fechaActualizacion between '".Fecha::formateaHtml2SQL(
																$busquedaPedido->getFechaActualizacionIni())."'
						     and '".Fecha::formateaHtml2SQL($busquedaPedido->getFechaActualizacionFin())."'";
		}
		$filtro .= " and nombreEstPed like '%".$busquedaPedido->getEstadoPedido()."%'".
				" and uV.usuario like '%".$busquedaPedido->getUsuarioVendedor()."%'".
				" and idUsuarioComprador=".$idUsuConectado;
		
		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total from Pedido p inner join Usuario as uV
				on p.idUsuarioVendedor = uV.idUsuario inner join Usuario uC on p.idUsuarioComprador = uC.idUsuario inner join EstadoPedido e on p.idEstadoPedido = e.idEstadoPedido where $filtro";
	
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
				
			if (!$cursor) {
				throw new ListarPedidosDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($cursor);
			
			// Ahora obtemos el numero de elementos del cursor
			// y lo ponemos el paginadoBean
			$paginadoBean->setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ListarPedidosDAOEx($ex -> getMessage());
		}
		
		// Si no se ha establecido un campo por el que ordene
		// se pone un campo por defecto
		if ($paginadoBean->getCampoOrdenSelec() == null) {
			$paginadoBean->setCampoOrdenSelec("fechaEnvio");
		}
		// Consulta mysql. Ojo con el limit
					
		$sql = "select idPedido,p.idEstadoPedido, nombreEstPed, desEstPed, idUsuarioComprador,uC.usuario as usuarioC,uV.usuario as usuarioV, idUsuarioVendedor,fechaEnvio,fechaAlta,fechaActualizacion,total from Pedido p inner join Usuario as uV
				on p.idUsuarioVendedor = uV.idUsuario inner join Usuario uC on p.idUsuarioComprador = uC.idUsuario 
				inner join EstadoPedido e on p.idEstadoPedido = e.idEstadoPedido    
				where $filtro
				order by ".$paginadoBean->getCampoOrdenSelec()."
			    limit ".$paginadoBean->getInicioPagSQL().",".$paginadoBean->getNumElemPag();		
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarPedidosDAOEx(mysql_error());
			}
			
			// Ahora recorremos el array y vamos guardando cada fila en
			// un objeto PedidoBean
			while ($fila = mysql_fetch_assoc($cursor)) {
				$pedidoBean = new PedidoBean();
				$this->fila2PedidoBean($fila, $pedidoBean);
				
				$usuarioDAO=new UsuarioDAO();
				$usuarioVendedor = new UsuarioBean();
				
				$usuarioDAO->consultarDatosUsuario($pedidoBean->getIdUsuarioVendedor(),$usuarioVendedor);
				$pedidoBean->setUsuarioVendedor($usuarioVendedor);
				
				$estadoPedido = new EstadoPedidoBean();
				$estadoPedido->setNombre($fila["nombreEstPed"]);
				$estadoPedido->setDescripcion($fila["desEstPed"]);
				$pedidoBean->setEstadoPedido($estadoPedido);
				
				$listaPedidos[count($listaPedidos)] = $pedidoBean;				
			}
		} catch (Exception $ex) {
			echo $ex->getMessage();
			throw new ListarPedidosDAOEx($ex -> getMessage());
		}
	}

/**
	 * Lista los pedidos de la base de datos
	 * @param &$listaPedidos coleccion de pedidos.
	 * @param $paginadoBean informacion de paginado.
	 * @author Santiago Iglesias
	 */
	public function listarPedidosRecibidos(BusquedaPedidosBean $busquedaPedido, 
								   &$listaPedidos, PaginadoBean $paginadoBean,$idUsuConectado) {							   	
		$filtro = "p.idPedido like '%".$busquedaPedido->getIdPedido()."%'";
				
				if ($busquedaPedido->getFechaCompraIni() != "" &&
				$busquedaPedido->getFechaCompraFin() != "") {
				$filtro .= " and fechaAlta between '".Fecha::formateaHtml2SQL(
																$busquedaPedido->getFechaCompraIni())."'
						     and '".Fecha::formateaHtml2SQL($busquedaPedido->getFechaCompraFin())."'";
				}
				
				if ($busquedaPedido->getFechaActualizacionIni() != "" &&
				$busquedaPedido->getFechaActualizacionFin() != "") {
				$filtro .= " and fechaActualizacion between '".Fecha::formateaHtml2SQL(
																$busquedaPedido->getFechaActualizacionIni())."'
						     and '".Fecha::formateaHtml2SQL($busquedaPedido->getFechaActualizacionFin())."'";
		}
				
				
		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total from Pedido p inner join Usuario as uV
				on p.idUsuarioVendedor = uV.idUsuario inner join Usuario uC on p.idUsuarioComprador = uC.idUsuario inner join EstadoPedido e on p.idEstadoPedido = e.idEstadoPedido where $filtro";
		
		$filtro .="and nombreEstPed like '%".$busquedaPedido->getEstadoPedido()."%'".
				"and uC.usuario like '%".$busquedaPedido->getUsuarioComprador()."%'".
				"and idUsuarioVendedor=".$idUsuConectado;
		
		
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarPedidosDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($cursor);
			
			// Ahora obtemos el numero de elementos del cursor
			// y lo ponemos el paginadoBean
			$paginadoBean->setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ListarPedidosDAOEx($ex -> getMessage());
		}
		
		// Si no se ha establecido un campo por el que ordene
		// se pone un campo por defecto
		if ($paginadoBean->getCampoOrdenSelec() == null) {
			$paginadoBean->setCampoOrdenSelec("fechaEnvio");
		}
		// Consulta mysql. Ojo con el limit
		$sql = "select idPedido,p.idEstadoPedido, nombreEstPed, desEstPed, idUsuarioComprador,uC.usuario as usuarioC,uV.usuario as usuarioV, idUsuarioVendedor,fechaEnvio,fechaAlta,fechaActualizacion,total from Pedido p inner join Usuario as uV
				on p.idUsuarioVendedor = uV.idUsuario inner join Usuario uC on p.idUsuarioComprador = uC.idUsuario 
				inner join EstadoPedido e on p.idEstadoPedido = e.idEstadoPedido    
				where $filtro
				order by ".$paginadoBean->getCampoOrdenSelec()."
			    limit ".$paginadoBean->getInicioPagSQL().",".$paginadoBean->getNumElemPag();
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarPedidosDAOEx(mysql_error());
			}
			
			// Ahora recorremos el array y vamos guardando cada fila en
			// un objeto PedidoBean
			while ($fila = mysql_fetch_assoc($cursor)) {
				$pedidoBean = new PedidoBean();
				$this->fila2PedidoBean($fila, $pedidoBean);
				
				$usuarioDAO=new UsuarioDAO();
				$usuarioComprador = new UsuarioBean();
				
				$usuarioDAO->consultarDatosUsuario($pedidoBean->getIdUsuarioComprador(),$usuarioComprador);
				$pedidoBean->setUsuarioComprador($usuarioComprador);
				
				$estadoPedido = new EstadoPedidoBean();
				$estadoPedido->setIdEstadoPedido($pedidoBean->getIdEstadoPedido());
				$estadoPedido->setNombre($fila["nombreEstPed"]);
				$estadoPedido->setDescripcion($fila["desEstPed"]);
				$pedidoBean->setEstadoPedido($estadoPedido);
				
				$listaPedidos[count($listaPedidos)] = $pedidoBean;				
			}
		} catch (Exception $ex) {
			throw new ListarPedidosDAOEx($ex -> getMessage());
		}
	}


}
?>