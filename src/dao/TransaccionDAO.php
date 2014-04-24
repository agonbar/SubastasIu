<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL
 * de la entidad Transaccion
 * @author Miguel Callon
 */
class TransaccionDAO extends MysqlDAO implements ITransaccionDAO {
	/**
	 * Metodo que inserta una nueva transaccion en base de datos
	 * @param $transaccionBean La transaccion a insertar
	 * @author Miguel Callon
	 */
	public function insertarTransaccion(TransaccionBean $transaccion) {
		$sql = "insert into Transaccion t (
				idPedido, idUsuOrigTran, idUsuDesTran, fechaTran, concepto, cantidad) 
				values (
				'".$transaccion->getIdPedido()."',
				'".$transaccion->getIdUsuDesTran()."', '".$transaccion->getIdUsuDesTran()."',
				'".$transaccion->getFechaTran()."', '".$transaccion->getConcepto()."',
				'".$transaccion->getImporte()."')";
		try {
			mysql_query($sql);
		} catch (Exception $ex) {
			throw new InsertarTransaccionDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que convierte un registro de Transaccion de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de Transaccion de base de datos.
	 * @param $transaccionBean un objeto de tipo usuario.
	 * @author Miguel Callon
	 */
	private function fila2TransaccionBean ($fila, TransaccionBean $transaccionBean) {
		
	}
}
?>