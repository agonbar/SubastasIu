<?php
//namespace controlador;

/**
 * Clase controladora utilizada para mostrar una imagen
 * @author Miguel Callon
 */
class MostrarImagenControlador extends PublicoControlador {
	public function __construct() {
		
	}
	
	/**
	 * Ejecuta las acciones del controlador.
	 */
	protected function ejecutar($accion) {
		switch($accion) {
			case "mostrar":
				$path = UPLOAD_FOTOS.$_REQUEST["path"];
				//echo $path;
				
				if (!Ficheros::existeDirectorio($path)) {
					$imagen = imagecreatefrompng(RUTA_IMAGEN_DEFAULT);
						
					if ($imagen) {
						//echo "hay imagen";
						header('Content-Type: image/png');
						
						//echo "$imagen";
						//Enviamos la imagen al navegador
						imagepng($imagen);
						//Destruimos la imagen
						imagedestroy($imagen);
					}
				} else {
				
					$extension = Ficheros::getExtension($path);
					
					if ($extension == "jpg" || $extension == "jpeg") {
						$imagen = imagecreatefromjpeg($path);
						
						if ($imagen) {
							//Enviamos la cabecera Content-Type
							header('Content-Type: image/jpeg');
							//Enviamos la imagen al navegador
							imagejpeg($imagen);
							//Destruimos la imagen
							imagedestroy($imagen);
						}
					} elseif ($extension == "png") {
						//Enviamos la cabecera Content-Type					
						$imagen = imagecreatefrompng($path);
						
						if ($imagen) {
							//echo "hay imagen";
							header('Content-Type: image/png');
							
							//echo "$imagen";
							//Enviamos la imagen al navegador
							imagepng($imagen);
							//Destruimos la imagen
							imagedestroy($imagen);
						} 
					} elseif ($extension == "gif") {
						$imagen = imagecreatefromgif($path);
						
						if ($imagen) {
							//Enviamos la cabecera Content-Type
							header('Content-Type: image/gif');
							//Enviamos la imagen al navegador
							imagegif($imagen);
							//Destruimos la imagen
							imagedestroy($imagen);
						}
					}
				}
				break;
			default:
				echo "accionNoEncontrada";
				break;
		}
	}
}
?>