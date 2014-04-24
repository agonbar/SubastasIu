<?php
/**
 * Interfaz que define los metodos de la factoria de fachadas.
 * @author Miguel Callon
 */
interface IFactoriaFachada {
	public static function getPrivadaFachada();
	public static function getPublicaFachada();
	public static function getAdminFachada();
}
?>