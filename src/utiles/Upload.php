<?php
/**
 * Clase utilidad para manejar los ficheros.
 * @author Miguel Callon
 */
class Upload {
	/**
	 * Comprueba si existe un fichero o directorio
	 * @return true en caso que el fichero o directorio exista
	 * @author Miguel Callon
	 */
	public static function subirFichero($nomParam, $nombreFichero, $uploadDir) {
		// Le concatenamos la ruta del sistema
		$uploadDir = UPLOAD_FOTOS.$uploadDir;
		// Creamos el directorio de la subasta
		if (!Ficheros::existeDirectorio($uploadDir)) {
			Ficheros::crearDirectorio($uploadDir);
			Ficheros::persmisosEscritura($uploadDir);
		}
		
		/*if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {
		 	echo "El fichero esta subido";
		} else {
			echo "no esta subido";
		}*/
		
		// Subimos la foto de la subasta
		$uploadFile = $uploadDir. $nombreFichero;
		return move_uploaded_file($_FILES[$nomParam]['tmp_name'], $uploadFile);
	}
}
?>