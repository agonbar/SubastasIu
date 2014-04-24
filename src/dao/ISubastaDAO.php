<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionado con la entidad
 * correspondiente.
 * @author Miguel Callon
 */
interface ISubastaDAO extends IDAO {
	/**
	 * Pone la subasta en estado abierta
	 * @param $idSubasta Id de subasta
	 * @author Miguel Callon
	 */
	public function marcarSubastaAbierta($idSubasta);
	/**
	 * Pone la subasta en estado cerrado
	 * @param $idSubasta Id de subasta
	 * @author Miguel Callon
	 */
	public function marcarSubastaCerrada($idSubasta);
	
	public function crearSubasta(SubastaBean $subasta);
	/**
	 * Lista las subastas de la base de datos
	 * @param $busquedaSubastasBean Objeto con la informacion de busqueda
	 * @param &$listaSubastas coleccion de subastas.
	 * @param $paginadoBean informacion de paginado.
	 * @author Santiago Iglesias
	 */
	public function listarSubastas(BusquedaSubastasBean $busquedaSubastasBean,
								   &$listaSubastas, PaginadoBean $paginadoBean);
	/**
	 * Metodo que cancela una subasta
	 * @param $idSubasta Identificador de subasta
	 * @param $nuevaFechaCierre Objeto con la fecha de cierre
	 * @author Miguel Callon
	 */
	public function modificarFinDeSubasta($idSubasta, $nuevaFechaCierre);
	/**
	 * Metodo que cancela una subasta
	 * @param $idSubasta Identificador de subasta
	 * @author Miguel Callon
	 */
	public function cancelarSubasta($idSubasta);
	/**
	 * Metodo que obtiene una subasta pasando un SubastaBean con el id de la subasta
	 * que se quiere consultar.
	 * @param $idSubasta identificador de la subasta a consultar
	 * @param $subastaBean SubastaBean con los datos de la subasta
	 * @param $paginadoBean PaginadoBean datos del paginado
	 * @author Miguel Callon
	 */
	public function consultarSubasta($idSubasta, SubastaBean $subastaBean,
									 PaginadoBean $paginadoBean);
	/**
	 * Modifica el detalle de una subasta
	 * @idSubasta Identificador de la subasta a modificar
	 * @subasta Objeto subasta con los datos a modificar
	 * @author Miguel Callon
	 */
	public function modificarSubasta($idSubasta, SubastaBean $subasta);
}
?>