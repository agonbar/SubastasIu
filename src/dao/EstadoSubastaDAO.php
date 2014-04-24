<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL
 * de la entidad EstadoSubasta
 * @author Miguel Callon
 */
class EstadoSubastaDAO extends MysqlDAO implements IEstadoSubastaDAO {
	/**
	 * Metodo que convierte un registro de usuario de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de Estado pedido de base de datos.
	 * @param $estadoSubastaBean un objeto de tipo usuario.
	 * @author Miguel Callon
	 */
	public function fila2EstadoSubastaBean ($fila, EstadoSubastaBean $estadoSubastaBean) {
		$estadoSubastaBean->setIdEstadoSub($fila["idEstadoSub"]);
		$estadoSubastaBean->setNombreEstSub($fila["nombreEstSub"]);
		$estadoSubastaBean->setDesEstSub($fila["desEstSub"]);
	}
}
?>