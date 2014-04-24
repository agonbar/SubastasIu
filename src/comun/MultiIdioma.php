<?php
/**
 * Clase utilizada para la gestion del multiidioma
 * @author Miguel Callon
 */
class MultiIdioma {
	/**
	 * Inicializa el multiidioma en la sesion, obteniendo el archivo multiidioma
	 * correspondiente a locale seleccionado
	 * @author Miguel Callon
	 */
	public static function init_i18n() {
		$locale = Session::get(LOCALE_KEY);
		$path_locale = PATH."/locale/".$locale."/LC_MESSAGES/messages.properties";
		//echo "path_locale: $path_locale";
		$array = parse_ini_file($path_locale, false, INI_SCANNER_RAW);
		foreach ($array as $index => $value) {
			$properties[$index] = $value;
		}
		Session::set(MULTIIDIOMA_KEY, $properties);
	}
	/**
	 * Devuelve un texto internacionalizado pasandole una clave
	 * y lo printa en pantalla
	 * @param $mensaje Clave del mensaje para internacionalizar
	 * @param $texto Texto multiidioma correspondiente a la clave
	 * @author Migel Callon
	 */
	public static function gettexto ($mensaje) {
		$multiIdioma = Session::get(MULTIIDIOMA_KEY);
		echo $multiIdioma[$mensaje]; 
	}
	/**
	 * Devuelve un texto internacionalizado pasandole una clave
	 * @param $mensaje Clave del mensaje para internacionalizar
	 * @param $texto Texto multiidioma correspondiente a la clave
	 * @author Migel Callon
	 */
	public static function gettextoSinEcho ($mensaje) {
		$multiIdioma = Session::get(MULTIIDIOMA_KEY);
		return $multiIdioma[$mensaje]; 
	}
}
?>