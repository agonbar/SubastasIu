<?php
/**
 * Clase que almacena los datos del paginado de un listado.
 * @author Miguel Callon
 */
class PaginadoBean {
	var $numPag; // Numero de pagina seleccionada
	var $campoOrdenSelec; // Campo o campos por los que se ordena la tabla
	var $camposOrden; // Posibles campos por los que se puede ordenar
	var $numElemPag; // Numero de elementos que se muestran en una pagina
	var $numElemTotal; // Numero de elementos que se muestran en una pagina
	public function __construct($numPag, $campoOrdenSelec, $numElemPag, $numElemTotal) {
		$this->numPag = $numPag;
		$this->campoOrdenSelec = $campoOrdenSelec;
		$this->numElemPag = $numElemPag;
		$this->numElemTotal = $numElemTotal;
	}
	/**
	 * Devuelve el atributo numPag.
	 */
	public function getNumPag() {
		return $this->numPag;
	}
	/**
	 * Asigna el atributo numPag.
	 */
	public function setNumPag($numPag) {
		$this->numPag = $numPag;
	}
	/**
	 * Devuelve el atributo campoOrden.
	 */
	public function getCampoOrdenSelec() {
		return $this->campoOrdenSelec;
	}
	/**
	 * Asigna el atributo campoOrden.
	 */
	public function setCampoOrdenSelec($campoOrdenSelec) {
		$this->campoOrdenSelec = $campoOrdenSelec;
	}
	/**
	 * Devuelve el atributo camposOrden.
	 */
	public function getCamposOrden() {
		return $this->camposOrden;
	}
	/**
	 * Asigna el atributo camposOrden.
	 */
	public function setCamposOrden($camposOrden) {
		$this->camposOrden = $camposOrden;
	}
	/**
	 * Devuelve el atributo numElemPag.
	 */
	public function getNumElemPag() {
		return $this->numElemPag;
	}
	/**
	 * Asigna el atributo numElemPag.
	 */
	public function setNumElemPag($numElemPag) {
		$this->numElemPag = $numElemPag;
	}
	/**
	 * Devuelve el atributo numElemTotal.
	 */
	public function getNumElemTotal() {
		return $this->numElemTotal;
	}
	/**
	 * Asigna el atributo numElemTotal.
	 */
	public function setNumElemTotal($numElemTotal) {
		$this->numElemTotal = $numElemTotal;
	}
	/**
	 * Devuelve el atributo numElemTotal.
	 */
	public function getNumPagTotal() {		
		return ceil($this->numElemTotal / $this->numElemPag);
	}
	/**
	 * Se utiliza para las consultas para el LIMIT inicioPag,numElemPag
	 */
	public function getInicioPagSQL() {
		// Importante! Se le resta al numero de pagina 1 porque el numero
		// de registros de la base de datos empieza en 0, y el paginad
		// que se muestra en la vista siempre en 1.
		return ($this->numPag - 1) * $this->numElemPag;
	}
	public function __toString() {
		return "PaginadoBean: numPag:".$this->numPag.
			 ", campoOrden".$this->campoOrdenSelec.
			 ", numElemPag:.".$this->numElemPag.
			 ", numPagTotal:.".$this->getNumPagTotal();
	}
}
?>