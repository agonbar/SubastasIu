<?php
	//Definimos la ruta base
	define( 'PATH', dirname( __FILE__) );
	include "comun/constantes.php";
	include "comun/autoload.php";
	include "comun/Session.php";
	include "comun/MultiIdioma.php";
	
	// Seleccionamos el local a espanhol
	Session::iniciarSesion();
	$locale = Session::get(LOCALE_KEY);
	if ($locale == "") {
		$locale = LOCALE_DEFAULT;
		Session::set(LOCALE_KEY, $locale);
	}
	MultiIdioma::init_i18n(Session::get(LOCALE_KEY));
	
	// DISPATCHER
	// Instanciamos nuestro controlador
	$nombreControlador = $_REQUEST["controlador"];
	$nombreMetodo = $_REQUEST["accion"];
	
	// Verificamos si existe el controlador y el metodo y si no mostramos la pagina de error
	if ($nombreControlador == "" || $nombreMetodo == "") {
		$isValidado = Session::get(IS_AUTENTICADO_KEY);
		$isAdmin = Session::get(IS_ADMIN_KEY);
		if (isset($isValidado) && $isValidado == true 
			&& isset($isAdmin) && $isAdmin == true) {
			//include(HTML_ADMIN_PATH."/inicio.php");
			header('Location: index.php?controlador=InicioAdminControlador&accion=mostrar');
		} elseif (isset($isValidado) && $isValidado == true) {
			//include(HTML_PRIVADA_PATH."/inicio.php");
			header('Location: index.php?controlador=InicioPrivadoControlador&accion=mostrar');
		} else {
			//include(HTML_PUBLICA_PATH."/inicio.php");
			header('Location: index.php?controlador=InicioControlador&accion=mostrar');
		}
	} else {
		//echo "accion, metodo";
		//echo "$nombreControlador, $nombreMetodo";
		$clase = new $nombreControlador();
		// Ejecutamos su accion
		$clase->accion($nombreMetodo);
		//echo "Fin";
	}
?>