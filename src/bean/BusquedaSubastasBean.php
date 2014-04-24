<?php

/**
 * Clase que almacena los datos de la busqueda de una subasta.
 * @author Miguel Callon
 */
class BusquedaSubastasBean {
	var $idSubasta;
	var $nombreSubasta;
	var $nombreEstSub;
	var $idUsuCreador;
	var $idEstadosSubasta;
	var $nombreComp;
	var $nombreUsuario;
	var $fechaCreacionIni;
	var $fechaCreacionFin;
	var $fechaCierreIni;
	var $fechaCierreFin;
	var $fechaAperturaIni;
	var $fechaAperturaFin;
	
	/**
	 * Constructor de la clase
	 * @author Miguel Callon
	 */
	public function __construct() {
	}
	/**
	 * Obtener id de subasta
	 * @return $idSubasta Id de subasta
	 * @author Miguel Callon
	 */
	public function getIdSubasta() {
		return $this->idSubasta;
	}
	/**
	 * Asignar el id de subasta
	 * @param $idSubasta Id de subasta
	 * @author Miguel Callon
	 */
	public function setIdSubasta($idSubasta) {
		$this->idSubasta = $idSubasta;
	}
	/**
	 * Obtener id de usuario creador
	 * @return $idUsuCreador Id de usuario creador
	 * @author Miguel Callon
	 */
	public function getIdUsuCreador() {
		return $this->idUsuCreador;
	}
	/**
	 * Asignar el id del usuario creador
	 * @param $idUsuCreador Id del usuario creador
	 * @author Miguel Callon
	 */
	public function setIdUsuCreador($idUsuCreador) {
		$this->idUsuCreador = $idUsuCreador;
	}
	
	/**
	 * Obtener el nombre de la subasta
	 * @return $nombreSubasta Nombre de la subasta
	 * @author Miguel Callon
	 */
	public function getNombreSubasta() {
		return $this->nombreSubasta;
	}
	/**
	 * Asignar el nombre de la subasta
	 * @param $nombreSubasta Nombre de la subasta
	 * @author Miguel Callon
	 */
	public function setNombreSubasta($nombreSubasta) {
		$this->nombreSubasta = $nombreSubasta;
	}
	/**
	 * Obtener el nombre del estado de la subasta
	 * @return $nombreEstSub Nombre de estado de la subasta
	 * @author Miguel Callon
	 */
	public function getNombreEstSub() {
		return $this->nombreEstSub;
	}
	/**
	 * Asignar el nombre del estado de la subasta
	 * @param $nombreEstSub Nombre de estado de la subasta
	 * @author Miguel Callon
	 */
	public function setNombreEstSub($nombreEstSub) {
		$this->nombreEstSub = $nombreEstSub;
	}
	/**
	 * Obtener los id de los estados de la subasta
	 * @return $idEstadosSubasta Coleccion de ids estados de subasta
	 * @author Miguel Callon
	 */
	public function getIdEstadosSubasta() {
		return $this->idEstadosSubasta;
	}
	/**
	 * Asignar el nombre de la subasta
	 * @param $idEstadosSubasta Coleccion de ids de estado de subasta
	 * @author Miguel Callon
	 */
	public function setIdEstadosSubasta($idEstadosSubasta) {
		$this->idEstadosSubasta = $idEstadosSubasta;
	}
	/**
	 * Obtener el nombre del componente de la subasta
	 * @return $nombreComp Nombre del componente de la subasta
	 * @author Miguel Callon
	 */
	public function getNombreComp() {
		return $this->nombreComp;
	}
	/**
	 * Asignar el nombre del componente de la subasta
	 * @param $nombreComp Nombre del componente de la subasta
	 * @author Miguel Callon
	 */
	public function setNombreComp($nombreComp) {
		$this->nombreComp = $nombreComp;
	}
	/**
	 * Obtener el nombre del usuario creador de la subasta
	 * @return $nombreUsuario Nombre del usuario creador de la subasta
	 * @author Miguel Callon
	 */
	public function getNombreUsuario() {
		return $this->nombreUsuario;
	}
	/**
	 * Asignar el nombre del usuario creador de la subasta
	 * @param $nombreUsuario Nombre del usuario creador de la subasta
	 * @author Miguel Callon
	 */
	public function setNombreUsuario($nombreUsuario) {
		$this->nombreUsuario = $nombreUsuario;
	}
	/**
	 * Obtener la fecha de creacion inicial para filtrar
	 * @return $fechaCreacionIni Fecha de creacion inicial para filtrar
	 * @author Miguel Callon
	 */
	public function getFechaCreacionIni() {
		return $this->fechaCreacionIni;
	}
	/**
	 * Asignar la fecha de creacion inicial para filtrar
	 * @param $fechaCreacionIni Fecha de creacion inicial para filtrar
	 * @author Miguel Callon
	 */
	public function setFechaCreacionIni($fechaCreacionIni) {
		$this->fechaCreacionIni = $fechaCreacionIni;
	}
	/**
	 * Obtener la fecha de creacion final para filtrar
	 * @return $fechaCreacionFin Fecha de creacion final para filtrar
	 * @author Miguel Callon
	 */
	public function getFechaCreacionFin() {
		return $this->fechaCreacionFin;
	}
	/**
	 * Asignar la fecha de creacion final para filtrar
	 * @param $fechaCreacionFin Fecha de creacion final para filtrar
	 * @author Miguel Callon
	 */
	public function setFechaCreacionFin($fechaCreacionFin) {
		$this->fechaCreacionFin = $fechaCreacionFin;
	}
	/**
	 * Obtener la fecha de apertura inicial para filtrar
	 * @return $fechaAperturaIni Fecha de apertura inicial para filtrar
	 * @author Miguel Callon
	 */
	public function getFechaAperturaIni() {
		return $this->fechaAperturaIni;
	}
	/**
	 * Asignar la fecha de apertura inicial para filtrar
	 * @param $fechaAperturaIni Fecha de apertura inicial para filtrar
	 * @author Miguel Callon
	 */
	public function setFechaAperturaIni($fechaAperturaIni) {
		$this->fechaAperturaIni = $fechaAperturaIni;
	}
	/**
	 * Obtener la fecha de apertura final para filtrar
	 * @return $fechaAperturaFin Fecha de apertura final para filtrar
	 * @author Miguel Callon
	 */
	public function getFechaAperturaFin() {
		return $this->fechaAperturaFin;
	}
	/**
	 * Asignar la fecha de apertura final para filtrar
	 * @param $fechaAperturaFin Fecha de apertura final para filtrar
	 * @author Miguel Callon
	 */
	public function setFechaAperturaFin($fechaAperturaFin) {
		$this->fechaAperturaFin = $fechaAperturaFin;
	}
	/**
	 * Obtener la fecha de cierre inicial para filtrar
	 * @return $fechaCierreIni Fecha de cierre ini para filtrar
	 * @author Miguel Callon
	 */
	public function getFechaCierreIni() {
		return $this->fechaCierreIni;
	}
	/**
	 * Asignar la fecha de cierre ini para filtrar
	 * @param $fechaCierreIni Fecha de cierre ini para filtrar
	 * @author Miguel Callon
	 */
	public function setFechaCierreIni($fechaCierreIni) {
		$this->fechaCierreIni = $fechaCierreIni;
	}
	/**
	 * Obtener la fecha de cierre final para filtrar
	 * @return $fechaCierreFin Fecha de cierre fin para filtrar
	 * @author Miguel Callon
	 */
	public function getFechaCierreFin() {
		return $this->fechaCierreFin;
	}
	/**
	 * Asignar la fecha de cierre final para filtrar
	 * @param $fechaCierreFin Fecha de cierre fin para filtrar
	 * @author Miguel Callon
	 */
	public function setFechaCierreFin($fechaCierreFin) {
		$this->fechaCierreFin = $fechaCierreFin;
	}
	
	/**
	 * Pasa el objeto a una cadena de texto
	 * @author Miguel Callon
	 */
	public function __toString() {
		return "BusquedaSubastasBean: nombreSubasta  = ".$this->nombreSubasta.",
		 		idSubasta  = ".$this->idSubasta.",
				idUsuCreador  = ".$this->idUsuCreador.",
				idEstadosSubasta  = ".$this->idEstadosSubasta.",
				nombreComp  = ".$this->nombreComp.",
				nombreUsuario  = ".$this->nombreUsuario.",
				fechaCreacionIni  = ".$this->fechaCreacionIni.",
				fechaCreacionFin  = ".$this->fechaCreacionFin.",
				fechaCierreIni  = ".$this->fechaCierreIni.",
				fechaCierreFin  = ".$this->fechaCierreFin.",
				fechaAperturaIni  = ".$this->fechaAperturaIni.",
				fechaAperturaFin  = ".$this->fechaAperturaFin;
	}
}
?>