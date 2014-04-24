<?php
/**
 * Clase que almacena los datos de una subasta.
 * @author Miguel Callon
 */
class SubastaBean {
	var $idSubasta;
	var $idUsuCreador;
	var $usuarioCreador;
	var $idEstadoSub;
	var $estadoSubasta;
	var $idCompSub;
	var $compSub;
	var $numCompSub;
	var $titulo;
	var $descripcionBreve;
	var $descripcion;
	var $fechaCierre;
	var $horaCierre;
	var $fechaApertura;
	var $horaApertura;
	var $fechaCreacion;
	var $precioInicial;
	var $listaPujas;
	var $pujaGanadora;
	var $idFotoComp;
	var $tituloFotoSub;
	var $desFotoSub;
	var $rutaFotoSub;
	/**
	 * Constructor de la clase SubastaBean
	 * @author Miguel Callon
	 */
	public function __construct() {
	}
	/**
	 * Obtiene el identificador de la subasta
	 * @param $idSubasta Identificador de la subasta
	 * @author Miguel Callon
	 */
	public function getIdSubasta() {
		return $this->idSubasta;
	}
	/**
	 * Asigna el identificador de subasta
	 * @param $idSubasta Identificador de la subasta
	 * @author Miguel Callon
	 */
	public function setIdSubasta($idSubasta) {
		$this->idSubasta = $idSubasta;
	}
	/**
	 * Obtiene el identificador del creador de la subasta
	 * @return $idUsuCreador Identificador del usuario creador
	 * @author Miguel Callon
	 */
	public function getIdUsuCreador() {
		return $this->idUsuCreador;
	}
	/**
	 * Asigna el identificador del usuario creador de la subasta
	 * @param $idUsuCreador Identificador del usuario creador
	 * @author Miguel Callon
	 */
	public function setIdUsuCreador($idUsuCreador) {
		$this->idUsuCreador = $idUsuCreador;
	}
	/**
	 * Obtiene el usuario creador de la subasta
	 * @return $usuarioCreador Usuario creador
	 * @author Miguel Callon
	 */
	public function getUsuarioCreador() {
		return $this->usuarioCreador;
	}
	/**
	 * Asigna el usuario creador de la subasta
	 * @param $usuarioCreador Usuario creador
	 * @author Miguel Callon
	 */
	public function setUsuarioCreador($usuarioCreador) {
		$this->usuarioCreador = $usuarioCreador;
	}
	/**
	 * Obtiene el identificador de estado de la subasta
	 * @return $idEstadoSub Identificador de estado de subasta
	 * @author Miguel Callon
	 */
	public function getIdEstadoSub() {
		return $this->idEstadoSub;
	}
	/**
	 * Asigna el identificador del estado
	 * @param $idEstadoSub Identificador de estado de pedido
	 * @author Miguel Callon
	 */
	public function setIdEstadoSub($idEstadoSub) {
		$this->idEstadoSub = $idEstadoSub;
	}
	/**
	 * Obtiene el estado de la subasta
	 * @return $estadoSubasta Estado subasta
	 * @author Miguel Callon
	 */
	public function getEstadoSubasta() {
		return $this->estadoSubasta;
	}
	/**
	 * Asigna el estado de la subasta
	 * @param $estadoSubasta Estado subasta
	 * @author Miguel Callon
	 */
	public function setEstadoSubasta($estadoSubasta) {
		$this->estadoSubasta = $estadoSubasta;
	}
	/**
	 * Obtiene el identificador del componente subastado
	 * @return $idCompSub Id componente subastado
	 * @author Miguel Callon
	 */
	public function getIdCompSub() {
		return $this->idCompSub;
	}
	/**
	 * Asigna el identificador del componente subastado
	 * @param $idCompSub Id componente subastado
	 * @author Miguel Callon
	 */
	public function setIdCompSub($idCompSub) {
		$this->idCompSub = $idCompSub;
	}
	/**
	 * Obtiene el componente subastado
	 * @return $compSub Componente subastado
	 * @author Miguel Callon
	 */
	public function getCompSub() {
		return $this->compSub;
	}
	/**
	 * Asigna el componente subastado
	 * @param $compSub Componente subastado
	 * @author Miguel Callon
	 */
	public function setCompSub($compSub) {
		$this->compSub = $compSub;
	}
	/**
	 * Obtiene el titulo de la subasta
	 * @return $titulo Titulo de la subasta
	 * @author Miguel Callon
	 */
	public function getTitulo() {
		return $this->titulo;
	}
	/**
	 * Asigna el titulo de la subasta
	 * @param $titulo Titulo de la subasta
	 * @author Miguel Callon
	 */
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	
	/**
	 * Obtiene la descripcion breve de la subasta
	 * @return $descripcionBreve Descripcion breve
	 * @author Miguel Callon
	 */
	public function getDescripcionBreve() {
		return $this->descripcionBreve;
	}
	/**
	 * Asigna la descripcion breve
	 * @param $descripcionBreve Descripcion breve
	 * @author Miguel Callon
	 */
	public function setDescripcionBreve($descripcionBreve) {
		$this->descripcionBreve = $descripcionBreve;
	}
	/**
	 * Obtiene la descripcion de la subasta
	 * @return $descripcion Descripcion
	 * @author Miguel Callon
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
	/**
	 * Asigna la descripcion
	 * @param $descripcion Descripcion
	 * @author Miguel Callon
	 */
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}
	/**
	 * Obtiene la hora de cierre
	 * @return $horaCierre Fecha de cierre
	 * @author Miguel Callon
	 */
	public function getHoraCierre() {
		return $this->horaCierre;
	}
	/**
	 * Asigna la fecha de cierre
	 * @param $horaCierre Fecha de cierre
	 * @author Miguel Callon
	 */
	public function setHoraCierre($horaCierre) {
		$this->horaCierre = $horaCierre;
	}
	/**
	 * Obtiene la fecha de cierre
	 * @return $fechaCierre Fecha de cierre
	 * @author Miguel Callon
	 */
	public function getFechaCierre() {
		return $this->fechaCierre;
	}
	/**
	 * Asigna la fecha de cierre
	 * @param $fechaCierre Fecha de cierre
	 * @author Miguel Callon
	 */
	public function setFechaCierre($fechaCierre) {
		$this->fechaCierre = $fechaCierre;
	}
	/**
	 * Obtiene la fecha de apertura
	 * @return $fechaApertura Fecha de apertura
	 * @author Miguel Callon
	 */
	public function getFechaApertura() {
		return $this->fechaApertura;
	}
	/**
	 * Asigna la fecha de apertura
	 * @param $fechaApertura Fecha de apertura
	 * @author Miguel Callon
	 */
	public function setFechaApertura($fechaApertura) {
		$this->fechaApertura = $fechaApertura;
	}
	/**
	 * Obtiene la hora de apertura
	 * @return $horaApertura Hora de apertura
	 * @author Miguel Callon
	 */
	public function getHoraApertura() {
		return $this->horaApertura;
	}
	/**
	 * Asigna la hora de apertura
	 * @param $horaApertura Hora de apertura
	 * @author Miguel Callon
	 */
	public function setHoraApertura($horaApertura) {
		$this->horaApertura = $horaApertura;
	}
	/**
	 * Obtiene la fecha de creacion
	 * @return $fechaCreacion Fecha de creacion
	 * @author Miguel Callon
	 */
	public function getFechaCreacion() {
		return $this->fechaCreacion;
	}
	/**
	 * Asigna la fecha de creacion
	 * @param $fechaCreacion Fecha de creacion
	 * @author Miguel Callon
	 */
	public function setFechaCreacion($fechaCreacion) {
		$this->fechaCreacion = $fechaCreacion;
	}
	/**
	 * Obtiene el tiempo restante de apertura
	 * @return $tiempoRestante Tiempo restante
	 * @author Miguel Callon
	 */
	public function getTiempoRestante() {
		// Transaccion del comprador a la plataforma
		$datetime1 = new DateTime("now");
		$datetime2 = new DateTime(str_replace('/', '-',$this->fechaCierre));
		$intervalo = $datetime2->diff($datetime1);
		return $intervalo->format('%a '.MultiIdioma::gettextoSinEcho("comun.dias").' %h '.
										MultiIdioma::gettextoSinEcho("comun.horas").' %i '.
										MultiIdioma::gettextoSinEcho("comun.minutos"));
	}
	/**
	 * Obtiene el precio inicial
	 * @return $precioInicial Precio inicial
	 * @author Miguel Callon
	 */
	public function getPrecioInicial() {
		return $this->precioInicial;
	}
	/**
	 * Asigna el precio inicial
	 * @param $precioInicial Precio inicial
	 * @author Miguel Callon
	 */
	public function setPrecioInicial($precioInicial) {
		$this->precioInicial = $precioInicial;
	}
	/**
	 * Obtiene el listado de pujas
	 * @return $listaPujas Lista pujas
	 * @author Miguel Callon
	 */
	public function getListaPujas() {
		return $this->listaPujas;
	}
	/**
	 * Asigna el listado de pujas
	 * @param $listaPujas Lista pujas
	 * @author Miguel Callon
	 */
	public function setListaPujas($listaPujas) {
		$this->listaPujas = $listaPujas;
	}
	/**
	 * Obtiene la puja ganadora
	 * @return $listaPujas Lista pujas
	 * @author Miguel Callon
	 */
	public function getPujaGanadora() {
		return $this->pujaGanadora;
	}
	/**
	 * Asigna la puja ganadora
	 * @param $listaPujas Lista pujas
	 * @author Miguel Callon
	 */
	public function setPujaGanadora($pujaGanadora) {
		$this->pujaGanadora = $pujaGanadora;
	}
	/**
	 * Obtiene el nombre de la foto de la subasta
	 * @return $tituloFotoSub Nombre de la foto de la subasta
	 * @author Miguel Callon
	 */
	public function getTituloFotoSub() {
		return $this->tituloFotoSub;
	}
	/**
	 * Asigna el titulo de la foto de la subasta
	 * @param $tituloFotoSub Titulo de la foto de la subasta
	 * @author Miguel Callon
	 */
	public function setTituloFotoSub($tituloFotoSub) {
		$this->tituloFotoSub = $tituloFotoSub;
	}
	/**
	 * Obtiene el nombre de la foto de la subasta
	 * @return $desFotoSub Nombre de la foto de la subasta
	 * @author Miguel Callon
	 */
	public function getDesFotoSub() {
		return $this->desFotoSub;
	}
	/**
	 * Asigna la descripcion de la foto de la subasta
	 * @param $desFotoSub Descripcion de la foto de la subasta
	 * @author Miguel Callon
	 */
	public function setDesFotoSub($desFotoSub) {
		$this->desFotoSub = $desFotoSub;
	}
	/**
	 * Obtiene la ruta de la foto de la subasta
	 * @return $rutaFotoSub Ruta foto de subasta
	 * @author Miguel Callon
	 */
	public function getRutaFotoSub() {
		return $this->rutaFotoSub;
	}
	/**
	 * Asigna la ruta de la foto de la subasta
	 * @param $rutaFotoSub Ruta de la foto de la subasta
	 * @author Miguel Callon
	 */
	public function setRutaFotoSub($rutaFotoSub) {
		$this->rutaFotoSub = $rutaFotoSub;
	}
	/**
	 * Obtiene el numero de componentes de la subasta
	 * @return $numCompSub Numero de componentes de la subasta
	 * @author Miguel Callon
	 */
	public function getNumCompSub() {
		return $this->numCompSub;
	}
	/**
	 * Asigna el numero de componentes de la subasta
	 * @param $numCompSub Numero de componentes de la subasta
	 * @author Miguel Callon
	 */
	public function setNumCompSub($numCompSub) {
		$this->numCompSub = $numCompSub;
	}
	/**
	 * Obtiene el identificador del componente
	 * @return $idFotoComp Identificador del componente
	 * @author Miguel Callon
	 */
	public function getIdFotoComp() {
		return $this->idFotoComp;
	}
	/**
	 * Asigna el identificador del componente
	 * @param $idFotoComp Identificador del componente
	 * @author Miguel Callon
	 */
	public function setIdFotoComp($idFotoComp) {
		$this->idFotoComp = $idFotoComp;
	}
	/**
	 * Representa el objeto como una cadena de texto
	 * @author Miguel Callon
	 */
	public function __toString() {	
		return "SubastaBean: idSubasta:".$this->idSubasta.
			 ", idUsuCreador".$this->idUsuCreador.
			 ", idEstadoSub:.".$this->idEstadoSub.
			 ", fechaCierre:.".$this->fechaCierre.
			 ", horaCierre:.".$this->horaCierre.
			 ", fechaApertura:.".$this->fechaApertura.
			 ", horaApertura:.".$this->horaApertura.
			 ", precioInicial:.".$this->precioInicial.
			 ", tituloFotoSub:.".$this->tituloFotoSub.
			 ", desFotoSub:.".$this->desFotoSub.
			 ", rutaFotoSub:.".$this->rutaFotoSub;
	}
}
?>