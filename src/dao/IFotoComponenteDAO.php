<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionados con fotos de componentes.
 * @author Miguel Callon
 */
interface IFotoComponenteDAO extends IDAO {
	/**
	 * Lista las fotos de los componentes de la base de datos
	 * @param $idComponente Busqueda de fotos de componentes
	 * @param &$listaFotosComponente coleccion de fotos de un componentes.
	 * @author Miguel Callon
	 */
	public function listarFotosComponente($idComponente,
		 &$listaFotosComponente);
		 
	/**
	 * Introduce una foto de un componente
	 * @param $idComponente Id del componente
	 * @param $fotoComponente FotoC a introducidr
	 * @author Miguel Callon
	 */
	public function altaFotoComponente($idComponente, FotoComponenteBean $fotoComponente);
}
?>