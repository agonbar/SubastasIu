<?php
/**
 * Script para monitorizar las subastas php
 * @author Miguel Callon
 */

include "../comun/constantes.php";
include "../comun/autoload.php";

/**
 * Comprueba si la subasta debe abrirse
 * @author Miguel Callon
 */
function checkApertura(SubastaBean $subastaBean)  {
	$fechaApertura = new DateTime($subastaBean->getFechaApertura());
	$fechaActual = new DateTime("now");
	if ($fechaActual < $fechaApertura) {
		// Actualizamos el estado de la subasta
	}
}	
/**
 * Comprueba si la subasta debe cerrarse
 * @author Miguel Callon
 */
function checkCerrada(SubastaBean $subastaBean) {
	$fechaCierre = new DateTime($subastaBean->getFechaCierre());
	$fechaActual = new DateTime("now");
	if ($fechaActual < $fechaCierre) {
		// Actualizamos el estado de la subasta
	}
}

// Conectamos contra base de datos
$mysqlDAO = new MysqlDAO();
$mysqlDAO->connectarBD();
$mysqlDAO->abrirTransaccion();
try {
	$subastaDAO = new SubastaDAO();
	$subastaBean = new SubastaBean();
	
	$pag = NUM_PAG_DEFAULT; // Pagina actual
	$max = NUM_ELEM_PAG_DEFAULT; // Num Elem por pagina
	$paginadoBean = new PaginadoBean($pag, null, $max, null);
	$subastaDAO->consultarSubasta($idSubasta, &$subastaBean, $paginadoBean);
	
	checkApertura($subastaBean);
	checkCerrada($subastaBean);
	
	$mysqlDAO->commit();
} catch (Exception $ex) {
	$mysqlDAO->rollback();
}
$mysqlDAO->rollback();

?>