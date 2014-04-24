<?php
/**
 * Pagina mostrada al consultar el carrito
 * @author Hector Riopedre
 */
	
	
include HTML_PRIVADA_PATH . "/cabecera.php";
?>

<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("inicio.ver_carrito"); ?></li>
    </ul>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("inicio.ver_carrito"); ?></h2>
    </div>
		  
	<?php
	// Sacamos de nuevo el carrito de session
	$carritoBean = Session::get("CARRITO_BEAN_KEY");
	
	//Listamos su contenido
	$lineasPedido = $carritoBean->getListaComponentes();
	$numC= $carritoBean->getNumComponentes();
	$number = 0;
	foreach ($lineasPedido as $lineaPedido) {
	$number++;
	?>
	
	<div class="box_text_content">
		<img width="100" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo $lineaPedido->getComponente()->getFotoPrincipal()->getRuta() ?>" alt="<?php echo $lineaPedido->getComponente()->getNombre() ?>" title="<?php echo $lineaPedido->getComponente()->getNombre() ?>" class="box_icon">
	  	<div class="box_text_listar_car">
			<a href="index.php?controlador=ConsultarComponenteControlador&accion=consultarComponente&idComponente=<?php echo $lineaPedido->getComponente()->getIdComponente() ?>" class="details" ><?php echo $lineaPedido->getComponente()->getNombre(); ?></a><br/>
			<?php echo $lineaPedido->getComponente()->getUsuarioVendedor()->getUsuario() ?><br/><br/>
			<?php echo $lineaPedido->getComponente()	->getDescripcionBreve(); ?><br/>
		</div>
		<div class="box_text_listar_car">
			<?php MultiIdioma::gettexto("carrito.uds"); ?>: <?php echo $lineaPedido->getUnidades() ?><br/><br/>
		</div>
		<div class="box_text_listar_car">
			<?php MultiIdioma::gettexto("carrito.precio"); ?>: <?php echo $lineaPedido->getPrecioUnidad() ?> &euro;<br/><br/>
		</div>
		<div class="box_text_listar_car ult_campo">
			<?php MultiIdioma::gettexto("consultarPedido.total_linea"); ?>: <?php echo $lineaPedido->getTotalLinea() ?> &euro;<br/><br/>
			<div class="right">
				<a href="index.php?controlador=EliminarDeCarritoControlador&accion=eliminar&idComp=<?php echo $lineaPedido->getComponente()->getIdComponente(); ?>" class="details">- <?php MultiIdioma::gettexto('carrito.eliminar'); ?></a>
			</div>
		</div>
	</div>
	<div class="box_text_content">
		<div class="linea"><hr/></div>
	</div>	
	<?php
		}
	?>	
	<div class="box_text_content">
        <div class="box_text_ancho ult_campo">
       		<div class="right">
       			<a href="./index.php?controlador=RealizarPagoControlador&accion=mostrarFormularioPagoCarrito" ><input type="button" value="Comprar" /></a>
       			<a href="./index.php?controlador=ListarComponentesControlador&accion=listarComponentes" ><input type="button" value="<?php MultiIdioma::gettexto('comun.volver') ?>" /></a>
       		</div>
        </div>
   </div>
</div>
	
<?php
include HTML_PRIVADA_PATH . "/pie.php";
?>