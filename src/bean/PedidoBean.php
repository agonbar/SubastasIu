<?php

/**
 * Clase que almacena los datos de un pedido.
 * @author Santiago Iglesias
 */
class PedidoBean {
	var $idPedido;
	var $total;
	var $fechaEnvio;
	var $fechaAlta;
	var $fechaActualizion;
	var $idEstadoPedido;
	var $estadoPedido;
	var $idUsuarioComprador;
	var $usuarioComprador;
	var $idUsuarioVendedor;
	var $usuarioVendedor;
	var $lineasPedido;
	var $valoracion;
	var $comentario;

	/**
	 * Constructor de la clase Pedido.
	 * @author Miguel Callon
	 */ 
	public function __construct() {
		$this->lineasPedido = array();
	}
	/**
	 * Obtiene el identificador del pedido
	 * @return $idPedido Identificador del pedido
	 * @author Miguel Callon
	 */
	public function getIdPedido() {
		return $this->idPedido;
	}
	/**
	 * Asigna el identificador del pedido
	 * @param $idPedido Identificador del pedido
	 * @author Miguel Callon
	 */
	public function setIdPedido($idPedido) {
		$this->idPedido = $idPedido;
	}
	/**
	 * Obtiene la fecha de envio
	 * @return $fechaEnvio La fecha de envio
	 * @author Miguel Callon
	 */
	public function getFechaEnvio() {
		return $this->fechaEnvio;
	}
	/**
	 * Asigna la fecha de envio
	 * @param $fechaEnvio La fecha de envio
	 * @author Miguel Callon
	 */
	public function setFechaEnvio($fechaEnvio) {
		$this->fechaEnvio = $fechaEnvio;
	}
	/**
	 * Obtiene la fecha de alta
	 * @return $fechaAlta Fecha de alta
	 * @author Miguel Callon
	 */
	public function getFechaAlta() {
		return $this->fechaAlta;
	}
	/**
	 * Asigna la fecha de alta
	 * @param $fechaAlta Fecha de alta
	 * @author Miguel Callon
	 */
	public function setFechaAlta($fechaAlta) {
		$this->fechaAlta = $fechaAlta;
	}
	/**
	 * Obtiene la fecha de actualizacion
	 * @return $fechaActualizacion Fecha de actualizacion
	 * @author Miguel Callon
	 */
	public function getFechaActualizacion() {
		return $this->fechaActualizacion;
	}
	/**
	 * Asigna la fecha de actualizacion
	 * @param $fechaActualizacion Fecha de actualizacion
	 * @author Miguel Callon
	 */
	public function setFechaActualizacion($fechaActualizacion) {
		$this->fechaActualizacion = $fechaActualizacion;
	}
	/**
	 * Obtiene el identificador de estado de pedido
	 * @return $idEstadoPedido Identificador de estado del pedido
	 * @author Miguel Callon
	 */
	public function getIdEstadoPedido() {
		return $this->idEstadoPedido;
	}
	/**
	 * Asigna el identifcador de estado de pedido
	 * @param $idEstadoPedido Identificador de estado del pedido
	 * @author Miguel Callon
	 */
	public function setIdEstadoPedido($idEstadoPedido) {
		$this->idEstadoPedido = $idEstadoPedido;
	}
	/**
	 * Obtiene el estado de un pedido
	 * @return $estadoPedido Estado del pedido
	 * @author Miguel Callon
	 */
	public function getEstadoPedido() {
		return $this->estadoPedido;
	}
	/**
	 * Asigna el estado de un pedido
	 * @param $estadoPedido Estado del pedido
	 * @author Miguel Callon
	 */
	public function setEstadoPedido($estadoPedido) {
		$this->estadoPedido = $estadoPedido;
	}
	/**
	 * Obtiene el identificador del usuario comprador
	 * @return idUsuarioComprador Identificador del usuario comprador
	 * @author Miguel Callon
	 */
	public function getIdUsuarioComprador() {
		return $this->idUsuarioComprador;
	}
	/**
	 * Asigna el identificador del usuario comprador
	 * @param $idUsuarioComprador Identificador del usuario comprador
	 * @author Miguel Callon
	 */
	public function setIdUsuarioComprador($idUsuarioComprador) {
		$this->idUsuarioComprador = $idUsuarioComprador;
	}
	/**
	 * Obtiene el usuario comprador
	 * @return $idUsuarioComprador Usuario comprador
	 * @author Miguel Callon
	 */
	public function getUsuarioComprador() {
		return $this->usuarioComprador;
	}
	/**
	 * Asigna el usuario comprador
	 * @param $usuarioComprador Usuario comprador
	 * @author  Miguel Callon
	 */
	public function setUsuarioComprador($usuarioComprador) {
		$this->usuarioComprador = $usuarioComprador;
	}
	/**
	 * Obtiene el identificador del usuario vendedor
	 * @return $idUsuarioVendedor identificador del usuario vendedor
	 * @author Miguel Callon
	 */
	public function getIdUsuarioVendedor() {
		return $this->idUsuarioVendedor;
	}
	/**
	 * Asigna el identificador del usuario vendedor
	 * @param $idUsuarioVendedor identificador del usuario vendedor
	 * @author Miguel Callon
	 */
	public function setIdUsuarioVendedor($idUsuarioVendedor) {
		$this->idUsuarioVendedor = $idUsuarioVendedor;
	}
	
	public function getUsuarioVendedor() {
		return $this->usuarioVendedor;
	}

	public function setUsuarioVendedor($usuarioVendedor) {
		$this->usuarioVendedor = $usuarioVendedor;
	}

	public function getValoracion() {
		return $this -> valoracion;
	}

	public function setValoracion($valor) {
		$this -> valoracion = $valor;
	}

	public function getComentario() {
		return $this -> comentario;
	}

	public function setComentario($comentario) {
		return $this -> comentario = $comentario;
	}

	public function setLineasPedido($lineasPedido) {
		$this->lineasPedido = $lineasPedido;
	}

	public function getLineasPedido() {
		return $this -> lineasPedido;
	}

	public function setTotal($total) {
		$this->total = $total;
	}

	public function getTotal() {
		$total = 0;
		for ($i = 0; $i < count($this -> lineasPedido); $i++) {
			$total += $this -> lineasPedido[$i] -> getPrecioTotal();

		}
		return $total;
	}
	
	/**
	 * Convierte el objeto en una cadena de texto
	 * @author Miguel Callon
	 */
	public function __toString() {
		return "PedidoBean: idPedido: ".$this->idPedido.
				",total: ".$this->total.
				",fechaEnvio: ".$this->fechaEnvio.
				",fechaAlta: ".$this->fechaAlta.
				",fechaActualizion: ".$this->fechaActualizion.
				",idEstadoPedido: ".$this->idEstadoPedido.
				",idUsuarioComprador:".$this->fechaEnvio.
				",idUsuarioVendedor:".$this->idUsuarioVendedor;
	}
	
}
?>