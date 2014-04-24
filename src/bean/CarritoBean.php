<?php

/**
 * Clase que almacena los datos del carrito.
 * @author Hector Riopedre
 */
class CarritoBean {
	var $numComponentes;
	var $listaComponentes;

	/**
	 * Constructor de la clase Carrito.
	 * @author Hector Riopedre
	 */
	public function __construct() {
		$this -> listaComponentes = array();
		$this -> numComponentes = array();
	}

	public function setListaComponentes($listaComponentes) {
		$this -> listaComponentes = $listaComponentes;
	}

	public function getListaComponentes() {
		return $this -> listaComponentes;

	}

	public function setNumComponentes($numComponentes) {
		$this -> numComponentes = $numComponentes;
	}

	public function getNumComponentes() {
		return $this -> numComponentes;

	}
	
	 /**
	 * Inserta un componente en el carrito, 
	 * o incrementa su numero si este ya esta presente.
	 * @param $lineaPedidoBean Bean de componente a insertar.
	 * @author Hector Riopedre
	 */
	public function addComponente(LineaPedidoBean $lineaPedidoBean) {
		$id = $lineaPedidoBean -> getComponente() -> getIdComponente();
		if (isset($this -> listaComponentes["$id"])) {
			$this -> numComponentes["$id"]++;
		} else {
			$this -> listaComponentes["$id"] = $lineaPedidoBean;
			$this -> numComponentes["$id"] = 1;
		}
	}
/**
	 * Borra un componente del carrito 
	 * @param $compBean Bean de componente a borrar.
	 * @author Hector Riopedre
	 */
	public function removeComponente($id) {
		
			unset($this -> listaComponentes["$id"]);
			unset($this -> numComponentes["$id"]);
	}
	
	public function getTotal() {
		$total = 0;
		foreach ($this->listaComponentes as $componente) {
			$total += $componente -> getTotalLinea() * $componente -> getUnidades();
		}
		return $total;
	}

	/**
	 * Convierte el objeto en una cadena de texto
	 * @author Hector Riopedre
	 */
	public function __toString() {
		return "total: " . $this -> getTotalLinea();

	}

}
?>