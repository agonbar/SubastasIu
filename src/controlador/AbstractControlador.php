<?php
/**
 * Clase que almacena los metodos comunes de los controladores.
 * @author Miguel Callon
 */
abstract class AbstractControlador {
	/**
	 * Esta funcion aseguro que el usuario que va a 
	 */
	protected function isAutenticadoPrivado() {
		$isAutenticado = Session::get(IS_AUTENTICADO_KEY);

		if (!isset($isAutenticado) || $isAutenticado != true) {
			header('Location: ./index.php');
		}
	}
	
	protected function isAutenticadoAdmin() {
		$isAutenticado = Session::get(IS_AUTENTICADO_KEY);
		$isAdmin = Session::get(IS_ADMIN_KEY);
		if (!isset($isAutenticado) || $isAutenticado != true
			|| !isset($isAdmin) || $isAdmin != true) {
			header('Location: ./index.php');
		}
	}
	
	/**
	 * Comprobar el estado de las subastas
	 * @author Miguel Callon
	 */
	public function comprobarSubastas() {
		// Obtiene la factoria publica
		$fachada = FactoriaFachada::getPublicaFachada();
		$fachada->comprobarSubastas();
	}
	
	abstract protected function ejecutar($accion);
	abstract protected function accion($accion);
}
?>