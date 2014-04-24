<?php
/**
 * Clase que almacena los datos de un informe.
 * @author Nuria Canle
 */
class InformeBean {
	
	var $fecha;
	var $numPedidos;
	var $numSubastas;
	var $numPujas;
	var $ganancia;
	var $pagosRecibidos;
	var $pagosEnviados;
	
	/**
	 * Constructor de la clase InformeBean
	 * @author Nuria Canle
	 */
	public function __construct() {
	}
	
	/**
	 * Obtiene la fecha del informe
	 * @param $fecha fecha del informe
	 * @author Nuria Canle
	 */
	public function getFecha() {
		return $this->fecha;
	}
	
	/**
	 * Asigna la fecha del informe
	 * @param $fecha fecha del informe
	 * @author Nuria Canle
	 */
	public function setfecha($fechaInf) {
		$this->fecha = $fechaInf;
	}
	
	/**
	 * Obtiene el numero de pedidos del dia
	 * @param $numPedidos pedidos de esa fecha
	 * @author Nuria Canle
	 */
	public function getNumPedidos() {
		return $this->numPedidos;
	}
	
	/**
	 * Asigna el numero de pedidos de esa fecha
	 * @param $numPed pedidos del dia
	 * @author Nuria Canle
	 */
	public function setNumPedidos($numPed) {
		$this->numPedidos = $numPed;
	}
	/**
	 * Obtiene el numero de subastas del dia
	 * @param $numSubastas subastas de esa fecha
	 * @author Nuria Canle
	 */
	public function getNumSubastas() {
		return $this->numSubastas;
	}
	
	/**
	 * Asigna el numero de subastas de esa fecha
	 * @param $numSub subastas del dia
	 * @author Nuria Canle
	 */
	public function setNumSubastas($numSub) {
		$this->numSubastas = $numSub;
	}
	
	/**
	 * Obtiene el numero de pujas del dia
	 * @param $numPujas pujas de esa fecha
	 * @author Nuria Canle
	 */
	public function getNumPujas() {
		return $this->numPujas;
	}
	
	/**
	 * Asigna el numero de pujas de esa fecha
	 * @param $numPuj pujas del dia
	 * @author Nuria Canle
	 */
	public function setNumPujas($numPuj) {
		$this->numPujas = $numPuj;
	}
	/**
	 * Obtiene la ganancia del dia
	 * @param $ganancia ganancia de esa fecha
	 * @author Nuria Canle
	 */
	public function getGanancia() {
		return $this->ganancia;
	}
	
	/**
	 * Asigna la ganancia de esa fecha
	 * @param $gan gananca del dia
	 * @author Nuria Canle
	 */
	public function setGanancia($gan) {
		$this->ganancia = $gan;
	}
	
	/**
	 * Obtiene el numero de pagos recibidos ese dia
	 * @param $pagosRecibidos pagos recibidos esa fecha
	 * @author Nuria Canle
	 */
	public function getPagosRecibidos() {
		return $this->pagosRecibidos;
	}
	
	/**
	 * Asigna el numero de pagos recibidos esa fecha
	 * @param $pagRec pagos recibidos ese dia
	 * @author Nuria Canle
	 */
	public function setPagosRecibidos($pagRec) {
		$this->pagosRecibidos = $pagRec;
	}
	
	/**
	 * Obtiene el numero de pagos enviados ese dia
	 * @param $pagosEnviados pagos enviados esa fecha
	 * @author Nuria Canle
	 */
	public function getPagosEnviados() {
		return $this->pagosEnviados;
	}
	
	/**
	 * Asigna el numero de pagos enviados esa fecha
	 * @param $pagEnv pagos enviados ese dia
	 * @author Nuria Canle
	 */
	public function setPagosEnviados($pagEnv) {
		$this->pagosEnviados = $pagEnv;
	}
	}
?>