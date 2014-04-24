<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionado con la entidad
 * correspondiente.
 * @author Miguel Callon
 */
interface IEstadoSubastaDAO extends IDAO {
	/**
	 * Metodo que convierte un registro de usuario de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de Estado pedido de base de datos.
	 * @param $estadoSubastaBean un objeto de tipo usuario.
	 * @author Miguel Callon
	 */
	public function fila2EstadoSubastaBean ($fila, EstadoSubastaBean $estadoSubastaBean);
}
?>