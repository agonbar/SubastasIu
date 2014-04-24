<?php

/**
 * Clase que almacena los datos de la busqueda de una notificacion.
 * @author Almudena Novoa
 */
class BusquedaNotificacionesBean {
	var $idNotificacion;
	var $idEstadoNotificacion;
	var $idUsuarioOrigen;
	var $idUsuarioDestino;
	var $textoNot;
	var $asuntoNot;
	
	/**
	 * Constructor de la clase
	 * @author Almudena Novoa
	 */
	public function __construct() {
	}
	/**
	 * Obtener id de notificacion
	 * @return $idNotificacion Id de notificacion
	 * @author Almudena Novoa
	 */
	public function getIdNotificacion() {
		return $this->idNotificacion;
	}
	/**
	 * Asignar el id de notificacion
	 * @param $idNotificacion Id de notificacion
	 * @author Almudena Novoa
	 */
	public function setIdNotificacion($idNotificacion) {
		$this->idNotificacion = $idNotificacion;
	}
	/**
	 * Obtener id de la notificacion
	 * @return $idEstadoNotificacion Id del estado de la notificacion
	 * @author Almudena Novoa
	 */
	public function getIdEstadoNotificacion() {
		return $this->idEstadoNotificacion;
	}
	/**
	 * Asignar el id del usuario creador
	 * @param $idEstadoNotificacion Id del estado de la notificacion
	 * @author Almudena Novoa
	 */
	public function setIdEstadoNotificacion($idEstadoNotificacion) {
		$this->idEstadoNotificacion = $idEstadoNotificacion;
	}
	
	/**
	 * Obtener el nombre del usuario de origen
	 * @return $usuarioOrigen Nombre del usuario de origen
	 * @author Almudena Novoa
	 */
	public function getIdUsuarioOrigen() {
		return $this->usuarioOrigen;
	}
	/**
	 * Asignar el nombre del usuario de origen
	 * @param $usuarioOrigen Nombre del usuario de origen
	 * @author Almudena Novoa
	 */
	public function setIdUsuarioOrigen($usuarioOrigen) {
		$this->usuarioOrigen = $usuarioOrigen;
	}
	/**
	 * Obtener el nombre del usuario destino
	 * @return $usuarioDestino Nombre del usuario destino
	 * @author Almudena Novoa
	 */
	public function getIdUsuarioDestino() {
		return $this->idUsuarioDestino;
	}
	/**
	 * Asignar el nombre del usuario destino
	 * @param $usuarioDestino Nombre del usuario destino
	 * @author Almudena Novoa
	 */
	public function setIdUsuarioDestino($idUsuarioDestino) {
		$this->idUsuarioDestino = $idUsuarioDestino;
	}
	/**
	 * Obtener el texto de la notificacion
	 * @return $TextoNot texto de la notificacion
	 * @author Almudena Novoa
	 */
	public function getTextoNot() {
		return $this->TextoNot;
	}
	/**
	 * Asignar el texto de la notificacion
	 * @param $TextoNot texto de la notificacion
	 * @author Almudena Novoa
	 */
	public function setTextoNot($TextoNot) {
		$this->TextoNot = $TextoNot;
	}
	/**
	 * Obtener el asunto de la notificacion
	 * @return $AsuntoNot asunto de la notificacion
	 * @author Almudena Novoa
	 */
	public function getAsuntoNot() {
		return $this->AsuntoNot;
	}
	/**
	 * Asignar el asunto de la notificacion
	 * @param $AsuntoNot asunto de la notificacion
	 * @author Almudena Novoa
	 */
	public function setAsuntoNot($AsuntoNot) {
		$this->AsuntoNot = $AsuntoNot;
	}
	
	/**
	 * Pasa el objeto a una cadena de texto
	 * @author Almudena Novoa
	 */
	public function __toString() {
		return "BusquedaSubastasBean: idNotificacion  = ".$this->idNotificacion.",
		 		idEstadoNotificacion  = ".$this->idEstadoNotificacion.",
				idUsuarioOrigen  = ".$this->idUsuarioOrigen.",
				idUsuarioDestino  = ".$this->idUsuarioDestino.",
				textoNot  = ".$this->textoNot.",
				asuntoNot  = ".$this->asuntoNot;
	}
}
?>