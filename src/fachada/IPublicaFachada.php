<?php
/**
 * Interfaz que define los metodos de la fachada publica.
 * @author Miguel Callon
 */
interface IPublicaFachada extends IFachada {
	/**
	 * Se utiliza para actualizar las subastas y cambiar su estado
	 * @author Miguel Callon
	 */
	function comprobarSubastas();
	
	function listarSubastas(&$listaSubastas); //santi
	
	/**
	 * Metodo que accede a la base de datos de usuarios mediante UsuarioDAO para consultar los datos de un usuario
	 * @param $login login del usuario que se quiere consultar
	 * @param $password password del usuario a buscar en la BD
	 * @param $usuarioBean objeto bean del usuario que se busca
	 * @author Nuria Canle
	 */
	function consultarDatosUsuario($login, $password, &$usuarioBean); 
	
	/**
	* Metodo que accede a la base de datos de componentes y proporciona una lista de ellos siguiendo un paginado
	* @param $listaComponentes coleccion de componentes
	* @author Nuria Canle
	*/
	function listarComponentes (&$listaComponentes);
	/**
	 * Registra a un usuario.
	 * @param $busqueda Filtro de busqueda
	 * @param $listaComponente Lista de componentes
	 * @param $paginadoBean Objeto con los datos del paginado
	 * @author Miguel Callon
	 */
	function registrarUsuario (UsuarioBean $usuarioBean);
}
?>