<?php

/**
 * Clase que almacena los datos del estado de usuario.
 * @author Miguel Callon
 */
class EstadoUsuarioBean {
	var $idEstadoUsuario;
	var $nombre;
	var $descripcion;
	/**
	 * Constructor de la clase
	 * @author Miguel Callon
	 */
	public function __construct() {
		
	}
	
	/**
	 * Obtiene el atributo idEstadoUsuario
	 * @return $idEstadoUsuario identificador del estado de usuario.
	 * @author Miguel Callon
	 */
	public function getIdEstadoUsuario() {
		return $this->idEstadoUsuario;
	}
	/**
	 * Asigna el atributo idEstadoUsuario
	 * @param $idEstadoUsuario identificador del estado de usuario.
	 * @author Miguel Callon
	 */
	public function setIdEstadoUsuario($idEstadoUsuario) {
		$this->idEstadoUsuario = $idEstadoUsuario;
	}
	/**
	 * Obtiene el atributo nombre.
	 * @return $nombre Nombre del estado.
	 * @author Miguel Callon
	 */
	public function getNombre() {
		return $this -> nombre;
	}
	/**
	 * Asigna el atributo nombre.
	 * @param $nombre Nombre del estado.
	 * @author Miguel Callon
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	/**
	 * Obtiene la descripcion del estado.
	 * @return $descripcion Descripcion del estado.
	 * @author Miguel Callon
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
	/**
	 * Asigna la descripcion del estado.
	 * @param $descripcion Descripcion del estado.
	 * @author Miguel Callon
	 */
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}
	
	public function __toString() {
		return "EstadoUsuarioBean: idEstadoUsuario  = $this->idEstadoUsuario,".
			   "nombre = $this->nombre,".
			   "descripcion = $this->descripcion" ;
	}
}
?>