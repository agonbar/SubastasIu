<?php
/**
 * Clase utilidad para arrancar monitores de procesos
 * @author Miguel Callon
 */
class Procesos {
	public static function crearMonitorSubasta($idSubasta) {
		$crontab = new CrontabManager();
		
		$rutaScript = PATH."/plugin/procesos/subastas/monitorSubasta.php";
		

		$newCronjobs = array('30 8 * * 6 $rutaScript >/dev/null 2>&1'
		);

		$crontab->appendCronjob($newCronjobs);
	}
	
}
?>