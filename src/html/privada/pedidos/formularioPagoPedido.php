<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>
<?php
$idPedido = $pedidoBean->getIdPedido();
if (isset($idPedido)) {
	$lineas=$pedidoBean->getLineasPedido();
	$usuarioVendedor = $pedidoBean->getUsuarioVendedor();
	$usuarioComprador = $pedidoBean->getUsuarioComprador();
	$estadoPedido = $pedidoBean->getEstadoPedido();
?>

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
<p>Inicio -> Pedido -> Detalle.....</p>
<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <!--<h2><?php MultiIdioma::gettexto("inicio.pedidos") ?></h2>-->
        <h2>Pedido</h2>
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
				
					


<?php
    foreach ($lineas as $lineaPedido) {
?>
		<div class="box_text_content">
			<div class="box_text_lineas">
				<a href="index.php?controlador=ConsultarPedidoControlador&accion=consultarPedido&idPedido=<?php echo $lineaPedido->getIdPedido() ?>" >
					<?php echo $lineaPedido->getComponente() ?></a>
			</div>
			<div class="box_text_lineas">		
				<?php echo $lineaPedido->getVendedor() ?>
			</div>
			<div class="box_text_lineas">
				<?php echo $lineaPedido->getUnidades() ?>
				</div>
			<div class="box_text_lineas">
				<?php echo $lineaPedido->getPrecioUnidad() ?>&euro;
				</div>
			<div class="box_text_lineas ult_campo">
				<?php echo $lineaPedido->getPrecioTotal() ?>&euro;

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
	<a id="botonD" href="index.php?controlador=ListarPedidosControlador&accion=listarPedidos"><button>Volver</button></a>
</div>

	

</form>

</div>



</div>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>




<?php	
}
?>
