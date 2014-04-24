<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL
 * de la entidad HistoricoPedido
 * @author Miguel Callon
 */
class HistoricoSubastaDAO extends MysqlDAO implements IHistoricoSubastaDAO {
	/**
	 * Introduce una linea de historico de subasta en base de datos
	 * @param $historicoSubastaBean Objeto de tipo HistoricoSubastaBean
	 * @author Miguel Callon
	 */
	public function insertarHistoricoSubasta(
						HistoricoSubastaBean $historicoSubastaBean) {
		//echo "<br/>insertar:".$subasta->toString();
		$sql = " insert into HistoricoSubasta (idEstadoIniSub, idEstadoFinSub,						  
									  motivoSub, idSubasta)
			 values ('" . $historicoSubastaBean -> getIdEstadoIniSub() . "',
			 '" . $historicoSubastaBean->getIdEstadoFinSub(). "',
			 '" . $historicoSubastaBean->getMotivoSub(). "',
			 '" . $historicoSubastaBean->getIdSubasta(). "'
			 )";
		//echo $sql;
		try {
			mysql_query($sql);
		} catch (Exception $ex) {
			throw new InsertarHistSubastaDAOEx($ex -> getMessage());
		}
	}
}
?>