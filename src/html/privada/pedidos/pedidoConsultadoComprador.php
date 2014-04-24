<?php
	/**
	 * Pagina de pedido consultado por un comprador
	 * @author Santiago Iglesias
	 */
	include HTML_PRIVADA_PATH."/cabecera.php";
?>
<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><a class="submenu" href="index.php?controlador=ListarPedidosControlador&accion=listarPedidosEnviados" ><?php MultiIdioma::gettexto("menu.pedidos_enviados"); ?></a></li>
		 <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.consultar_detalle_pedido"); ?></li>
    </ul>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <!--<h2><?php MultiIdioma::gettexto("inicio.pedidos") ?></h2>-->
        <h2><?php MultiIdioma::gettexto("menu.consultar_detalle_pedido"); ?></h2>
    </div>
<?php
$idPedido = $pedidoBean->getIdPedido();
$lineas=$pedidoBean->getLineasPedido();
$usuarioVendedor = $pedidoBean->getUsuarioVendedor();
$usuarioComprador = $pedidoBean->getUsuarioComprador();
$estadoPedido = $pedidoBean->getEstadoPedido();
?>

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
	foreach($lineas as $lineaPedido){
?>
	<div class="box_text_content">
			<div class="box_text_lineas">
					<?php echo $lineaPedido->getComponente()->getNombre(); ?>
			</div>
			<div class="box_text_lineas">		
				<?php echo $lineaPedido->getComponente()->getUsuarioVendedor()->getUsuario() ?>
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
</div>

<div class="box_content">
	<div class="box_text_content">
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("consultarPedido.datos_comprador") ?>:</h3>
        </div>
        <div class="box_text_datos_per">	
	   		<?php MultiIdioma::gettexto("consultarPedido.usuario") ?> :
	   	</div>
	   	<div class="box_text_datos_per">
	   		<?php echo $usuarioComprador->getUsuario() ?>
	    </div>
	</div>
	<div class="box_text_content">
		<div class="box_text_datos_per">	
	   		<?php MultiIdioma::gettexto("consultarPedido.email") ?> :
	   	</div>
	   	<div class="box_text_datos_per">
	   		<?php echo $usuarioComprador->getEmail() ?>
	    </div>
	</div>
</div>

<div class="box_content">
	<div class="box_text_content">
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("realizarPago.datos_envio") ?>:</h3>
        </div>
        <div class="box_text_datos_per">	
	   		<?php MultiIdioma::gettexto("realizarPago.direccion") ?> :
	   	</div>
	   	<div class="box_text_datos_per">
	   		<?php echo $usuarioComprador->getDireccion() ?>
	    </div>
	</div>
	<div class="box_text_content">
		<div class="box_text_datos_per">	
	   		<?php MultiIdioma::gettexto("realizarPago.localidad") ?> :
	   	</div>
	   	<div class="box_text_datos_per">
	   		<?php echo $usuarioComprador->getLocalidad() ?>
	    </div>
	</div>
	<div class="box_text_content">
		<div class="box_text_datos_per">	
	   		<?php MultiIdioma::gettexto("realizarPago.provincia") ?> :
	   	</div>
	   	<div class="box_text_datos_per">
	   		<?php echo $usuarioComprador->getProvincia() ?>
	    </div>
	</div>
	<div class="box_text_content">
		<div class="box_text_datos_per">	
	   		<?php MultiIdioma::gettexto("realizarPago.codigo_postal") ?> :
	   	</div>
	   	<div class="box_text_datos_per">
	   		<?php echo $usuarioComprador->getCp() ?>
	    </div>
	</div>
</div>

<form action="index.php">
<input type="hidden" name="controlador" value="CambiarEstadoPedidoControlador" />
<input type="hidden" name="accion" value="cambiarEstado" />
<input type="hidden" name="idPedido" value="<?php echo $pedidoBean->getIdPedido() ?>" />
<div class="box_content">
	<div class="box_text_content">
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("consultarPedido.acciones") ?></h3>
        </div>
        <div class="box_text_datos_per">	
	   		<?php MultiIdioma::gettexto("consultarPedido.estado_pedido") ?> :
	   	</div>
	   	<div class="box_text_datos_per">
	   		<?php if ($estadoPedido->getIdEstadoPedido() == ESTADO_PEDIDO_EN_TRAMITE)  { ?>
	   			<?php MultiIdioma::gettexto("consultarPedido.esperando_vendedor"); ?>
	    	<?php } else if ($estadoPedido->getIdEstadoPedido() == ESTADO_PEDIDO_ACEPTADO) { ?>
	    		<?php MultiIdioma::gettexto("consultarPedido.pedido_enviado_esperando_confirmacion"); ?>
	    	<?php } else if ($estadoPedido->getIdEstadoPedido() == ESTADO_PEDIDO_RECHAZADO) { ?>
	    		<?php MultiIdioma::gettexto("consultarPedido.pedido_rechazado_por_vendedor"); ?>
	    	<?php } else if ($estadoPedido->getIdEstadoPedido() == ESTADO_PEDIDO_RECIBIDO) { ?> 
	    		<?php MultiIdioma::gettexto("consultarPedido.pedido_recibido_por_comprador"); ?>
	    	<?php } else if ($estadoPedido->getIdEstadoPedido() == ESTADO_PEDIDO_NO_RECIBIDO) { ?> 
	    		<?php MultiIdioma::gettexto("consultarPedido.pedido_no_recibido_por_comprador"); ?>
	    	<?php } ?>
	    </div>
	</div>
		<div class="box_text_content">
			<?php if ($estadoPedido->getIdEstadoPedido() == ESTADO_PEDIDO_ACEPTADO)  { ?>
				<div class="box_text_datos_per">
					<?php MultiIdioma::gettexto("consultarPedido.nuevo_estado") ?>
				</div>
				<div class="box_text_datos_per">
					<select name="nuevoEstado">
						<option value="<?php echo ESTADO_PEDIDO_RECIBIDO ?>"><?php MultiIdioma::gettexto("pedidos.rec") ?></option>
						<option value="<?php echo ESTADO_PEDIDO_NO_RECIBIDO ?>"><?php MultiIdioma::gettexto("pedidos.noRec") ?></option>
					</select>	
				</div>
				<div class="box_text_datos_per">
					<a class="right" ><input type="submit" name="Cambiar estado" /></a>
				</div>
			<?php } ?>
			<div class="box_text_ancho">
				<div class="right" ><a href="index.php?controlador=ListarPedidosControlador&accion=listarPedidosEnviados" ><input type="button" value="<?php MultiIdioma::gettexto("comun.volver"); ?>" /></a></div>
			</div>
		</div>
	
</div>
</form>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>