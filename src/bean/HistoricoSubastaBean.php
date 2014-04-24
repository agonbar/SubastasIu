<?php

/**
 * Clase que almacena los datos del historico de la subasta.
 * @author Miguel Callon
 */
class HistoricoSubastaBean {
	var $idHistSubasta;
	var $idSubasta;
	var $idEstadoIniSub;
	var $idEstadoFinSub;
	var $motivoSub;
	/**
	 * Constructor de la clase
	 * @author Miguel Callon
	 */
	public function __construct() {
	}
	
	/**
	 * Obtiene el atributo idHistSubasta
	 * @return $idHistSubasta Identificador del historico de la subasta.
	 * @author Miguel Callon
	 */
	public function getIdHistSubasta() {
		return $this->idHistSubasta;
	}
	/**
	 * Asigna el atributo idEstadoPedido
	 * @param $idEstadoPedido identificador del estado de pedido.
	 * @author Miguel Callon
	 */
	public function setIdHistSubasta($idHistSubasta) {
		$this->idHistSubasta = $idHistSubasta;
	}
	/**
	 * Obtiene el atributo idSubasta
	 * @return $idHistSubasta Identificador de la subasta.
	 * @author Miguel Callon
	 */
	public function getIdSubasta() {
		return $this->idSubasta;
	}
	/**
	 * Asigna el atributo idEstadoSubasta
	 * @param $idHistSubasta identificador de la subasta.
	 * @author Miguel Callon
	 */
	public function setIdSubasta($idSubasta) {
		$this->idSubasta = $idSubasta;
	}
	/**
	 * Obtiene el atributo idSubasta
	 * @return $idEstadoIniSub estado inicial de la subasta.
	 * @author Miguel Callon
	 */
	public function getIdEstadoIniSub() {
		return $this->idEstadoIniSub;
	}
	/**
	 * Asigna el atributo idEstadoSubasta
	 * @param $idEstadoIniSub estado final de la subasta.
	 * @author Miguel Callon
	 */
	public function setIdEstadoIniSub($idEstadoIniSub) {
		$this->idEstadoIniSub = $idEstadoIniSub;
	}
	/**
	 * Obtiene el atributo idEstadoFinSub
	 * @return $idEstadoFinSub estado inicial de la subasta.
	 * @author Miguel Callon
	 */
	public function getIdEstadoFinSub() {
		return $this->idEstadoFinSub;
	}
	/**
	 * Asigna el atributo idEstadoFinSub
	 * @param $idEstadoFinSub estado final de la subasta.
	 * @author Miguel Callon
	 */
	public function setIdEstadoFinSub($idEstadoFinSub) {
		$this->idEstadoFinSub = $idEstadoFinSub;
	}
	/**
	 * Obtiene el atributo motivoSub
	 * @return $motivoSub estado inicial de la subasta.
	 * @author Miguel Callon
	 */
	public function getMotivoSub() {
		return $this->motivoSub;
	}
	/**
	 * Asigna el atributo motivoSub
	 * @param $motivoSub estado final de la subasta.
	 * @author Miguel Callon
	 */
	public function setMotivoSub($motivoSub) {
		$this->motivoSub = $motivoSub;
	}
	/**
	 * Convierte el objeto en una cadena de texto
	 * @author Miguel Callon
	 */
	public function __toString() {
		return "HistoricoSubastaBean: idEstadoPedido  = ".$this->idHistSubasta.",
			   nombre = ".$this->idSubasta.",
			   idEstadoIniSub = ".$this->idEstadoIniSub.",
			   idEstadoFinSub = ".$this->idEstadoFinSub.",
			   motivoSub = ".$this->motivoSub;
	}
}
?>