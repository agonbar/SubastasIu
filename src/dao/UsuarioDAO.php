<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL
 * de la entidad Usuario
 * @author Miguel Callon
 */
class UsuarioDAO extends MysqlDAO implements IUsuarioDAO {
	/**
	 * Metodo que da de alta un usuario en base de datos
	 * @param $idUsuario Identificador del usuario
	 * @author Miguel Callon
	 */
	public function registrarUsuario(UsuarioBean $usuarioBean) {
		$sql = "insert into Usuario (idEstadoUsuario, 
					nombre, apellidos, direccion, localidad, provincia,
				    codigoPostal, dni, email, fechaNacimiento, usuario,
				    clave, cuentaPayPal, isAdmin) VALUES 
				    ('" . $usuarioBean -> getIdEstadoUsuario() . "',
				     '" . $usuarioBean -> getNombre() . "', '" . $usuarioBean -> getApellidos() . "',
				     '" . $usuarioBean -> getDireccion() . "', 
				     '" . $usuarioBean -> getLocalidad() . "', '" . $usuarioBean -> getProvincia() . "',
				     '" . $usuarioBean -> getCP() . "', '" . $usuarioBean -> getDni() . "', 
				     '" . $usuarioBean -> getEmail() . "', '" . $usuarioBean -> getFechaNacimiento() . "',
				     '" . $usuarioBean -> getUsuario() . "', '" . $usuarioBean -> getClave() . "',
				     '" . $usuarioBean -> getCuentaPayPal() . "', '" . $usuarioBean -> getIsAdmin() . "')";
		//echo $sql;
		try {
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch (Exception $ex) {
			throw new CrearUserDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que obtiene un Usuario de base de datos pasandole
	 * un UsuarioBean con el idUsuario.
	 * @param $usuarioBean contiene Identificador del usuario
	 * @author Miguel Callon, Adrian Gonzalez
	 */
	public function consultarDatosUsuario($idUsuario, UsuarioBean $usuarioBean) {
		if (!isset($idUsuario)) {
			throw new ConsultarDatosUsuarioDAOEx("Id usuario no especificado");
		}
		$sql = " select * from Usuario u where u.idUsuario = " . $idUsuario;
		
		try {
			$cursor = mysql_query($sql);
			$fila = mysql_fetch_assoc($cursor);
		
			if (mysql_num_rows($cursor) > 0) {
				$this -> fila2UsuarioBean($fila, $usuarioBean);
				$estadoUsuarioDAO = new EstadoUsuarioDAO();
				$estadoUsuarioBean = new EstadoUsuarioBean();
				$estadoUsuarioDAO -> consultarEstadoUsuario($usuarioBean -> getIdEstadoUsuario(), $estadoUsuarioBean);
				$usuarioBean -> setEstadoUsuario($estadoUsuarioBean);
			}
		} catch (Exception $ex) {
			throw new ConsultarDatosUsuarioDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que comprueba si un usuario puede accceder a la aplicacion haciendo Login.
	 * @param $user Identificador del usuario("Login")
	 * @param $password contraseña del usuario en la aplicacion
	 * @param $usuarioBean objeto Bean con los datos del usuario
	 * @author Nuria Canle
	 */
	public function verificarLogin($user, $password, UsuarioBean &$usuarioBean) {
		//comprobamos si existe en la BASE DE DATOS
		$sql = "select * from Usuario where usuario = '" . $user . "'
	    		and clave='" . $password . "'";
		//echo $sql;
		try {
			$resultado = mysql_query($sql);

			if (mysql_num_rows($resultado) == 1) {
				// si existe en la bd comprobamos si coincide la password
				$res = mysql_fetch_assoc($resultado);
				$this -> fila2UsuarioBean($res, $usuarioBean);
			} else {
				throw new ClaveIncorrectaDAOEx("El usuario no existe");
			}
		} catch (Exception $ex) {
			throw new ClaveIncorrectaDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que convierte un registro de usuario de base de datos
	 * en una objeto Bean.
	 * @param $fila una tupla de Usuario de base de datos.
	 * @param $usuarioBean un objeto de tipo usuario.
	 * @author Miguel Callon
	 */
	public function fila2UsuarioBean($fila, UsuarioBean $usuarioBean) {
		$usuarioBean -> setIdUsuario($fila["idUsuario"]);
		$usuarioBean -> setIdEstadoUsuario($fila["idEstadoUsuario"]);
		$usuarioBean -> setNombre($fila["nombre"]);
		$usuarioBean -> setApellidos($fila["apellidos"]);
		$usuarioBean -> setDireccion($fila["direccion"]);
		$usuarioBean -> setDni($fila["dni"]);
		$usuarioBean -> setFechaNacimiento($fila["fechaNacimiento"]);
		$usuarioBean -> setEmail($fila["email"]);
		$usuarioBean -> setUsuario($fila["usuario"]);
		$usuarioBean -> setLocalidad($fila["localidad"]);
		$usuarioBean -> setProvincia($fila["provincia"]);
		$usuarioBean -> setCuentaPayPal($fila["cuentaPayPal"]);
		$usuarioBean -> setClave($fila["clave"]);
		$usuarioBean -> setCuentaPayPal($fila["cuentaPayPal"]);
		$usuarioBean -> setIsAdmin($fila["isAdmin"]);
	}

	/**
	 * Metodo que modifica datos del usuario
	 * @param $usuario usuario a modificar
	 * @author Adrian Gonzalez
	 */
	public function modificarDatos($usuario) {
		if (!isset($idUsuario)) {
			throw new DatUserDAOEx("Id Usuario no especificado");
		}

		$sql = "update Usuario SET 	
	   				idEstadoUsuario='" . $usuario -> getIdEstadoUsuario() . "',
	   				nombre='" . $usuario -> getNombre() . "',
	   				apellidos=" . $usuario -> getApellidos() . "',
	   				direccion='" . $usuario -> getDireccion() . "',
	   				localidad='" . $usuario -> getLocalidad() . "',
	   				provincia='" . $usuario -> getProvincia() . "',
	   				cp='" . $usuario -> getCP() . "',
	   				dni='" . $usuario -> getDni() . "',
	   				email='" . $usuario -> getEmail() . "',
	   				fechaNacimiento'" . $usuario -> getFechaNacimiento() . "',
	   				cuentaPaypal='" . $usuario -> getCuentaPayPal() . "',
	   				isAdmin='" . $usuario -> getIsAdmin() . "'
	   	 		WHERE idUsuario=" . $usuario -> getIdUsuario();

		try {

			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());

		} catch(Exception $ex) {

			throw new DatUserDAOEx($ex -> getMessage());
		}

	}

	/**
	 * Metodo que modifica contrasena del usuario
	 * @param $usuario usuario a modificar
	 * @author Adrian Gonzalez
	 */
	public function modificarContrasena($idUsuario, $claveNueva) {
		if (!isset($idUsuario)) {
			throw new DatUserDAOEx("Id Usuario no especificado");
		}

		$sql = "update Usuario set clave='" . $claveNueva . "' where idUsuario=" . $idUsuario;
		echo $sql;
		try {
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch (Exception $ex) {
			throw new datPassDAOEx($ex -> getMessage());
		}

	}

	/**
	 * Metodo que modifica datos del usuario
	 * @param $usuario usuario a modificar
	 * @author Adrian Gonzalez
	 */
	public function modificarUsuario($usuario) {
		if (!isset($idUsuario)) {
			throw new DatUserDAOEx("Id Usuario no especificado");
		}
		$sql = "update Usuario SET 	
	   				idEstadoUsuario='" . $usuario -> getIdEstadoUsuario() . "',
	   				nombre='" . $usuario -> getNombre() . "',
	   				apellidos=" . $usuario -> getApellidos() . "',
	   				direccion='" . $usuario -> getDireccion() . "',
	   				localidad='" . $usuario -> getLocalidad() . "',
	   				provincia='" . $usuario -> getProvincia() . "',
	   				cp='" . $usuario -> getCP() . "',
	   				dni='" . $usuario -> getDni() . "',
	   				email='" . $usuario -> getEmail() . "',
	   				fechaNacimiento'" . $usuario -> getFechaNacimiento() . "',
	   				cuentaPaypal='" . $usuario -> getCuentaPayPal() . "',
	   				isAdmin='" . $usuario -> getIsAdmin() . "'
	   	 		WHERE idUsuario=" . $usuario -> getIdUsuario();
		try {
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch (Exception $ex) {
			throw new modificarUsuarioDAOEx($ex -> getMessage());
		}

	}

	/**
	 * Metodo que cambia de estado al usuario para darlo de baja
	 * @param $idUsuario ID del usuario que se va a dar de baja
	 * @author Santiago Iglesias
	 */
	public function darBajaUsuario($idUsuario) {

		if (!isset($idUsuario)) {
			throw new DatUserDAOEx("Id Usuario no especificado");
		}
		$sql = "update Usuario set idEstadoUsuario= '" . ESTADO_USUARIO_BAJA . "' 
				where idUsuario =" . $idUsuario;
		try {
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch(Exception $ex) {
			throw new DatUserDAOEx($ex -> getMessage());
		}

	}

	/**
	 * Lista los usuarios de la base de datos
	 * @param $busquedaUsuariosBean Objeto con la informacion de busqueda
	 * @param &$listaUsuarios coleccion de subastas.
	 * @param $paginadoBean informacion de paginado.
	 * @author Nuria Canle
	 */
	public function listarUsuarios(BusquedaUsuariosBean $busquedaUsuariosBean, &$listaUsuarios, PaginadoBean $paginadoBean) {

		$filtro = "idUsuario like '%" . $busquedaUsuariosBean -> getIdUsuario() . "%'". 
			 "and nombre like '%" . $busquedaUsuariosBean -> getNombre() . "%'". 
			 "and apellidos like '%" . $busquedaUsuariosBean -> getApellidos() ."%'".
			 "and dni like '%" . $busquedaUsuariosBean -> getDni() ."%'". 
			 "and email like '%" . $busquedaUsuariosBean -> getEmail() . "%'".
			 "and usuario like '%" . $busquedaUsuariosBean -> getUsuario() ."%'". 
			 "and isAdmin like '%" . $busquedaUsuariosBean -> getIsAdmin() ."%'";
			 
			 

		// Necesitamos consultar el total de registros para el paginado
		$sql = "select count(*) as total from Usuario where $filtro";
		
		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarUsuariosDAOEx(mysql_error());
			}
			$fila = mysql_fetch_assoc($cursor);

			// Ahora obtenemos el numero de elementos del cursor
			// y lo ponemos el paginadoBean
			$paginadoBean -> setNumElemTotal($fila["total"]);
		} catch (Exception $ex) {
			throw new ListarUsuariosDAOEx($ex -> getMessage());
		}

		// Consulta mysql. Ojo con el limit
		$sql = "select * from Usuario where $filtro
			limit " . $paginadoBean -> getInicioPagSQL() . "," . $paginadoBean -> getNumElemPag();

		try {
			// Ahora obtenemos la consulta sql
			$cursor = mysql_query($sql);
			if (!$cursor) {
				throw new ListarUsuariosDAOEx(mysql_error());
			}

			// Ahora recorremos el array y vamos guardando cada fila en
			// un objeto usuarioBean.
			while ($fila = mysql_fetch_assoc($cursor)) {
				$usuarioBean = new UsuarioBean();
				$this -> fila2UsuarioBean($fila, $usuarioBean);
				$listaUsuarios[count($listaUsuarios)] = $usuarioBean;
			}
		} catch (Exception $ex) {
			throw new ListarUsuariosDAOEx($ex -> getMessage());
		}

	}

	/**
	 * Metodo que modifica el usuario para ser administrador
	 * @param $usuario usuario a modificar
	 * @author Adrian Gonzalez
	 */
	public function crearUsuarioPrivilegiado($usuario) {
		if (!isset($idUsuario)) {
			throw new usuarioPrivilegiadoDAOEx("Id Usuario no especificado");
		}
		$sql = "update Usuario set isAdmin='" . $usuario -> getIsAdmin() . "' where idUsuario=" . $usuario -> getIdUsuario();
		try {
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch(Exception $ex) {

			throw new usuarioPrivilegiadoDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Metodo que recupera contrasena del usuario
	 * @param $usuario usuario a modificar
	 * @author Adrian Gonzalez
	 */
	public function recuperarContrasena($usuario) {
		if (!isset($idUsuario)) {
			throw new DatUserDAOEx("Id Usuario no especificado");
		}
		$sql = "select from Usuario clave where idUsuario=" . $usuario -> getIdUsuario();
		try {
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch(Exception $ex) {
			throw new datPassDAOEx($ex -> getMessage());
		}
	}
	
	/**
	 * Metodo que modifica el usuario para ser administrador
	 * @param $usuario usuario a modificar
	 * @author Adrian Gonzalez
	 */
	public function eliminarUsuario($usuario) {
		if (!isset($idUsuario)) {
			throw new eliminarUsuarioDAOEx("Id Usuario no especificado");
		}
		$sql = "DELETE FROM Usuario WHERE idUsuario=" . $usuario -> getIdUsuario();
		try {
			mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
		} catch(Exception $ex) {

			throw new eliminarUsuarioDAOEx($ex -> getMessage());
		}
	}

}
?>