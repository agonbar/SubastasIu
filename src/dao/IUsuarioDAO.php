<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionado con la entidad
 * correspondiente.
 * @author Miguel Callon
 */
interface IUsuarioDAO extends IDAO {
	/**
	 * Metodo que obtiene un Usuario de base de datos pasandole
	 * un UsuarioBean con el idUsuario.
	 * @param $idUsuario Identificador del usuario
	 * @author Miguel Callon
	 */
	function consultarDatosUsuario($idUsuario, UsuarioBean $usuarioBean);
	
	/**
	 * Metodo que comprueba si un usuario puede accceder a la aplicacion haciendo Login.
	 * @param $user Identificador del usuario("Login")
	 * @param $password contraseña del usuario en la aplicacion
	 * @param $usuarioBean objeto Bean con los datos del usuario
	 * @author Nuria Canle
	 */
	function verificarLogin($user, $password, UsuarioBean &$usuarioBean);
	/**
	 * Metodo que convierte un registro de usuario de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de Usuario de base de datos.
	 * @param $usuarioBean un objeto de tipo usuario.
	 * @author Miguel Callon
	 */
	public function fila2UsuarioBean ($fila, UsuarioBean $usuarioBean);
	/**
	 * Metodo que da de alta un usuario en base de datos
	 * @param $idUsuario Identificador del usuario
	 * @author Miguel Callon
	 */
	public function registrarUsuario(UsuarioBean $usuarioBean);
	
	/**
	* Metodo que modifica datos del usuario
	* @param $usuario usuario a modificar
	* @author Adrian Gonzalez
	*/
	public function modificarDatos($usuario);
	
	/**
	 * Metodo que cambia de estado al usuario para darlo de baja
	 * @param $idUsuario ID del usuario que se va a dar de baja
	 * @author Santiago Iglesias
	 */
	public function darBajaUsuario($idUsuario);
	/**
	 * Lista los usuarios de la base de datos
	 * @param $busquedaUsuariosBean Objeto con la informacion de busqueda
	 * @param &$listaUsuarios coleccion de subastas.
	 * @param $paginadoBean informacion de paginado.
	 * @author Nuria Canle
	 */
	public function listarUsuarios(BusquedaUsuariosBean $busquedaUsuariosBean,
								   &$listaUsuarios, PaginadoBean $paginadoBean);
								   
	/**
	 * Metodo que modifica contrasena del usuario
	 * @param $usuario usuario a modificar
	 * @author Adrian Gonzalez
	 */
	public function modificarContrasena($idUsuario, $claveNueva);								   
	
}
?>