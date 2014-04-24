<?php
/**
 * Clase que comprueba el caso de uso crearSubasta
 * @author Miguel Callon
 */
 	define( 'PATH', dirname( __FILE__) );
	include "comun/constantes.php";
 	require "comun/autoload.php";
	
	// Primero conecto contra la BD
	$conexion = new MysqlDAO();
	$conexion->connectarBD();
	
	$directorio=opendir(TEST_PATH); 
	while ($archivo = readdir($directorio)) {
		$conexion->abrirTransaccion();
		if (preg_match('#^(Test.*)\.php#s', $archivo, $matches)) {
			$clasePrueba = new $matches[1]();
			echo "<b>Clase: $matches[1]</b><br/>";
			$metodos = get_class_methods($clasePrueba);
			foreach ($metodos as $metodo) {
				if (preg_match('#^test.*#s', $metodo)) {
					$noHayError = true;
					echo "<br>metodo: $metodo";
					try {
						$noHayError = $clasePrueba->$metodo();
					} catch (Exception $ex) {
						$noHayError = false;
					}
					if (!$noHayError) {
						echo "&nbsp;<span style='color:red' >ERROR</span> ";
					} else {
						echo "&nbsp;<span style='color:green'>OK</span>";
					}
					echo "</br>";
				}
			}
		}
		
		$conexion->rollback();
	}
	$conexion->desconectarBD();
	closedir($directorio); 
?>