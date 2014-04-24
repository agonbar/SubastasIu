<?php
	/**
	 * Pagina de pedido consultado por un comprador cuando se
	 * encuentra en estado nuevo
	 * @author Miguel Callon
	 */
	include HTML_PRIVADA_PATH."/cabecera.php";
?>
<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><a class="submenu" href="index.php?controlador=ListarPedidosControlador&accion=listarPedidosEnviados" ><?php MultiIdioma::gettexto("menu.pedidos_enviados"); ?></a></li>
		 <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.consultar_detalle_pedido_puja_ganadora"); ?></li>
    </ul>
</div>

<style type="text/css">

#total{
	font-size: 20px;
	float: right;

}

label{
	font-size: 12px;

}

#otrosDatos{
	width: 260px;

}
#campo{
	float: right;
	
}

#botonI{
	float: left;
	
	
}
#botonD{
	float: right;
	

}
#botones{
	float:right;
	width: 200px;
}


</style>

<script type="text/javascript">
$(document).ready(function(){
	$("#otrosDatos").hide();
	$("#otros").click(function(){
		$("#datos").fadeOut(0);
		$("#otrosDatos").fadeIn();
	});
	$("#default").click(function(){
		$("#otrosDatos").fadeOut(0);
		$("#datos").fadeIn();
	});

});
</script>

<?php 
$usuarioComprador = $pedidoBean->getUsuarioComprador(); 
$usuarioVendedor = $pedidoBean->getUsuarioVendedor(); 

?>
<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <!--<h2><?php MultiIdioma::gettexto("inicio.pedidos") ?></h2>-->
        <h2><?php MultiIdioma::gettexto("realizarPago.titulo"); ?></h2>
    </div>
    
	<div class="box_text_content">
	  	<p><b><?php MultiIdioma::gettexto("consultarPedido.lineas_pedido") ?>:</b></p><br><br>

	  			<div class="box_text_lineas lista_head">
				<?php MultiIdioma::gettexto("consultarPedido.nombre") ?>
				</div>
				<div class="box_text_lineas lista_head">
				<?php MultiIdioma::gettexto("consultarPedido.vendedor") ?>
				</div>
				<div class="box_text_lineas lista_head">
				<?php MultiIdioma::gettexto("consultarPedido.unidades") ?>
				</div>
				<div class="box_text_lineas lista_head">
				<?php MultiIdioma::gettexto("consultarPedido.precio_unidad") ?>
				</div>
				<div class="box_text_lineas ult_campo lista_head">
				<?php MultiIdioma::gettexto("consultarPedido.total_linea") ?>
				</div>
	</div>
<?php
    foreach ($pedidoBean->getLineasPedido() as $lineaPedido) {
?>
		<div class="box_text_content">
			<div class="box_text_lineas">
					<?php echo $lineaPedido->getComponente()->getNombre(); ?>
			</div>
			<div class="box_text_lineas">		
				<?php echo $lineaPedido->getComponente()->getUsuarioVendedor()->getUsuario(); ?>
			</div>
			<div class="box_text_lineas"><?php echo $lineaPedido->getUnidades(); ?></div>
			<div class="box_text_lineas">
				<?php echo $lineaPedido->getPrecioUnidad(); ?>&euro;
			</div>
			<div class="box_text_lineas ult_campo">
				<?php echo $lineaPedido->getTotalLinea() ?>&euro;
			</div>
		</div>
			<div class="box_text_content">
				<div class="linea"><hr/></div>
			</div>
<?php
	}
?>
		<div class="box_text_content">
			<div class="box_text_lineas" id="total">
				<h3 >Total:<?php echo $pedidoBean->getTotal() ?>&euro;</h3>
			</div>
		</div>
</div>

<div class="box_text_content">
	  	

<p><b><?php MultiIdioma::gettexto("realizarPago.datosPayPal") ?></b></p>

<form action="index.php" ><br><br>
<label><?php MultiIdioma::gettexto("realizarPago.cuenta") ?>:</label>
	<input type="text" name="cuenta" value="<?php echo $usuarioComprador->getCuentaPayPal() ?>" />
<br/><br/>

<p><b><?php MultiIdioma::gettexto("realizarPago.datos_envio") ?>:</b></p>
<input id="default" type="radio" name="tipoEnvio" value="<?php echo TIPO_ENVIO_DEFAULT ?>" checked/><?php MultiIdioma::gettexto("realizarPago.usar_envio_defecto") ?>
<input id="otros" type="radio" name="tipoEnvio" value="1" /><?php MultiIdioma::gettexto("realizarPago.usar_otros_datos") ?>
<br/><br/>

<div id="datos">
<label><?php MultiIdioma::gettexto("realizarPago.direccion") ?>: <?php echo $usuarioComprador->getDireccion() ?></label><br />
<label><?php MultiIdioma::gettexto("realizarPago.localidad") ?>: <?php echo $usuarioComprador->getLocalidad() ?></label><br />
<label><?php MultiIdioma::gettexto("realizarPago.provincia") ?>: <?php echo $usuarioComprador->getProvincia() ?></label><br />
<label><?php MultiIdioma::gettexto("realizarPago.codigo_postal") ?>: <?php echo $usuarioComprador->getCp() ?></label><br />
<br/>
</div>
<div id="otrosDatos">
<div id="campo"><label><?php MultiIdioma::gettexto("realizarPago.direccion") ?>:</label> <input type="text" name="direccion" value="" /></div><br />
<div id="campo"><label><?php MultiIdioma::gettexto("realizarPago.localidad") ?>:</label> <input type="text" name="localidad" value="" /></div><br />
<div id="campo"><label><?php MultiIdioma::gettexto("realizarPago.provincia") ?>:</label> <input type="text" name="provincia" value="" /></div><br />
<div id="campo"><label><?php MultiIdioma::gettexto("realizarPago.codigo_postal") ?>:</label> <input type="text" name="cp" value="" /></div><br />
</div>
	<input type="hidden" name="controlador" value="RealizarPagoControlador" />
	<input type="hidden" name="accion" value="realizarPagoPedido" />
	<input type="hidden" name="idPedido" value="<?php echo $idPedido ?>" />
	
<div class="box_content" id="botones">
	<input id="botonI" type="submit" value="Comprar" >
	<a id="botonD" href="index.php?controlador=ListarPedidosControlador&accion=listarPedidosPrivada"><button>Volver</button></a>
</div>

</form>

</div>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>