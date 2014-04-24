<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionados con historico de subasta.
 * @author Nuria Canle
 */
interface IHistoricoSubastaDAO extends IDAO {
	/**
	 * Introduce una linea de historico de subasta en base de datos
	 * @param $historicoSubastaBean Objeto de tipo HistoricoSubastaBean
	 * @author Miguel Callon
	 */
	public function insertarHistoricoSubasta(
						HistoricoSubastaBean $historicoSubastaBean);
}
?>