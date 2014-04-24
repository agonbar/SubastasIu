<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL.
 * @author Adrian Gonzalez
 */
class FacturaDAO extends MysqlDAO implements IFacturaDAO {

	/**
	 * Metodo que obtiene una subasta pasando un SubastaBean con el id de la subasta
	 * que se quiere consultar.
	 * @param $idSubasta identificador de la subasta a consultar
	 * @param $subastaBean SubastaBean con los datos de la subasta
	 * @param $paginadoBean PaginadoBean datos del paginado
	 * @author Miguel Callon
	 */
	public function consultarSubasta($idFactura, FacturaBean $facturaBean) {

		$sql = "a";
		echo $sql;
		try {

			//no tengo claro que hacer en esta parte
			
		} catch (Exception $ex) {
			throw new ConsultarFacturaDAOEx($ex -> getMessage());
		}
	}

}
?>