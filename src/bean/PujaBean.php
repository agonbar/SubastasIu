<?php
/**
 * Clase que almacena los datos de una puja.
 * @author Miguel Callon
 */
class PujaBean {
	var $idPuja;
	var $idSubasta;
	var $idUsuarioPuja;
	var $usuarioPuja;
	var $idEstPuja;
	var $fechaPuja;
	var $horaPuja;
	var $cantPujada;

	/**
	 * Constructor de la clase SubastaBean
	 * @author Miguel Callon
	 */
	public function __construct() {
		
	}
	/**
	 * Obtiene el identificador de la puja
	 * @return $idPuja Id de puja
	 * @author Miguel Callon
	 */
	public function getIdPuja() {
		return $this->idPuja;
	}
	/**
	 * Asigna el identificador de la puja
	 * @param $idPuja Id de puja
	 * @author Miguel Callon
	 */
	public function setIdPuja($idPuja) {
		$this->idPuja = $idPuja;
	}
	/**
	 * Obtiene el identificador de la subasta
	 * donde se ha pujado
	 * @return $idSubasta Identificador de la subasta
	 * @author Miguel Callon
	 */
	public function getIdSubasta() {
		return $this->idSubasta;
	}
	/**
	 * Asigna el identificador de la subasta
	 * donde se ha pujado
	 * @param $idSubasta Identificador de la subasta
	 * @author Miguel Callon
	 */
	public function setIdSubasta($idSubasta) {
		$this->idSubasta = $idSubasta;
	}
	/**
	 * Obtiene el identificador del usuario
	 * que puja
	 * @return $idUsuarioPuja Id del usuario que puja
	 * @author Miguel Callon
	 */
	public function getIdUsuarioPuja() {
		return $this->idUsuarioPuja;
	}
	/**
	 * Asigna el identificador del usuario
	 * que puja
	 * @param $idUsuarioPuja Id del usuario que puja
	 * @author Miguel Callon
	 */
	public function setIdUsuarioPuja($idUsuarioPuja) {
		$this->idUsuarioPuja = $idUsuarioPuja;
	}
	/**
	 * Obtiene el usuario que puja
	 * @return $usuarioPuja El UsuarioBean del usuario
	 * que puja
	 * @author Miguel Callon
	 */
	public function getUsuarioPuja() {
		return $this->usuarioPuja;
	}
	/**
	 * Asigna el usuario que puja
	 * @param $usuarioPuja El UsuarioBean del usuario
	 * @author Miguel Callon
	 */
	public function setUsuarioPuja($usuarioPuja) {
		$this->usuarioPuja = $usuarioPuja;
	}
	/**
	 * Obtiene el id del estado de la puja
	 * @return $idEstPuja
	 * @author Miguel Callon
	 */
	public function getIdEstPuja() {
		return $this->idEstPuja;
	}
	/**
	 * Asigna el id del estado de la puja
	 * @param $idEstPuja Id del estado de la puja
	 * @author Miguel Callon
	 */
	public function setIdEstPuja($idEstPuja) {
		$this->idEstPuja = $idEstPuja;
	}
	/**
	 * Obtiene la fecha de cuando se realizo la puja
	 * @return $fechaPuja Fecha de la puja
	 * @author Miguel Callon
	 */
	public function getFechaPuja() {
		return $this->fechaPuja;
	}
	/**
	 * Asigna la fecha de cuando se realizo la puja
	 * @param $fechaPuja Fecha de la puja
	 * @author Miguel Callon
	 */
	public function setFechaPuja($fechaPuja) {
		$this->fechaPuja = $fechaPuja;
	}
	/**
	 * Obtiene la hora de la puja
	 * @return $horaPuja La hora de la puja
	 * @author Miguel Callon
	 */
	public function getHoraPuja() {
		return $this->horaPuja;
	}
	/**
	 * Asigna la hora de la puja
	 * @param $horaPuja La hora de la puja
	 * @author Miguel Callon
	 */
	public function setHoraPuja($horaPuja) {
		$this->horaPuja = $horaPuja;
	}
	/**
	 * Obtiene la cantidad pujada
	 * @return $cantPujada Cantidad pujada
	 * @author Miguel Callon
	 */
	public function getCantPujada() {
		return $this->cantPujada;
	}
	/**
	 * Asigna la cantidad pujada
	 * @param $cantPujada Cantidad pujada
	 * @author Miguel Callon
	 */
	public function setCantPujada($cantPujada) {
		$this->cantPujada = $cantPujada;
	}
	
	/**
	 * Representa el objeto como una cadena de texto
	 * @author Miguel Callon
	 */
	public function __toString() {
		return "PujaBean: idPuja:".$this->idPuja.
			 ", idSubasta".$this->idSubasta.
			 ", idUsuarioPuja:.".$this->idUsuarioPuja.
			 ", idEstPuja:.".$this->idEstPuja.
			 ", cantPujada:.".$this->cantPujada.
			 ", fechaPuja:.".$this->fechaPuja.
			 ", horaPuja:.".$this->horaPuja;
	}
}
?>