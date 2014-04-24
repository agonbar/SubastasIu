<?php

/**
 * Clase que almacena los datos del estado de subasta.
 * @author Miguel Callon
 */
class EstadoSubastaBean {
	var $idEstadoSub;
	var $nombreEstSub;
	var $desEstSub;
	/**
	 * Constructor de la clase
	 * @author Miguel Callon
	 */
	public function __construct() {
		
	}
	
	/**
	 * Obtiene el atributo idEstadoSub
	 * @return $idEstadoSub identificador del estado de subasta.
	 * @author Miguel Callon
	 */
	public function getIdEstadoSub() {
		return $this->idEstadoSub;
	}
	/**
	 * Asigna el atributo $idEstadoSub
	 * @param $idEstadoSub identificador del estado de subasta.
	 * @author Miguel Callon
	 */
	public function setIdEstadoSub($idEstadoSub) {
		$this->idEstadoSub = $idEstadoSub;
	}
	/**
	 * Obtiene el atributo descripcion estado subasta.
	 * @return $desEstSub Descripcion del estado.
	 * @author Miguel Callon
	 */
	public function getDesEstSub() {
		return $this -> desEstSub;
	}
	/**
	 * Asigna el atributo nombre estado subasta.
	 * @param $desEstSub Descripcion del estado.
	 * @author Miguel Callon
	 */
	public function setDesEstSub($desEstSub) {
		$this->desEstSub = $desEstSub;
	}
	/**
	 * Obtiene el nomre del estado.
	 * @return $nombreEstSub Nombre del estado.
	 * @author Miguel Callon
	 */
	public function getNombreEstSub() {
		return $this->nombreEstSub;
	}
	/**
	 * Asigna el nombre de estado.
	 * @param $nombreEstSub Descripcion del estado.
	 * @author Miguel Callon
	 */
	public function setNombreEstSub($nombreEstSub) {
		$this->nombreEstSub = $nombreEstSub;
	}
	
	public function __toString() {
		return "EstadoUsuarioBean: idEstadoUsuario  = $this->idEstadoUsuario,".
			   "nombre = $this->nombre,".
			   "descripcion = $this->descripcion" ;
	}
}
?>