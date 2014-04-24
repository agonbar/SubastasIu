<?php
/**
 * Clase que almacena los datos de una notificacion.
 * @author Almudena Novoa
 */
class NotificacionBean {
	var $idNotificacion;
	var $idEstadoNotificacion;
	var $idUsuarioOrigen;
	var $usuarioOrigen;
	var $idUsuarioDestino;
	var $usuarioDestino;
	var $textoNot;
	var $asuntoNot;
	var $fechaEnvioNot;
	var $fechaLecturaNot;
	
	public function __construct() {
		
	}	
	public function getIdNotificacion() 
	{
		return $this->idNotificacion;
	}
	
	public function setIdNotificacion($idNotificacion) 
	{
		$this->idNotificacion = $idNotificacion;
	}
	
	public function getIdEstadoNotificacion() 
	{
		return $this->idEstadoNotificacion;
	}
	
	public function setIdEstadoNotificacion($idEstadoNotificacion) 
	{
		$this->idEstadoNotificacion = $idEstadoNotificacion;
	}
	/**
	 * Obtiene el id del usuario que envia la notificacion
	 * @return $idUsuarioOrigen id del usuario que envia la notificacion
	 * @author Miguel Callon
	 */
	public function getIdUsuarioOrigen() {
		return $this->idUsuarioOrigen;
	}
	/**
	 * Obtiene un id del usuario que envia la notificacion
	 * @param $idUsuarioOrigen id del usuario que envia la notificacion
	 * @author Miguel Callon
	 */
	public function setIdUsuarioOrigen($idUsuarioOrigen) {
		$this->idUsuarioOrigen = $idUsuarioOrigen;
	}
	
	/**
	 * Obtiene un UsuarioBean con los datos del usuario
	 * de origen
	 * @return $usuarioOrigen UsuarioBean con los datos del usuario
	 * @author Almudena Novoa
	 */
	public function getUsuarioOrigen() {
		return $this->usuarioOrigen;
	}
	/**
	 * Obtiene un UsuarioBean con los datos del usuario
	 * de origen
	 * @param $usuarioOrigen UsuarioBean con los datos del usuario
	 * @author Almudena Novoa
	 */
	public function setUsuarioOrigen($usuarioOrigen) {
		$this->usuarioOrigen = $usuarioOrigen;
	}
	/**
	 * Obtiene el id del usuario que recibe la notificacion
	 * @return $idUsuarioDestino id del usuario que recibe la notificacion
	 * @author Miguel Callon
	 */
	public function getIdUsuarioDestino() {
		return $this->idUsuarioDestino;
	}
	/**
	 * Obtiene un id del usuario que recibe la notificacion
	 * @param $idUsuarioDestino id del usuario que recibe la notificacion
	 * @author Miguel Callon
	 */
	public function setIdUsuarioDestino($idUsuarioDestino) {
		$this->idUsuarioDestino = $idUsuarioDestino;
	}
	/**
	 * Obtiene un UsuarioBean con los datos del usuario
	 * de destino
	 * @return $usuarioDestino UsuarioBean con los datos del usuario
	 * @author Almudena Novoa
	 */
	public function getUsuarioDestino() {
		return $this->usuarioDestino;
	}
	/**
	 * Obtiene un UsuarioBean con los datos del usuario
	 * de destino
	 * @param $usuarioDestino UsuarioBean con los datos del usuario
	 * @author Almudena Novoa
	 */
	public function setUsuarioDestino($usuarioDestino) {
		$this->usuarioDestino = $usuarioDestino;
	}
	
	/**
	 * Obtiene el texto que tiene la notificacion
	 * @return $textoNot Texto de la notificacion
	 * @author Almudena Novoa
	 */
	public function getTextoNot()
	{
		return $this->textoNot;
	}
	/**
	 * Asigna un texto a una notificacion
	 * @param $TextoNot Texto de la notificacion
	 * @author Almudena Novoa
	 */
	public function setTextoNot($textoNot) 
	{
		$this->textoNot = $textoNot;
	}
	/**
	 * Obtiene el asunto de una notificacion
	 * @return $asuntoNot Asunto de la notificacion
	 * @author Almudena Novoa
	 */
	public function getAsuntoNot() 
	{
		return $this->asuntoNot;
	}
	/**
	 * Asigna el asunto a una notificacion
	 * @param $asuntoNot Asunto de una notificacion
	 * @author Almudena Novoa
	 */
	public function setAsuntoNot($asuntoNot) 
	{
		$this->asuntoNot = $asuntoNot;
	}
	/**
	 * Obtiene la fecha de envio de una notificacion
	 * @return $fechaEnvioNot Fecha envio de la notificacion
	 * @author Miguel Callon
	 */
	public function getFechaEnvioNot() 
	{
		return $this->fechaEnvioNot;
	}
	/**
	 * Asigna la fecha de envio de una notificacion
	 * @param $fechaEnvioNot Fecha envio de la notificacion
	 * @author Miguel Callon
	 */
	public function setFechaEnvioNot($fechaEnvioNot) 
	{
		$this->fechaEnvioNot = $fechaEnvioNot;
	}	
	
	/**
	 * Obtiene la fecha de lectura de una notificacion
	 * @return $fechaLecturaNot Fecha de lectura de la notificacion
	 * @author Miguel Callon
	 */
	public function getFechaLecturaNot() 
	{
		return $this->fechaLecturaNot;
	}
	/**
	 * Asigna la fecha de lectura de una notificacion
	 * @param $fechaLecturaNot Fecha de lectura de la notificacion
	 * @author Miguel Callon
	 */
	public function setFechaLecturaNot($fechaLecturaNot) 
	{
		$this->fechaLecturaNot = $fechaLecturaNot;
	}	
	
	public function __toString() 
	{			
		return "NotificacionBean: id:".$this->idNotificacion.
			 ", IdEstadoNotificacion".$this->idEstadoNotificacion.
			 ", IdUsuarioOrigen".$this->idUsuarioOrigen.
			 ", IdUsuarioDestino".$this->idUsuarioDestino.
			 ", Texto:.".$this->textoNot.
			 ", Asunto: ".$this->asuntoNot.
			 ", Fecha envio: ".$this->fechaEnvioNot.
			 ", Fecha lectura: ".$this->fechaLecturaNot;			
	}
}
?>