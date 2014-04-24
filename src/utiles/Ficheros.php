<?php
/**
 * Clase utilidad para manejar los ficheros.
 * @author Miguel Callon
 */
class Ficheros {
	/**
	 * Comprueba si existe un fichero o directorio
	 * @return true en caso que el fichero o directorio exista
	 * @author Miguel Callon
	 */
	public static function existeDirectorio($ruta) {
		return file_exists($ruta);
	}
	/**
	 * Crea un directorio
	 * @return true en caso que se pueda crear el directorio
	 * @author Miguel Callon
	 */
	public static function crearDirectorio($estructura) {
		if(!mkdir($estructura, 0, true))
		{
		    return false;
		}
		return true;
	}
	
	/**
	 * Dar permisos
	 * @param $directorio
	 * @author Miguel Callon
	 */
	public static function persmisosEscritura($directorio) {
		echo $directorio;
		// Lectura y escritura para el propietario, nada para los demás
		chmod($directorio, 0777);
	}
	
	/**
	 * Obtener la extension de un fichero
	 * @param $nombreFichero Nombre de fichero
	 * @author Miguel Callon
	 */
	public static function getExtension($nombreFichero){
    	return substr(strrchr($nombreFichero, '.'), 1);
	}
}
?>