<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL.
 * @author Nuria Canle
 */
class InformeDAO extends MysqlDAO implements IInformeDAO {
	/**
	 * Lista los informes de la base de datos
	 * @param $busquedaInformesBean Objeto con la informacion de busqueda
	 * @param &$listaInformes coleccion de informes.
	 * @param $paginadoBean informacion de paginado.
	 * @author Nuria Canle
	 */
	public function listarInformes(BusquedaInformesBean $busquedaInformesBean,
								   &$listaInformes, PaginadoBean $paginadoBean) {
		$filtro = " 
			 numPedidos like '%".$busquedaInformesBean->getNumPedidos()."%' 
			 and numSubastas like '%".$busquedaInformesBean->getNumSubastas()."' 
			 and numPujas like '%".$busquedaInformesBean->getNumPujas()."'
			 and ganancia like '%".$busquedaInformesBean->getGanancia()."'
			 and pagosRecibidos like '%".$busquedaInformesBean->getPagosRecibidos()."'
			 and pagosEnviados like '%".$busquedaInformesBean->getPagosEnviados()."'"
			 ;
		// Para filtrar entre rangos de fecha
		if ($busquedaInformesBean->getFecha() != "") {
			$filtro .= " and fecha between '".$busquedaInformesBean->getFechaIni()."'
					 and '".$busquedaSubastasBean->getFechaFin()."'";
		}
	
		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total from Informe
			where $filtro";
		
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarInformesDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($cursor);
			
			// Ahora obtemos el numero de elementos del cursor
			// y lo ponemos el paginadoBean
			$paginadoBean->setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ListarInformesDAOEx($ex -> getMessage());
		}
		
		// Consulta mysql. Ojo con el limit
		$sql = "select * from Informe
			where $filtro
			limit ".$paginadoBean->getInicioPagSQL().",".$paginadoBean->getNumElemPag();	
		
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarInformesDAOEx(mysql_error());
			}
			
			// Ahora recorremos el array y vamos guardando cada fila en
			// un objeto subastaBean.
			while ($fila = mysql_fetch_assoc($cursor)) {
				$informeBean = new InformeBean();
				$this->fila2InformeBean($fila, $informeBean);
				
				$listaInformes[count($listaInformes)] = $informeBean;
			}
		} catch (Exception $ex) {
			throw new ListarInformesDAOEx($ex -> getMessage());
		}
	}

/**
	 * Metodo que convierte un informe de base de datos
	 * en una objeto InformeBean.
	 * @param $fila una tupla de base de datos.
	 * @param $InformeBean un objeto InformeBean
 	 * @author Nuria Canle
	 */
	private function fila2InformeBean ($fila, InformeBean $informeBean) {
		$informeBean->setFecha($fila["fecha"]);
		$informeBean->setNumPedidos($fila["numPedidos"]);
		$informeBean->setNumSubastas($fila["numSubastas"]);
		$informeBean->setNumPujas($fila["numPujas"]);
		$informeBean->setGanancia($fila["ganancia"]);
		$informeBean->setPagosRecibidos($fila["pagosRecibidos"]);
		$informeBean->setPagosEnviados($fila["pagosEnviados"]);
	}
	
	/**
	 * Modifica el detalle de un informe
	 * @fecha fecha del informe a modificar
	 * @informe Objeto informe con los datos a modificar
	 * @author Nuria Canle
	 */
	public function modificarInforme($fecha, InformeBean $informe) {
			$sql = "update Informe set 
			fecha = '".$informe -> getFecha()."',
			numPedidos = '".$informe -> getNumPedidos()."',
			numSubastas = '".$informe -> getNumSubastas()."',
			numPujas = '".$informe -> getNumPujas()."',
			ganancia = '".$informe -> getGanancia()."',
			pagosRecibidos = '".$informe -> getPagosRecibidos()."',
			pagosEnviados = '".$informe -> getPagosEnviados()."'
			;";
		//echo $sql;
		try {
			mysql_query($sql);
		} catch (Exception $ex) {
			throw new CrearInformeDAOEx($ex -> getMessage());
		}
	}
	}
?>