<?php
    /**
 * Clase que almacena los datos de una busqueda de un usuario.
 * @author Nuria Canle
 */
class BusquedaUsuariosBean {
	var $idUsuario;
	var $nombre;
	var $apellidos;
	var $dni;
	var $telefono;
	var $email;
	var $usuario;
	var $isAdmin;
	
	/**
	 * Constructor de la clase.
	 * @author Nuria Canle
	 */
	public function __construct() {
	}
	/**
	 * Obtiene el identificador del usuario.
	 * @return $idUsuario Identificador de usuario.
	 * @author Nuria Canle
	 */
	public function getIdUsuario() {
		return $this->idUsuario;
	}
	/**
	 * Asigna el identificador de usuario.
	 * @param $idUsuario Identificador de usuario
	 * @author Miguel Callon
	 */
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;
	}
	/**
	 * Obtiene el nombre del usuario.
	 * @return $nombre Nombre del usuario
	 * @author Nuria Canle
	 */
	public function getNombre() {
		return $this -> nombre;
	}
	/**
	 * Asigna el nombre del usuario.
	 * @param $nombre Nombre del usuario
	 * @author Nuria Canle
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	/**
	 * Obtiene los apellidos del usuario.
	 * @return $apellidos Apellidos del usuario
	 * @author Nuria Canle
	 */
	public function getApellidos() {
		return $this->apellidos;
	}
	/**
	 * Asigna los apellidos del usuario.
	 * @param $apellidos Apellidos del usuario.
	 * @author Nuria Canle
	 */
	public function setApellidos($apellidos) {
		$this->apellidos = $apellidos;
	}
	/**
	 * Obtiene el email del usuario.
	 * @return $email devuelve el email del usuario.
	 * @author Nuria Canle
	 */
	public function getEmail() {
		return $this->email;
	}
	/**
	 * Asigna el email del usuario
	 * @param $email Email del usuario
	 * @author Nuria Canle
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	/**
	 * Obtener telefono del usuario.
	 * @return $telefono Telefono del usuario
	 * @author Nuria Canle
	 */
	public function getTelefono() {
		return $this->telefono;
	}
	/**
	 * Asigna el telefono del usuario
	 * @param $telefono Telefono del usuario
	 * @author Nuria Canle
	 */
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}
	/**
	 * Obtener dni del usuario.
	 * @return $dni Dni del usuario
	 * @author Nuria Canle
	 */
	public function getDni() {
		return $this->dni;
	}
	/**
	 * Asigna el dni del usuario
	 * @param $provincia Dni del usuario
	 * @author Nuria Canle
	 */
	public function setDni($dni) {
		$this->dni = $dni;
	}
	/**
	 * Obtiene el usuario del sistema
	 * @return $usuario Usuario del sistema
	 * @author Nuria Canle
	 */
	public function getUsuario() {
		return $this->usuario;
	}
	/**
	 * Asigna un usuario del sistema
	 * @param $usuario Usuario del sistema
	 * @author Nuria Canle
	 */
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
	/**
	 * Obtiene si el usuario es admin
	 * @return $isAdmin Devuelve 1 si es admin
	 * @author Nuria Canle
	 */
	public function getIsAdmin() {
		return $this->isAdmin;
	}
	/**
	 * Asigna si el usuario es admin
	 * @param $isAdmin Asigna 1 si es admin
	 * @author Nuria Canle
	 */
	public function setIsAdmin($isAdmin) {
		$this->isAdmin = $isAdmin;
	}
}
?>