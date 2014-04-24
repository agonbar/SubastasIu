<?php

/**
 * Clase que almacena los datos del estado de una notificacion.
 * @author Almudena Novoa
 */
class EstadoNotificacionBean {
	var $idEstadoNotificacion;
	var $nombreEstNot;
	var $desEstNot;
	/**
	 * Constructor de la clase
	 * @author Almudena Novoa
	 */
	public function __construct() {
		
	}
	
	/**
	 * Obtiene el atributo idEstadoNotificacion
	 * @return $idEstadoNotificacion identificador del estado de una notificacion.
	 * @author Almudena Novoa
	 */
	public function getIdEstadoNotificacion() {
		return $this->idEstadoNotificacion;
	}
	/**
	 * Asigna el atributo idEstadoNotificacion
	 * @param $idEstadoNotificacion identificador del estado de una notificacion.
	 * @author Almudena Novoa
	 */
	public function setIdEstadoNotificacion($idEstadoNotificacion)
	 {
		$this->idEstadoNotificacion = $idEstadoNotificacion;
	}
	/**
	 * Obtiene el atributo descripcion estado de una notificacion.
	 * @return $desEstNot Descripcion del estado.
	 * @author Almudena Novoa
	 */
	public function getDesEstNot() 
	{
		return $this -> desEstNot;
	}
	/**
	 * Asigna el atributo descripcion estado de una notificacion.
	 * @param $desEstNot Descripcion del estado.
	 * @author Almudena Novoa
	 */
	public function setDesEstNot($desEstNot) {
		$this->desEstNot = $desEstNot;
	}
	/**
	 * Obtiene el nomre del estado.
	 * @return $nombreEstNot Nombre del estado.
	 * @author Almudena Nova
	 */
	public function getNombreEstMen() {
		return $this->nombreEstMen;
	}
	/**
	 * Asigna el nombre de estado.
	 * @param $nombreEstNot Descripcion del estado.
	 * @author Almudena Novoa
	 */
	public function setNombreEstNot($nombreEstNot) {
		$this->nombreEstNot = $nombreEstNot;
	}
	
	public function __toString() {
		return "EstadoNotificacionBean: idEstadoNotificacion".$this->idEstadoNotificacion.
			   "nombre".$this->nombreEstNot.
			   "descripcion".$this->desEstNot;
	}
}
?>