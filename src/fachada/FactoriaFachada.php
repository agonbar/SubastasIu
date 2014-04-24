<?php
/**
 * Clase que implementa los metodos de la factoria de fachadas.
 * @author Miguel Callon
 */
class FactoriaFachada implements IFactoriaFachada {
	private static $privadaFachada = null;
	private static $publicaFachada = null;
	private static $adminFachada = null;
	
	public static function getPrivadaFachada() {
		if (!isset(static::$privadaFachada)) {
			static::$privadaFachada = new PrivadaFachada();
		}
		return static::$privadaFachada;
	}
	public static function getPublicaFachada() {
		if (!isset(static::$publicaFachada)) {
			static::$publicaFachada = new PublicaFachada();
		}
		return static::$publicaFachada;
		
	}
	public static function getAdminFachada() {
		if (!isset(static::$adminFachada)) {
			static::$adminFachada = new AdminFachada();
		}
		return static::$adminFachada;
	}
}
?>