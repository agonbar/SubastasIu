<?php
/**
 * Clase que contiene la implementacion de los metodos
 * comunes para todos los DAO que funcionan sobre MySQL
 * @author Miguel Callon
 */
class MysqlDAO extends AbstractDAO implements IDAO {
	private $link;
	
	public function connectarBD() {
		$this->link = mysql_connect(HOST_BD, USUARIO_BD, CLAVE_BD) or 
			die ('No se pudo conectar: ' . mysql_error());
    	mysql_select_db(NOMBRE_BD) or
    		 die('No se pudo seleccionar la base de datos');
	}
	
	public function abrirTransaccion() {
		mysql_query("BEGIN");
	}
	
	function commit() {
		mysql_query("COMMIT");
	}
	
	function rollback() {
		mysql_query("ROLLBACK");
	}
	
	public function desconectarBD() {
		// Cerrar la conexión
		mysql_close($this->link);
	}
	
	public function getIdUltimaInsercion() {
		$rs = mysql_query("SELECT @@identity AS id");
		if ($row = mysql_fetch_row($rs)) {
			$id = trim($row[0]);
		}
		return $id;			
	}
}
?>