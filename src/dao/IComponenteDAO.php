<?php
/**
 * Interfaz que define los metodos que realizaran
 * consultas sobre la base de datos relacionados con componentes.
 * @author Nuria Canle
 */
interface IComponenteDAO extends IDAO {
	/**
	 * Lista los componentes de la base de datos
	 * @param $busqueda Busqueda de componentes
	 * @param &$listaComponentes coleccion de componentes.
	 * @param $paginadoBean informacion de paginado.
	 * @author Nuria Canle
	 */
	public function listarComponentes(BusquedaComponentesBean $busqueda,
				 &$listaComponentes, $paginadoBean);
	
	/**
	 * Metodo que obtiene un componente de la base de datos pasandole un ComponenteBean 
 	 * con el id del componente que se quiere consultar.
	 * @param $idComponente identificador del componente a consultar
	 * @param $compBean PedidoBean con los datos del pedido
	 * @author Nuria Canle
	 */
	public function consultarComponente($idComponente, ComponenteBean $compBean);
	
	/**
	 * Modifica un componente
	 * @param $idComponente id del componente a modificar
	 * @param $componente Componente a modificar
	 * @author Miguel Callon
	 */
	public function modificarComponente($idComponente, ComponenteBean $componente);
	
	/**
	 * Metodo que crea un componente con los datos del componente
	 * @param $componente datos del componente
	 * @author Almudena Novoa
	 */
	public function altaComponente(ComponenteBean $componente); 
	
	/**
	 * Metodo que elimina un componente de la base de datos pasandole un idcomponente
	 * @param $idComponente identificador del componente a dar de baja
	 * @author Adrian Gonzalez
	 */
	public function bajaComponente($idcomponente);
	
}
?>