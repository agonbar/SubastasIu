<?php
/**
 * Clase que almacena los datos de una transaccion.
 * @author Miguel Callon
 */
class TransaccionBean {
	var $idTran;
	var $idPedido;
	var $idUsuOrigTran;
	var $idUsuDesTran;
	var $fechaTran;
	var $concepto;
	var $importe;
	/**
	 * Constructor de la clase.
	 * @author Miguel Callon
	 */
	public function __construct($idTran, $idPedido, $idUsuOrigTran,
							    $idUsuDesTran, $fechaTran, $concepto, $importe) {
		$this->idTran=$idTran;
		$this->idPedido=$idPedido;
		$this->idUsuDesTran=$idUsuDesTran;
		$this->idUsuOrigTran=$idUsuOrigTran;
		$this->fechaTran=$fechaTran;
		$this->concepto=$concepto;
		$this->importe=$importe;
	}
	/**
	 * Obtiene el identificador de la transaccion.
	 * @return $idTran Identificador de la transaccion
	 * @author Miguel Callon
	 */
	public function getIdTran() {
		return $this->idTran;
	}
	/**
	 * Asigna el identificador de la transaccion.
	 * @param $idUsuario Identificador de la transaccion
	 * @author Miguel Callon
	 */
	public function setIdTran($idTran) {
		$this->idTran = $idTran;
	}
	/**
	 * Obtiene el identificador del pedido asociao a la transaccion.
	 * @return $idTran Identificador del pedido
	 * @author Miguel Callon
	 */
	public function getIdPedido() {
		return $this->idPedido;
	}
	/**
	 * Asigna el identificador del pedido asociado a la transaccion.
	 * @param $idPedido Identificador del pedido
	 * @author Miguel Callon
	 */
	public function setIdPedido($idPedido) {
		$this->idPedido = $idPedido;
	}
	/**
	 * Obtiene el identificador del idUsuario que inicia la transaccion.
	 * @return $idUsuOrigTran Identificador de la transaccion
	 * @author Miguel Callon
	 */
	public function getIdUsuOrigTran() {
		return $this->idUsuOrigTran;
	}
	/**
	 * Asigna el identificador del idUsuario que inicia la transaccion.
	 * @param $idUsuOrigTran Identificador de usuario
	 * @author Miguel Callon
	 */
	public function setIdUsuOrigTran($idUsuOrigTran) {
		$this->idUsuOrigTran = $idUsuOrigTran;
	}
	/**
	 * Obtiene el identificador del idUsuario que recibe la transaccion.
	 * @return $idUsuDesTran Identificador de la transaccion
	 * @author Miguel Callon
	 */
	public function getIdUsuDesTran() {
		return $this->idUsuDesTran;
	}
	/**
	 * Asigna el identificador del idUsuario que recibe la transaccion.
	 * @param $idUsuDesTran Identificador de usuario
	 * @author Miguel Callon
	 */
	public function setIdUsuDesTran($idUsuDesTran) {
		$this->idUsuDesTran = $idUsuDesTran;
	}
	/**
	 * Obtiene el la fecha en que se realiza la transaccion.
	 * @return $fechaTran Fecha de la transaccion
	 * @author Miguel Callon
	 */
	public function getFechaTran() {
		return $this->fechaTran;
	}
	/**
	 * Asigna el identificador del idUsuario que recibe la transaccion.
	 * @param $fechaTran Fecha de la transaccion
	 * @author Miguel Callon
	 */
	public function setFechaTran($fechaTran) {
		$this->fechaTran = $fechaTran;
	}
	/**
	 * Obtiene el concepto de la transaccion.
	 * @return $concepto Concepto de la transaccion
	 * @author Miguel Callon
	 */
	public function getConcepto() {
		return $this->concepto;
	}
	/**
	 * Asigna el concepto de la transaccion.
	 * @param $concepto Concepto de la transaccion
	 * @author Miguel Callon
	 */
	public function setConcepto($concepto) {
		$this->concepto = $concepto;
	}
	/**
	 * Obtiene el importe de la transaccion.
	 * @return $importe Importe de la transaccion
	 * @author Miguel Callon
	 */
	public function getImporte() {
		return $this->importe;
	}
	/**
	 * Asigna el importe de la transaccion.
	 * @param $importe Importe de la transaccion
	 * @author Miguel Callon
	 */
	public function setImporte($concepto) {
		$this->importe = $importe;
	}
	/**
	 * Metodo que encadena los datos del usuario.
	 * Muy usado para depurar.
	 * @return una cadena de texto con los datos del usuario.
	 * @author Miguel Callon
	 */
	public function __toString() {
		return "TransaccionBean: idTran = $this->idTran,".
			   "idPedido = $this->idPedido,".
			   "idUsuOrigTran = $this->idUsuOrigTran,".
			   "idUsuDesTran = $this->idUsuDesTran, ".
			   "fechaTran = $this->fechaTran, ".
			   "concepto = $this->concepto, ".
			   "importe = $this->importe";
	}
}
?>