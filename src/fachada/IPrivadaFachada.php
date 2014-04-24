<?php
/**
 * Interfaz que define los metodos de la fachada privada.
 * @author Miguel Callon
 */
interface IPrivadaFachada extends IFachada {
	/**
	 * Metodo que realiza una puja en una subasta
	 * @param $idSubasta Id de la subasta donde se puja
	 * @param $puja Objeto con los datos de la puja
	 * @author Miguel Callon
	 */
	function pujar ($idSubasta, PujaBean $puja);
	/**
	 * Metodo que crea una subasta
	 * @param $subasta Datos de la subasta para crear
	 * @author Miguel Callon
	 */
	function crearSubasta(SubastaBean $subasta);
	/**
	 * Metodo que devuelve detalle de una subasta
	 * @param $idSubasta Identificador de la subasta
	 * @param $subastaBean SubastaBean con los datos de la subasta
	 * @param $paginadoBean parametros del paginado
	 * @author Miguel Callon
	 */
	function consultarSubasta($idSubasta, SubastaBean &$subastaBean, PaginadoBean $paginadoBean);
	/**
	 * Metodo que modifica la fecha de cierre de una subasta
	 * @param $idSubasta subasta a modificar
	 * @param $nuevaFechaCierre Datos de la subasta a modificar
	 * @param $idUsuCreador Id del usuario creador de la subasta
	 * @author Miguel Callon
	 */
	function modificarFinDeSubasta($idSubasta, $nuevaFechaCierre, $idUsuCreador);
	/**
	 * Metodo que crea una subasta
	 * @param $subasta Datos de la subasta para crear
	 * @author Miguel Callon
	 */
	function cancelarSubasta($idSubasta, $idUsuCreador);
	/**
	 * Modifica el detalle de una subasta
	 * @idSubasta Identificador de la subasta a modificar
	 * @subasta Objeto subasta con los datos a modificar
	 * @author Miguel Callon
	 */
	public function modificarSubasta($idSubasta, SubastaBean $subasta);
	/**
	 * Metodo que devuelve una lista de subastas.
	 * @param $busquedaSubastasBean Objeto con los datos de la busqueda
	 * @param $listaSubastas vector con las subastas a mostrar.
	 * @param $paginadoBean objeto que permite mostrar el listado de forma paginada.
	 * @author Santiago Iglesias
	 */
	function listarSubastas(BusquedaSubastasBean $busquedaSubastasBean,
						    &$listaSubastas, PaginadoBean $paginadoBean);
							
	/**
	 * Crear pedido
	 * @param $pedidoBean datos del pedido
	 * @author Miguel Callon
	 */
	public function crearPedido(PedidoBean $pedidoBean);
	
	/**
	 * Metodo que devuelve un pedido por el identificador del pedido.
	 * @param $idPedido Identificador del pedido
	 * @param $pedidoBean PedidoBean con los datos del pedido
	 * @author Santiago Iglesias
	 */
	function consultarPedido($idPedido, PedidoBean $pedidoBean);	//santi
	
	/**
	 * Realizar pago
	 * @param $idPedido Identificador del pedido
	 * @param $datosPago Datos de pago del pedido
	 * @author Miguel Callon
	 */
	function realizarPagoPedido($idPedido, DatosPagoBean $datosPago);

	/**
	 * Lista los pedidos del sistema pasandole los filtros en un objeto
	 * busqueda.
	 * @param $busquedaPedido Objeeto con los filtros de busqueda
	 * @param $listaPedidos Array que se pasa por referencia para obtener
	 * los objetos PedidoBean
	 * @param $paginado Objeto que se utilia para el paginado
	 */
	function listarPedidosEnviados(BusquedaPedidosBean $busquedaPedido,
						   &$listaPedidos, PaginadoBean $paginadoBean,$idUsuConectado);
						   
	/**
	 * Lista los pedidos del sistema pasandole los filtros en un objeto
	 * busqueda.
	 * @param $busquedaPedido Objeeto con los filtros de busqueda
	 * @param $listaPedidos Array que se pasa por referencia para obtener
	 * los objetos PedidoBean
	 * @param $paginado Objeto que se utilia para el paginado
	 */
	function listarPedidosRecibidos(BusquedaPedidosBean $busquedaPedido,
						   &$listaPedidos, PaginadoBean $paginadoBean,$idUsuConectado);
	/**
	 * Metodo que da de alta un componente
	 * @param $componente Datos del componente para dar de alta.
	 * @author Almudena Novoa
	 */
	function AltaComponente(ComponenteBean $componente);
	
	/**
	 * Metodo que modifica un componente
	 * @param $idComponente Id del componente
	 * @param $componente Datos del componente para modificar.
	 * @author Almudena Novoa
	 */
	function modificarComponente($idComponente, ComponenteBean $componente);
	
	/**
	 * Modifica los datos del usuario.
	 * @param $datos Objeto con datos del usuario para poder guardar en la BD 
	 * @author Adrián González
	 */
	function modificarDatos(UsuarioBean $datos);
	
	/**
	 * Lista los componentes del sistema.
	 * @param $busqueda Filtro de busqueda
	 * @param $listaComponente Lista de componentes
	 * @param $paginadoBean Objeto con los datos del paginado
	 * @author Nuria Canle
	 */
	function listarComponentes(BusquedaComponentesBean $busqueda, &$listaComponentes, PaginadoBean $paginadoBean);
	
	/**
	 * Metodo que devuelve los datos de un componente al pasarle su identificador.
	 * @param $idComponente Identificador del componente a consultar.
	 * @param $compBean ComponenteBean con los datos del componente.
	 * @author Nuria Canle
	 */
	function consultarComponente($idComponente, ComponenteBean $compBean);
	
	/**
	 * Insertar fotos del componente
	 * @param $componenteBean ComponenteBean con lista de fotos
	 * @author Miguel Callon
	 */
	function insertarFotosComponente(ComponenteBean $componenteBean);
	
	/**
	 * Metodo que devuelve los datos de un carrito.
	 * @param $carritoBean CarritoBean con los datos del Carrito.
	 * @author Hector Riopedre
	 */
	function consultarCarrito(CarritoBean $carritoBean);
	
	/**
	 * Metodo que anhade un componente al carrito.
	 * @param $lineaPedidoBean LideaPedidoBean con los datos del Carrito.
	 * @author Hector Riopedre
	 */
	function anhadirAlCarrito(LineaPedidoBean $lineaPedidoBean);
	
	/**
	 * Metodo que anhade datos un componente al carrito.
	 * @param $id ID del componente a eliminar.
	 * @author Hector Riopedre
	 */
	function eliminarDeCarrito($id);
	
	/**
	 * Metodo que da de baja a un usuario
	 * @idUsuario Identificador del usuario conectado que se va a dar de baja
	 * @author Santiago Iglesias
	 */
	function darBaja($idUsuario);
	
	/**
	 * Metodo para modificar contrasena de un usuario
	 * Valida previamente los campos y si todo esta correcto actualiza
	 * @param $claveNueva la nueva contrasena para el usuario
	 * @param $usuario Objeto con datos del usuario para poder guardar en la BD
	 * @author Adrian Gonzalez
	 */
	function modificarContrasena($idUsuario, DatosCambiarClaveBean $datosCambiarClave);
	
	/**
	 * Metodo que devuelve la informacion de una notificacion
	 * @param $idNotificacion Identificador de la notificacion a consultar.
	 * @param $notificacionBean NotificacionBean con los datos de la notificacion.
	 * @author Almudena Novoa 
	 */
	 function consultarNotificacion($idNotificacion, NotificacionBean $notificacionBean);
}