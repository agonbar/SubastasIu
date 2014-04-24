<?php
/**
 * Clase que almacena los datos de un componente.
 * @author Nuria Canle
 */
class ComponenteBean {
	var $idComponente;
	var $idUsuVendedor;
	var $usuarioVendedor;
	var $idEstadoComp;
	var $nombre;
	var $descripcionBreve;
	var $descripcion;
	var $precio;
	var $unidadesStock;
	var $listaFotos;
	var $fotoPrincipal;
	public function __construct() {
	}	
	public function getIdComponente() {
		return $this->idComponente;
	}
	public function setIdComponente($idComponente) {
		$this->idComponente = $idComponente;
	}
	public function getIdUsuVendedor() {
		return $this->idUsuVendedor;
	}
	public function setIdUsuVendedor($idUsuVendedor) {
		$this->idUsuVendedor = $idUsuVendedor;
	}
	/**
	 * Obtiene un UsuarioBean con los datos del usuario
	 * vendedor
	 * @return $usuarioVendedor UsuarioBean con los datos del usuario
	 * @author Miguel Callon
	 */
	public function getUsuarioVendedor() {
		return $this->usuarioVendedor;
	}
	/**
	 * Obtiene un UsuarioBean con los datos del usuario
	 * vendedor
	 * @param $usuarioVendedor UsuarioBean con los datos del usuario
	 * @author Miguel Callon
	 */
	public function setUsuarioVendedor($usuarioVendedor) {
		$this->usuarioVendedor = $usuarioVendedor;
	}
	/**
	 * Obtiene la descripcion breve del componente
	 * @return $descripcionBreve Descripcion breve
	 * @author Miguel Callon
	 */
	public function getDescripcionBreve() {
		return $this->descripcionBreve;
	}
	/**
	 * Asigna la descripcion breve del componente
	 * @param $descripcionBreve Descripcion breve
	 * @author Miguel Callon
	 */
	public function setDescripcionBreve($descripcionBreve) {
		$this->descripcionBreve = $descripcionBreve;
	}
	/**
	 * Obtiene la descripcion detallada del componente
	 * @return $descripcion Descripcion detallada
	 * @author Miguel Callon
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
	/**
	 * Asigna la foto principal del componente
	 * @param $fotoPrincipal Foto principal del componente
	 * @author Miguel Callon
	 */
	public function setFotoPrincipal($fotoPrincipal) {
		$this->fotoPrincipal = $fotoPrincipal;
	}
	/**
	 * Obtiene la foto principal componente
	 * @return $fotoPrincipal Foto principal
	 * @author Miguel Callon
	 */
	public function getFotoPrincipal() {
		return $this->fotoPrincipal;
	}
	/**
	 * Asigna la descripcion detallada del componente
	 * @param $descripcion Descripcion detallada
	 * @author Miguel Callon
	 */
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}
	public function getIdEstadoComp() {
		return $this->idEstadoComp;
	}
	public function setIdEstadoComp($idEstadoComp) {
		$this->idEstadoComp = $idEstadoComp;
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	public function getPrecio() {
		return $this->precio;
	}
	public function setPrecio($precio) {
		$this->precio = $precio;
	}
	public function getUnidadesStock() {
		return $this->unidadesStock;
	}
	public function setUnidadesStock($unidadesStock) {
		$this->unidadesStock = $unidadesStock;
	}
	/**
	 * Obtiene una lista de FotoComponenteBean con los datos de las fotos
	 * @return $listaFotos Fotos de los componentes
	 * @author Miguel Callon
	 */
	public function getListaFotos() {
		return $this->listaFotos;
	}
	/**
	 * Asigna una lista de FotoComponenteBean con los datos de las fotos
	 * @param $listaFotos Fotos de los componentes
	 * @author Miguel Callon
	 */
	public function setListaFotos($listaFotos) {
		$this->listaFotos = $listaFotos;
	}
	public function __toString() {
		echo "Fotos:";
		foreach ($this->listaFotos as $foto) {
			echo  "Foto:".$foto;
		} 
		
		return "ComponenteBean: id:".$this->idComponente.
			 ", Vendedor".$this->idUsuVendedor.
			 ", IdEstadoComp".$this->idEstadoComp.
			 ", Nombre".$this->nombre.
			 ", descripcionBreve:.".$this->descripcionBreve.
			 ", descripcion:.".$this->descripcion.
			 ", Precio:.".$this->precio.
			 ", Unidades Stock".$this->unidadesStock;
	}
}
?>