<?php
/**
 * Interfaz que define los metodos de la fachada de administrador.
 * @author Miguel Callon
 */
interface IAdminFachada extends IFachada {
	/**
	 * Metodo que devuelve una lista de subastas.
	 * @param $busquedaSubastasBean Objeto con los datos de la busqueda
	 * @param $listaSubastas vector con las subastas a mostrar.
	 * @param $paginadoBean objeto que permite mostrar el listado de forma paginada.
	 * @author Santiago Iglesias
	 */
	 function insertarFotosComponente(ComponenteBean $componenteBean);
	 
	function listarSubastas(BusquedaSubastasBean $busquedaSubastasBean, &$listaSubastas, PaginadoBean $paginadoBean);
	
	function listarPedidos(BusquedaPedidosBean $busquedaPedidosBean, &$listaPedidos, PaginadoBean $paginadoBean);
	
	function listarComponentes(BusquedaComponentesBean $busquedaComponentesBean, &$listaComponentes,PaginadoBean $paginadoBean);
	
	function modificarFotosComponente(ComponenteBean $componenteBean);
	
	
	function modificarComponente($idComponente, ComponenteBean $componente);
	
	/**
	 * Metodo que da de alta un nuevo componente
	 * @param $idComponente Identificador del componente
	 * @author Santiago Iglesias
	 */
	function altaComponente(ComponenteBean $componente);
		
	function bajaComponente($idComponente);
	
	/**
	 * Modifica un componente
	 * @param $idComponente id del componente a modifica
	 * @param $compBean objeto con los datos a mostrar
	 * @author Santiago Iglesias
	 */
	function consultarComponente($idComponente, ComponenteBean $compBean);
	
	/**
	 * Metodo que devuelve una lista de usuarios.
	 * @param $busquedaUsuariosBean Objeto con los datos de la busqueda
	 * @param $listaUsuarios vector con los usuarios a mostrar.
	 * @param $paginadoBean objeto que permite mostrar el listado de forma paginada.
	 * @author Nuria Canle
	 */
	function listarUsuarios(BusquedaUsuariosBean $busquedaUsuariosBean, &$listaUsuarios, PaginadoBean $paginadoBean);
	
	/** Metodo que devuelve una lista de informes.
	 * @param $busquedaInformesBean Objeto con los datos de la busqueda
	 * @param $listaInformes vector con los informes a mostrar.
	 * @param $paginadoBean objeto que permite mostrar el listado de forma paginada.
	 * @author Nuria Canle
	 */
	function listarInformes(BusquedaInformesBean $busquedaInformesBean, &$listaInformes, PaginadoBean $paginadoBean);
	
	/**
	 * Modifica el detalle de un informe
	 * @fecha Fecha del informe a modificar
	 * @informeBean Objeto informe con los datos a modificar
	 * @author Nuria Canle
	 */
	public function modificarInforme($fecha, InformeBean $informeBean);
}
?>