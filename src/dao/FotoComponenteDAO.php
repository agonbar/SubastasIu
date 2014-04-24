<?php
/**
 * Clase que implementa los metodos de base de datos contra MySQL.
 * @author Miguel Callon
 */
class FotoComponenteDAO extends MysqlDAO implements IFotoComponenteDAO {
	/**
	 * Lista las fotos de los componentes de la base de datos
	 * @param $idComponente Busqueda de fotos de componentes
	 * @param &$listaFotosComponente coleccion de fotos de un componentes.
	 * @author Miguel Callon
	 */
	public function listarFotosComponente($idComponente,
		 &$listaFotosComponente) {
		// Consulta mysql. Ojo con el limit
		$sql = "select * from FotoComponente c where idCompFoto = $idComponente";
		//echo $sql;
		try {
			// Ahora obtenemos la consulta sql de nuevo
			$consulta = mysql_query($sql);

			// Ahora recorremos el array y vamos guardando
			// cada fila obtenida de la consulta sql en
			// un objeto FotoComponenteBean.
			while ($fila = mysql_fetch_assoc($consulta)) {
				$fotoComponenteBean = new FotoComponenteBean();
				$this -> fila2FotoComponenteBean($fila, $fotoComponenteBean);
				$listaFotosComponente[count($listaFotosComponente)] = $fotoComponenteBean;
			}
		} catch (Exception $ex) {
			throw new ListarComponentesDAOEx($ex -> getMessage());
		}
	}

	/**
	 * Convierte una fila de base de datos
	 * @param $fila Tupla de base de datos
	 * @param $componente Objeto de tipo ComponenteBean
	 * @author Miguel Callon
	 */
	public function fila2FotoComponenteBean($fila, FotoComponenteBean &$fotoComponente) {
		$fotoComponente -> setIdFotoComp($fila["idFotoComp"]);
		$fotoComponente -> setIdCompFoto($fila["idCompFoto"]);
		$fotoComponente -> setTituloFoto($fila["tituloFoto"]);
		$fotoComponente -> setDescripcionFoto($fila["descripcionFoto"]);
		$fotoComponente -> setRuta($fila["ruta"]);
		$fotoComponente -> setIsPrincipal($fila["isPrincipal"]);
	}
	
	/**
	 * Introduce una foto de un componente
	 * @param $idComponente Id del componente
	 * @param $fotoComponente FotoC a introducidr
	 * @author Miguel Callon
	 */
	public function altaFotoComponente($idComponente,
			 FotoComponenteBean $fotoComponente) {
		$sql = " insert into FotoComponente (idCompFoto, tituloFoto,
				 descripcionFoto, ruta, isPrincipal)
			 values ('". $idComponente . "',
			 '" . $fotoComponente -> getTituloFoto() . "',
			 '" . $fotoComponente -> getDescripcionFoto(). "',
			 '" . $fotoComponente -> getRuta() . "',
			 '" . $fotoComponente -> getIsPrincipal() . "');";
		//echo $sql;
		try {
			mysql_query($sql);
		} catch (Exception $ex) {
			throw new AltaFotoComponenteDAOEx($ex -> getMessage());
		}
	}
			 
	/**
	 * Actualiza la foto de un componente
	 * @param $idComponente Id del componente
	 * @param $fotoComponente FotoC a introducidr
	 * @author Miguel Callon
	 */
	public function modificarFotoComponente($idComponente,
			 FotoComponenteBean $fotoComponente) {
		$sql = " update FotoComponente
			 set idCompFoto = '". $fotoComponente->getIdCompFoto() . "',
			 tituloFoto = '" . $fotoComponente -> getTituloFoto() . "',
			 descripcionFoto = '" . $fotoComponente -> getDescripcionFoto(). "',
			 ruta = '" . $fotoComponente -> getRuta() . "',
			 isPrincipal = '" . $fotoComponente -> getIsPrincipal() . "'
			 where idFotoComp = ". $fotoComponente->getIdFotoComp().";";
		//echo $sql;
		try {
			mysql_query($sql);
		} catch (Exception $ex) {
			throw new AltaFotoComponenteDAOEx($ex -> getMessage());
		}
	}
}
?>