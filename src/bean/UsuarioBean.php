<?php

/**
 * Clase que almacena los datos de un usuario.
 * @author Miguel Callon
 */
class UsuarioBean {
	var $idUsuario;
	var $idEstadoUsuario;
	var $estadoUsuario;
	var $nombre;
	var $apellidos;
	var $direccion;
	var $dni;
	var $telefono;
	var $email;
	var $diaNacimiento;
	var $mesNacimiento;
	var $anhoNacimiento;
	var $fechaNacimiento;
	var $usuario;
	var $clave;
	var $cuentaPayPal;
	var $isAdmin;
	var $localidad;
	var $provincia;
	var $cp;
	
	/**
	 * Constructor de la clase.
	 * @author Miguel Callon
	 */
	public function __construct() {
	}
	/**
	 * Obtiene el identificador del usuario.
	 * @return $idUsuario Identificador de usuario.
	 * @author Miguel Callon
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
	 * Obtiene el identificador del estado de usuario.
	 * @param $idEstadoUsuario Identificador de estado de usuario
	 * @author Miguel Callon
	 */
	public function getIdEstadoUsuario() {
		return $this->idEstadoUsuario;
	}
	/**
	 * Asigna el identificador de estado de usuario.
	 * @param $idEstadoUsuario Identificador de estado de usuario
	 * @author Miguel Callon
	 */
	public function setIdEstadoUsuario($idEstadoUsuario) {
		$this->idEstadoUsuario = $idEstadoUsuario;
	}
	/**
	 * Obtiene un objeto estadoUsuarioBean con los datos
	 * del estado de usuario.
	 * @return estadoUsuario EstadoUsuarioBean
	 * @author Miguel Callon
	 */
	public function getEstadoUsuario() {
		return $this->estadoUsuario;
	}
	/**
	 * Asigna un objeto estadoUsuarioBean con los datos
	 * del estado del usuario
	 * @param $estadoUsuario EstadoUsuarioBean
	 * @author Miguel Callon
	 */
	public function setEstadoUsuario($estadoUsuario) {
		$this->estadoUsuario = $estadoUsuario;
	}
	/**
	 * Obtiene el nombre del usuario.
	 * @return $nombre Nombre del usuario
	 * @author Miguel Callon
	 */
	public function getNombre() {
		return $this -> nombre;
	}
	/**
	 * Asigna el nombre del usuario.
	 * @param $nombre Nombre del usuario
	 * @author Miguel Callon
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	/**
	 * Obtiene los apellidos del usuario.
	 * @return $apellidos Apellidos del usuario
	 * @author Miguel Callon
	 */
	public function getApellidos() {
		return $this->apellidos;
	}
	/**
	 * Asigna los apellidos del usuario.
	 * @param $apellidos Apellidos del usuario.
	 * @author Miguel Callon
	 */
	public function setApellidos($apellidos) {
		$this->apellidos = $apellidos;
	}
	/**
	 * Obtiene el email del usuario.
	 * @return $email devuelve el email del usuario.
	 * @author Miguel Callon
	 */
	public function getEmail() {
		return $this->email;
	}
	/**
	 * Asigna el email del usuario
	 * @param $email Email del usuario
	 * @author Miguel Callon
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	/**
	 * Obtiene la direccion del usuario
	 * @return $direccion Direccion del usuario.
	 * @author Miguel Callon
	 */
	public function getDireccion() {
		return $this->direccion;
	}
	/**
	 * Asigna la direccion del usuario
	 * @param $direccion Direccion del usuario.
	 * @author Miguel Callon
	 */
	public function setDireccion($direccion) {
		$this->direccion = $direccion;
	}
	/**
	 * Obtiene la localidad del usuario
	 * @return $localidad Localidad del usuario
	 * @author Miguel Callon
	 */
	public function getLocalidad() {
		return $this->localidad;
	}
	/**
	 * Asigna la localidad del usuario
	 * @param $localidad Localidad del usuario
	 * @author Miguel Callon
	 */
	public function setLocalidad($localidad) {
		$this->localidad = $localidad;
	}
	/**
	 * Obtener provincia del usuario
	 * @return $provincia Provincia del usuario
	 * @author Miguel Callon
	 */
	public function getProvincia() {
		return $this -> provincia;
	}
	/**
	 * Asigna la provincia del usuario
	 * @param $provincia Provincia del usuario
	 * @author Miguel Callon
	 */
	public function setProvincia($provincia) {
		$this->provincia = $provincia;
	}
	/**
	 * Obtener telefono del usuario.
	 * @return $telefono Telefono del usuario
	 * @author Miguel Callon
	 */
	public function getTelefono() {
		return $this->telefono;
	}
	/**
	 * Asigna el telefono del usuario
	 * @param $telefono Telefono del usuario
	 * @author Miguel Callon
	 */
	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}
	/**
	 * Obtener dni del usuario.
	 * @return $dni Dni del usuario
	 * @author Miguel Callon
	 */
	public function getDni() {
		return $this->dni;
	}
	/**
	 * Asigna el dni del usuario
	 * @param $provincia Dni del usuario
	 * @author Miguel Callon
	 */
	public function setDni($dni) {
		$this->dni = $dni;
	}
	/**
	 * Obtiene el Codigo postal del usuario
	 * @return $cp Codigo postal
	 * @author Miguel Callon
	 */
	public function getCP() {
		return $this->cp;
	}
	/**
	 * Asigna el Codigo postal del usuario
	 * @param $cp Codigo postal del usuario
	 * @author Miguel Callon
	 */
	public function setCP($cp) {
		$this->cp = $cp;
	}
	/**
	 * Obtiene el anho de nacimiento de un usuario
	 * @return $mesNacimiento Mes de nacimiento de usuario
	 * @author Miguel Callon
	 */
	public function getAnhoNacimiento() {
		return $this->anhoNacimiento;
	}
	/**
	 * Asigna el anho de nacimiento del usuario
	 * @param $mesNacimiento Mes de nacimiento de usuario
	 * @author Miguel Callon
	 */
	public function setAnhoNacimiento($anhoNacimiento) {
		$this->anhoNacimiento = $anhoNacimiento;
	}
	/**
	 * Obtiene el mes de nacimiento de un usuario
	 * @return $mesNacimiento Mes de nacimiento de usuario
	 * @author Miguel Callon
	 */
	public function getMesNacimiento() {
		return $this->mesNacimiento;
	}
	/**
	 * Asigna el mes de nacimiento del usuario
	 * @param $mesNacimiento Mes de nacimiento de usuario
	 * @author Miguel Callon
	 */
	public function setMesNacimiento($mesNacimiento) {
		$this->mesNacimiento = $mesNacimiento;
	}
	/**
	 * Obtiene el dia de nacimiento de un usuario
	 * @return $diaNacimiento Dia de nacimiento de usuario
	 * @author Miguel Callon
	 */
	public function getDiaNacimiento() {
		return $this->diaNacimiento;
	}
	/**
	 * Asigna el dia de nacimiento del usuario
	 * @param $diaNacimiento Dia de nacimiento de usuario
	 * @author Miguel Callon
	 */
	public function setDiaNacimiento($diaNacimiento) {
		$this->diaNacimiento = $diaNacimiento;
	}
	/**
	 * Obtiene la fecha de nacimiento de un usuario
	 * @return $fechaNacimiento Fecha de nacimiento de usuario
	 * @author Miguel Callon
	 */
	public function getFechaNacimiento() {
		return $this->fechaNacimiento;
	}
	/**
	 * Asigna el fecha de nacimiento del usuario
	 * @param $fechaNacimiento Fecha de nacimiento de usuario
	 * @author Miguel Callon
	 */
	public function setFechaNacimiento($fechaNacimiento) {
		$this->fechaNacimiento = $fechaNacimiento;
	}
	/**
	 * Obtiene el usuario del sistema
	 * @return $usuario Usuario del sistema
	 * @author Miguel Callon
	 */
	public function getUsuario() {
		return $this->usuario;
	}
	/**
	 * Asigna un usuario del sistema
	 * @param $usuario Usuario del sistema
	 * @author Miguel Callon
	 */
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
	/**
	 * Obtiene el clave del sistema
	 * @return $clave Clave de usuario
	 * @author Miguel Callon
	 */
	public function getClave() {
		return $this->clave;
	}
	/**
	 * Asigna una clave del sistema
	 * @param $clave Usuario del sistema
	 * @author Miguel Callon
	 */
	public function setClave($clave) {
		$this->clave = $clave;
	}
	/**
	 * Obtiene la cuenta de Paypal del usuario
	 * @return $cuentaPayPal Cuenta de Paypal
	 * @author Miguel Callon
	 */
	public function getCuentaPayPal() {
		return $this->cuentaPayPal;
	}
	/**
	 * Asigna la cuenta de Paypal del usuario
	 * @param $cuentaPayPal Cuenta de PayPal del sistema
	 * @author Miguel Callon
	 */
	public function setCuentaPayPal($cuentaPayPal) {
		$this->cuentaPayPal = $cuentaPayPal;
	}
	/**
	 * Obtiene si el usuario es admin
	 * @return $isAdmin Devuelve 1 si es admin
	 * @author Miguel Callon
	 */
	public function getIsAdmin() {
		return $this->isAdmin;
	}
	/**
	 * Asigna si el usuario es admin
	 * @param $isAdmin Asigna 1 si es admin
	 * @author Miguel Callon
	 */
	public function setIsAdmin($isAdmin) {
		$this->isAdmin = $isAdmin;
	}
	/**
	 * Metodo que encadena los datos del usuario.
	 * Muy usado para depurar.
	 * @return una cadena de texto con los datos del usuario.
	 * @author Miguel Callon
	 */
	public function __toString() {
		return "UsuarioBean: idUsuario = $this->idUsuario,".
			   "idEstadoUsuario = $this->idEstadoUsuario,".
			   "estadoUsuario = $this->estadoUsuario,".
			   "nombre = $this->nombre, ".
			   "apellidos = $this->apellidos, ".
			   "direccion = $this->direccion, ".
			   "telefono = $this->telefono, ".
			   "dni = $this->dni, ".
			   "email = $this->email, ".
			   "fechaNacimiento = $this->fechaNacimiento, ".
			   "localidad = $this->localidad, ".
			   "provincia = $this->provincia, ".
			   "usuario = $this->usuario, ".
			   "clave = $this->clave, ".
			   "cuentaPayPal = $this->cuentaPayPal";
	}
}
?>