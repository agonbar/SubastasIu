<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionado con la entidad
 * correspondiente.
 * @author Miguel Callon
 */
interface ITransaccionDAO extends IDAO {
	/**
	 * Metodo que inserta una nueva transaccion en base de datos
	 * @param $transaccionBean La transaccion a insertar
	 * @author Miguel Callon
	 */
	public function insertarTransaccion(TransaccionBean $transaccion);
}
?>