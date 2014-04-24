<?php

/**
 * Clase que implementa los metodos de base de datos contra MySQL.
 * @author Miguel Callon
 */
class PujaDAO extends MysqlDAO implements IPujaDAO {
	/**
	 * Pujar en una subasta
	 * @param $idPuja Identificador de la puja
	 * @author Miguel Callon
	 */
	public function marcarPujaPerdedora($idPuja) {
		if (!isset($idPuja)) {
			throw new PujarDAOEx("Id puja no especificado");
		}
		
		$sql = "update Puja set idEstPuja = ".ESTADO_PUJA_PERDEDORA;
		//echo $sql;
		
		try {
			// Ahora obtenemos la consulta sql
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch (Exception $ex) {
			throw new MarcarPujaPerdedoraDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Pujar en una subasta
	 * @param $idPedido Identificador del pedido
	 * @param $lineasPedido coleccion de objeto de la clase LineaPedidoBean
	 * @param $paginadoBean Datos del paginado
	 * @throws PujarDAOEx Excepcion cuando el idSubasta no esta especificado
	 * @author Miguel Callon
	 */
	public function insertarPuja($idSubasta, PujaBean $puja) {
		if (!isset($idSubasta)) {
			throw new PujarDAOEx("Id subasta no especificado");
		}
		
		$fechaHoy = new DateTime("now");
		$sql = "insert into Puja (idSubastaPuja, idUsuarioPuja, idEstPuja, cantPujada, fechaPuja) 
				value ('".$idSubasta."', '".$puja->getIdUsuarioPuja()."', '".ESTADO_PUJA_GANADORA."',
				 '".$puja->getCantPujada()."', '".$fechaHoy -> format('Y-m-d H:i:s')."');";
		//echo $sql;
		
		try {
			// Ahora obtenemos la consulta sql
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch (Exception $ex) {
			throw new PujaDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Obtener la puja ganadora de una subasta
	 * @param $idSubasta Identificador de la subasta
	 * @param $pujaBean Puja ganadora
	 * @throws ConsultarLineaPujaDAOEx si el idSubasta no esta especificado
	 * @author Miguel Callon
	 */
	public function consultarPujaGanadoraSubasta($idSubasta,
											 PujaBean $pujaBean) {
		if (!isset($idSubasta)) {
			throw new ConsultarPujaGanadoraSubDAOEx("Id subasta no especificado");
		}
		
		$sql = "select * from Puja where idSubastaPuja = $idSubasta and idEstPuja = ".
				ESTADO_PUJA_GANADORA;
		//echo $sql;
		try {
			$cursor = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());	
		} catch (Exception $ex) {
			throw new ConsultarPujaGanadoraSubDAOEx($ex -> getMessage());
		}
		if (mysql_num_rows($cursor) > 0) {
			$fila = mysql_fetch_assoc($cursor);
			$this->fila2PujaBean ($fila, $pujaBean);
		} else {			
			throw new NoExistenPujasDAOEx("No hay pujas en la subasta ".
										  $idSubasta);
		}
	}
											 
	/**
	 * Obtener las pujas de una subasta
	 * @param $idSubasta Identificador de la subasta
	 * @param $paginadoBean Datos del paginado
	 * @throws ConsultarLineaPujaDAOEx si el idSubasta no esta especificado
	 * @author Miguel Callon
	 */
	public function consultarPujasPorSubasta($idSubasta, &$lineasPuja,
											 PaginadoBean $paginadoBean) {
		if (!isset($idSubasta)) {
			throw new ConsultarLineaPujaDAOEx("Id subasta no especificado");
		}
		$filtro = "1 = 1";
		
		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total from Puja p where p.idSubastaPuja = $idSubasta
				and $filtro";
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ConsultarLineaPujaDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($cursor);
			
			// Ahora obtemos el numero de elementos del cursor
			// y lo ponemos el paginadoBean
			$paginadoBean->setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ConsultarLineaPujaDAOEx($ex -> getMessage());
		}
		
		//se seleccionan de la BD los datos usados para obtener las lineas de pedido
		$sql = "select * from Puja p inner join Usuario u on p.idUsuarioPuja = u.idUsuario
			    where p.idSubastaPuja=".$idSubasta."
				and $filtro ";
		$orden = $paginadoBean->getCampoOrdenSelec();
		if (isset($orden)) {
				$sql .= "order by ".$paginadoBean->getCampoOrdenSelec();
		}
		$sql .= " limit ".$paginadoBean->getInicioPagSQL().",".$paginadoBean->getNumElemPag();
		//echo $sql;
		try {
			//se cargan los datos
			$cursor = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
			//se crean las lineas con los datos y se introducen en el vector
			while ($fila = mysql_fetch_assoc($cursor)) {
				$pujaBean = new PujaBean();
				$this->fila2PujaBean ($fila, $pujaBean);
				
				$usuarioDAO = new UsuarioDAO();
				$usuarioBean = new UsuarioBean();
				$usuarioDAO->fila2UsuarioBean($fila, $usuarioBean);
				$pujaBean->setUsuarioPuja($usuarioBean);
				
				$lineasPuja[count($lineasPuja)] = $pujaBean;
			}
		} catch (Exception $ex) {
			throw new ConsultarLineaPujaDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que convierte una puja de base de datos
	 * en una objeto PujaBean.
	 * @param $fila una tupla de PujaBean de base de datos.
	 * @param $pujaBean un objeto de tipo PujaBean.
	 * @author Miguel Callon
	 */
	public function fila2PujaBean ($fila, PujaBean $pujaBean) {
		$pujaBean->setIdPuja($fila["idPuja"]);
		$pujaBean->setIdSubasta($fila["idSubastaPuja"]);
		$pujaBean->setIdUsuarioPuja($fila["idUsuarioPuja"]);
		$pujaBean->setIdEstPuja($fila["idEstPuja"]);
		$pujaBean->setCantPujada($fila["cantPujada"]);
		
		// Descompongo la fecha y la hora
		$fechaHora = new DateTime($fila["fechaPuja"]);
		if (isset($fechaHora)) { 
			$pujaBean->setFechaPuja($fechaHora -> format('Y-m-d'));
			$pujaBean->setHoraPuja($fechaHora -> format('H:i:s')); 
		}
	}
}
?>