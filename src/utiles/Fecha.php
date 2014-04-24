<?php
/**
 * Clase utilidad para manejar las fechas.
 * @author Miguel Callon
 */
class Fecha {
	/**
	 * Convierte la fecha de HTML en la fecha que puede
	 * almacenar el MYSQL
	 * @param $fecha Fecha sin formatear
	 * @return $fechaFormaeada Fecha formateada
	 * @author Miguel Callon
	 */
	public static function formateaHtml2SQL($fecha) {
		$fechaFormateada = $fecha;
		if ($fecha != "") {
			$fechaFormateada = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $fecha)));
		}
		return $fechaFormateada;
	}
	
	/**
	 * Devuelve solo la hora de una fecha
	 * @param $fecha Fecha sin formatear
	 * @return $fechaFormaeada Fecha formateada
	 * @author Miguel Callon
	 */
	public static function formateaSQL2Html($fechaSql) {
		$fechaFormateada = $fechaSql;
		if ($fechaSql != "") {
			$phpdate = new DateTime( $fechaSql );
			$fechaFormateada = $phpdate->format ('d/m/Y H:i') ;
		}
		return $fechaFormateada;
	}
	
	/**
	 * Devuelve solo el dia/mes/anho de una fecha
	 * @return $fechaFormaeada Fecha
	 * @author Miguel Callon
	 */
	public static function getFecha($fecha) {
		$fechaFormateada = split(" ",$fecha);
		return $fechaFormateada[0];
	}
	
	/**
	 * Devuelve solo el dia/mes/anho de una fecha
	 * @return $fechaFormaeada Fecha
	 * @author Miguel Callon
	 */
	public static function getHora($fecha) {
		$horaFormateada = split(" ",$fecha);
		return $horaFormateada[1];
	}
}
?>