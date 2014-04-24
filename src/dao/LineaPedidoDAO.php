<?php

/**
 * Clase que implementa los metodos de base de datos contra MySQL
 * relacionados con la clase pedidos
 * @author Miguel Callon
 */
class LineaPedidoDAO extends MysqlDAO implements ILineaPedidoDAO {
	/**
	 * Inserta una linea de pedido en base de datos
	 * @param $lineaPedido Linea del pedido
	 * @author Miguel Callon
	 */
	public function insertarLineaPedido(LineaPedidoBean $lineaPedido) {
		$sql = "insert into LineaPedido (idPedido, idComponente, precioLinea, numUnidades) 
				values ('".$lineaPedido->getIdPedido()."',
					    '".$lineaPedido->getComponente()->getIdComponente()."',
					    '".$lineaPedido->getTotalLinea()."', 
					    '".$lineaPedido->getUnidades()."')";
		//echo $sql;
		try {
			$cursor = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch (Exception $ex) {
			throw new InsertarLineaPedidoDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Consulta la lineaPedidoBean pasandole el identificador.
	 * @param $idPedido Identificador del pedido
	 * @param $lineasPedido coleccion de objeto de la clase LineaPedidoBean
	 * @author Miguel Callon
	 */
	public function consultarLineasPedidoPorPedido($idPedido, &$lineasPedido) {
		if (!isset($idPedido)) {
			throw new ConsultarLineaPedidoDAOEx("Id pedido no especificado");
		}
		//se seleccionan de la BD los datos usados para obtener las lineas de pedido
		$sql = "select * from LineaPedido p where p.idPedido=". $idPedido;
		//echo $sql;
		try {
			//se cargan los datos
			$cursor = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
			//se crean las lineas con los datos y se introducen en el vector
			while ($fila = mysql_fetch_array($cursor)) {
				$lineaPedidoBean = new LineaPedidoBean();
				$this->fila2LineaPedidoBean ($fila, $lineaPedidoBean);
				
				$componenteBean = new ComponenteBean();
				$componenteDAO = new ComponenteDAO();
				$componenteDAO->consultarComponente($lineaPedidoBean->getIdComponente(),
													$componenteBean);
				$lineaPedidoBean ->setComponente($componenteBean);
				
				$lineasPedido[count($lineasPedido)] = $lineaPedidoBean;
			}
		} catch (Exception $ex) {
			throw new ConsultarLineaPedidoDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que convierte una linea de pedido de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de LineaPedido de base de datos.
	 * @param $lineaPedidoBean un objeto de tipo LineaPedidoBean.
	 * @author Miguel Callon
	 */
	private function fila2LineaPedidoBean ($fila, LineaPedidoBean $lineaPedidoBean) {
		$lineaPedidoBean->setIdLineaPedido($fila["idLineaPedido"]);
		$lineaPedidoBean->setIdLineaPedido($fila["idPedido"]);
		$lineaPedidoBean->setIdComponente($fila["idComponente"]);
		$lineaPedidoBean->setPrecioUnidad($fila["precioLinea"]);
		$lineaPedidoBean->setUnidades($fila["numUnidades"]);
	}
}
?>