<?php
/**
 * Clase de la que extienden los controladores de casos de uso
 * de la parte publica.
 * @author Miguel Callon
 */
abstract class PublicoControlador extends AbstractControlador {
	public function accion($accion) {
		$conexionBD = new MysqlDAO();
		try {
			// Abrimos la conexion contra la base de datos
			$conexionBD->connectarBD();
			$conexionBD->abrirTransaccion();
		
			$this->comprobarSubastas();
			$this->ejecutar($accion);
			
			$conexionBD->commit();
			$conexionBD->desconectarBD();
		} catch (Exception $ex) {
			$conexionBD->rollback();
			$conexionBD->desconectarBD();
			throw $ex;
		} 
	}
}
?>