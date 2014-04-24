<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL
 * de la entidad EstadoUsuario
 * @author Miguel Callon
 */
class EstadoUsuarioDAO extends MysqlDAO implements IEstadoUsuarioDAO {
	/**
	 * Metodo que obtiene un EstadoUsuario de base de datos pasandole
	 * un EstadoUsuarioBean con el idEstadoUsuario.
	 * @param $idEstadoUsuario Identificador del estado de usuario
	 * @param $estadoUsuarioBean objeto de la base de datos que tiene los
	 * datos de un estado usuario.
	 * @author Miguel Callon
	 */
	public function consultarEstadoUsuario($idEstadoUsuario, 
										   EstadoUsuarioBean $estadoUsuarioBean) {
		if (!isset($idEstadoUsuario)) {
			throw new ConsultarEstadoUsuDAOEx("IdEstadoUsuario no especificado");
		}
		$sql = " select * from EstadoUsuario u where u.idEstadoUsuario = ".$idEstadoUsuario;
		try {
			$cursor = mysql_query($sql);
			$fila = mysql_fetch_assoc($cursor);
			$this->fila2EstadoUsuarioBean($fila, $estadoUsuarioBean);
		} catch (Exception $ex) {
			throw new ConsultarEstadoUsuDAOEx($ex -> getMessage());
		}
	}	
	
	/**
	 * Metodo que convierte un registro de usuario de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de Usuario de base de datos.
	 * @param $usuarioBean un objeto de tipo usuario.
	 * @author Miguel Callon
	 */
	private function fila2EstadoUsuarioBean ($fila, EstadoUsuarioBean $estadoUsuarioBean) {
		$estadoUsuarioBean->setIdEstadoUsuario($fila["idEstadoUsuario"]);
		$estadoUsuarioBean->setNombre($fila["nombreEstUsu"]);
		$estadoUsuarioBean->setDescripcion($fila["desEstUsu"]);
	}
}
?>