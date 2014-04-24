<?php
/**
 * Interfaz que declara los metodos genericos independientes
 * de la base de datos.
 * @author Miguel Callon
 */
interface IDAO {
	public function connectarBD();
	public function desconectarBD();
	public function abrirTransaccion();
	public function commit();
	public function rollback();
}
?>