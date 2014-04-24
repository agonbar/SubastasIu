<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL
 * de la entidad EstadoPedido
 * @author Miguel Callon
 */
class EstadoPedidoDAO extends MysqlDAO implements IEstadoPedidoDAO {
	/**
	 * Metodo que obtiene un EstadoUsuario de base de datos pasandole
	 * un EstadoUsuarioBean con el idEstadoUsuario.
	 * @param $idEstadoUsuario Identificador del estado de usuario
	 * @param $estadoUsuarioBean objeto de la base de datos que tiene los
	 * datos de un estado usuario.
	 * @author Miguel Callon
	 */
	public function consultarEstadoPedido($idEstadoPedido, 
										   EstadoPedidoBean $estadoPedidoBean) {
		if (!isset($idEstadoPedido)) {
			throw new ConsultarEstadoPedDAOEx("IdEstadoPedido no especificado");
		}
		$sql = " select * from EstadoPedido u where u.idEstadoPedido = ".$idEstadoPedido;
		try {
			$cursor = mysql_query($sql);
			$fila = mysql_fetch_assoc($cursor);
			$this->fila2EstadoPedidoBean($fila, $estadoPedidoBean);
		} catch (Exception $ex) {
			throw new ConsultarEstadoPedDAOEx($ex -> getMessage());
		}
	}	
	
	/**
	 * Metodo que convierte un registro de usuario de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de Estado pedido de base de datos.
	 * @param $estadoPedidoBean un objeto de tipo usuario.
	 * @author Miguel Callon
	 */
	private function fila2EstadoPedidoBean ($fila, EstadoPedidoBean $estadoPedidoBean) {
		$estadoPedidoBean->setIdEstadoPedido($fila["idEstadoPedido"]);
		$estadoPedidoBean->setNombre($fila["nombreEstPed"]);
		$estadoPedidoBean->setDescripcion($fila["desEstPed"]);
	}
}
?>