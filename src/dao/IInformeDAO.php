<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionado con la entidad
 * correspondiente.
 * @author Nuria Canle
 */
interface IInformeDAO extends IDAO {
	/**
	 * Lista los informes de la base de datos
	 * @param $busquedaInformesBean Objeto con la informacion de busqueda
	 * @param &$listaInformes coleccion de informes.
	 * @param $paginadoBean informacion de paginado.
	 * @author Nuria Canle
	 */
	public function listarInformes(BusquedaInformesBean $busquedaInformesBean,
								   &$listaInformes, PaginadoBean $paginadoBean);
	
	/**
	 * Metodo que convierte un informe de base de datos
	 * en una objeto InformeBean.
	 * @param $fila una tupla de base de datos.
	 * @param $InformeBean un objeto InformeBean
 	 * @author Nuria Canle
	 */
	private function fila2InformeBean ($fila, InformeBean $informeBean);
	
	/**
	 * Modifica el detalle de un informe
	 * @fecha fecha del informe a modificar
	 * @informe Objeto informe con los datos a modificar
	 * @author Nuria Canle
	 */
	public function modificarInforme($fecha, InformeBean $informe);
	}
?>