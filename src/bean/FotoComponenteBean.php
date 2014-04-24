<?php
/**
 * Clase que almacena las fotos de un componente.
 * @author Miguel Callon
 */
class FotoComponenteBean {
	var $idFotoComp;
	var $idCompFoto;
	var $tituloFoto;
	var $descripcionFoto;
	var $ruta;
	var $isPrincipal;
	// Este componente se usa para modificar
	// la foto y saber que ha sido actualizada
	var $actualizada;
	public function __construct() {
	}	
	/**
	 * Obtiene el id de la foto del componente
	 * @return $idFotoComp id de la foto del componente
	 * @author Miguel Callon
	 */
	public function getIdFotoComp() {
		return $this->idFotoComp;
	}
	/**
	 * Asigna el id de la foto del componente
	 * @param $idFotoComp id de la foto del componente
	 * @author Miguel Callon
	 */
	public function setIdFotoComp($idFotoComp) {
		$this->idFotoComp = $idFotoComp;
	}
	/**
	 * Obtiene el id del componente asociado a la foto
	 * @return $idCompFoto Id del componente de la foto
	 * @author Miguel Callon
	 */
	public function getIdCompFoto() {
		return $this->idCompFoto;
	}
	/**
	 * Asigna el id del componente asociado a la foto
	 * @param $idCompFoto Id del componente de la foto
	 * @author Miguel Callon
	 */
	public function setIdCompFoto($idCompFoto) {
		$this->idCompFoto = $idCompFoto;
	}
	/**
	 * Obtiene el titulo de la foto
	 * @return $tituloFoto Titulo de la foto
	 * @author Miguel Callon
	 */
	public function getTituloFoto() {
		return $this->tituloFoto;
	}
	/**
	 * Asigna el titulo de la foto
	 * @param $tituloFoto Titulo de la foto
	 * @author Miguel Callon
	 */
	public function setTituloFoto($tituloFoto) {
		$this->tituloFoto = $tituloFoto;
	}
	/**
	 * Obtiene la descripcion de la foto
	 * @return $descripcionFoto Descripcion foto
	 * @author Miguel Callon
	 */
	public function getDescripcionFoto() {
		return $this->descripcionFoto;
	}
	/**
	 * Asigna la descripcion de la foto
	 * @param $descripcionFoto Descripcion foto
	 * @author Miguel Callon
	 */
	public function setDescripcionFoto($descripcionFoto) {
		$this->descripcionFoto = $descripcionFoto;
	}
	/**
	 * Obtiene la ruta de la foto
	 * @return $ruta Ruta de la foto
	 * @author Miguel Callon
	 */
	public function getRuta() {
		return $this->ruta;
	}
	/**
	 * Asigna la ruta de la foto
	 * @param $ruta Ruta de la foto
	 * @author Miguel Callon
	 */
	public function setRuta($ruta) {
		$this->ruta = $ruta;
	}
	/**
	 * Obtiene si la foto es la foto principal del
	 * componente
	 * @param $$idPrincipal true si es principal
	 * @author Miguel Callon
	 */
	public function getIsPrincipal() {
		return $this->isPrincipal;
	}
	/**
	 * Asigna si la foto es la foto principal del
	 * componente
	 * @param $$idPrincipal true si es principal
	 * @author Miguel Callon
	 */
	public function setIsPrincipal($idPrincipal) {
		$this->isPrincipal = $idPrincipal;
	}
	/**
	 * Obtiene si la foto esta actualizada
	 * @return $actualizada true si esta actualizada
	 * @author Miguel Callon
	 */
	public function getActualizada() {
		return $this->actualizada;
	}
	/**
	 * Asigna si la foto ha sido actualizada
	 * @param $actualizada true si esta actualizada
	 * @author Miguel Callon
	 */
	public function setActualizada($actualizada) {
		$this->actualizada = $actualizada;
	}
	/**
	 * Convierte la foto del componente en una cadena de texto
	 * @author Miguel Callon
	 */
	public function __toString() {
		return "FotoComponenteBean: idFotoComp:".$this->idFotoComp.
			 ", idCompFoto:".$this->idCompFoto.
			 ", tituloFoto:".$this->tituloFoto.
			 ", descripcionFoto:".$this->descripcionFoto.
			 ", ruta:.".$this->ruta.
			 ", isPrincipal".$this->isPrincipal;
	}
}
?>