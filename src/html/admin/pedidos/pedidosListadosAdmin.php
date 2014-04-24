<?php
	include HTML_ADMIN_PATH."/cabecera.php";
?>




<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
       <h2><?php MultiIdioma::gettexto("menu.pedidos") ?></h2>
       
    </div>



	<form action="index.php">
		<div class="box_text_content">
	  	
		<input type="hidden" name="controlador" value="ListarPedidosAdminControlador" />
		<input type="hidden" name="accion" value="buscarPedidos" />
		
		
			<table>
					<tr>
					<td><label><?php MultiIdioma::gettexto("pedido.id"); ?>:</label></td>
					<td><input type="text" name="idPedido" value="<?php echo $busquedaPedidosBean->getIdPedido() ?>" /></td>
					<td><label><?php MultiIdioma::gettexto("pedido.estado"); ?>:</label></td>
					<td><input type="text" name="estadoPedido" value="<?php echo $busquedaPedidosBean->getEstadoPedido() ?>" /></td>
					<td><label><?php MultiIdioma::gettexto("pedido.vendedor"); ?>:</label></td>
					<td><input type="text" name="usuarioVendedor" value="<?php echo $busquedaPedidosBean->getUsuarioVendedor() ?>" /></td>
					
					</tr>
					<tr>
					<td><label><?php MultiIdioma::gettexto("pedido.fecha_compra_entre"); ?>:</label></td>
					<td><input type="text" name="fechaCompraIni" value="<?php echo $busquedaPedidosBean->getFechaCompraIni() ?>" /></td>
					<td><label><?php MultiIdioma::gettexto("pedido.y"); ?>:</label></td>
					<td><input type="text" name="fechaCompraFin" value="<?php echo $busquedaPedidosBean->getFechaCompraFin() ?>" /></td>
					<td><label><?php MultiIdioma::gettexto("pedido.comprador"); ?>:</label></td>
					<td><input type="text" name="usuarioComprador" value="<?php echo $busquedaPedidosBean->getUsuarioComprador() ?>" /></td>
					</tr>
					<tr>
					<td><label><?php MultiIdioma::gettexto("pedido.fecha_actualizacion_entre"); ?>:</label></td>
					<td><input type="text" name="fechaActualizacionIni" value="<?php echo $busquedaPedidosBean->getFechaActualizacionIni() ?>" /></td>
					<td><label><?php MultiIdioma::gettexto("pedido.y"); ?>:</label></td>
					<td><input type="text" name="fechaActualizacionFin" value="<?php echo $busquedaPedidosBean->getFechaActualizacionFin() ?>" /></td>
					<td></td>
					<td align="center" ><input type="submit" value="<?php MultiIdioma::gettexto("pedido.buscar"); ?>"/></td>
					</tr>
					
			</table>
		</div>
		
		<br/><br/><br/>	<br/><br/><br/><br/><br/><br/>	<br/><br/><br/>

		<div class="box_text_content">
		  	<div class="box_text_ancho">
			 <?php include HTML_PATH."/paginadoTop.php"; ?>
		    </div>
		</div>
	  	
	   	  
	<div class="box_text_content">
				<div class="box_text_pedidos lista_head ">
				<?php MultiIdioma::gettexto("pedido.id"); ?>
				</div>
			<div class="box_text_pedidos lista_head ">
				<?php MultiIdioma::gettexto("pedido.fecha_alta"); ?>
				</div>
				<div class="box_text_pedidos lista_head ">
				<?php MultiIdioma::gettexto("pedido.fecha_actualizacion"); ?>
				</div>
				<div class="box_text_pedidos lista_head ">
				<?php MultiIdioma::gettexto("pedido.vendedor"); ?>
				</div>
				<div class="box_text_pedidos lista_head ">
				<?php MultiIdioma::gettexto("pedido.comprador"); ?>
				</div>
				<div class="box_text_pedidos lista_head ">
				<?php MultiIdioma::gettexto("pedido.estado"); ?>
				</div>
				

			
	</div>

<?php
    foreach ($listaPedidos as $pedido) {
?>
		<div class="box_text_content">
			<div class="box_text_pedidos">
				<a href="index.php?controlador=ConsultarPedidoAdminControlador&accion=consultarPedido&idPedido=<?php echo $pedido->getIdPedido() ?>" >
					<?php echo $pedido->getIdPedido() ?></a>
			</div>
			<div class="box_text_pedidos">		
				<?php echo $pedido->getFechaAlta() ?>
			</div>
			<div class="box_text_pedidos">
				<?php echo $pedido->getFechaActualizacion() ?>
				</div>
			<div class="box_text_pedidos">
				<?php echo $pedido->getUsuarioVendedor()->getUsuario() ?>
				</div>
			<div class="box_text_pedidos">
				<?php echo $pedido->getUsuarioComprador()->getUsuario() ?>
				</div>
			<div class="box_text_pedidos">
				<?php echo $pedido->getEstadoPedido()->getNombre() ?>
				</div>
			<div class="box_text_pedidos">
				<a href="index.php?controlador=ConsultarPedidoAdminControlador&accion=consultarPedido&idPedido=<?php echo $pedido->getIdPedido() ?>" >
					Detalle</a>
				</div>
			</div>
			<div class="box_text_content">
				<div class="linea"><hr/></div>
			</div>
<?php
	}
?>
			
<div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginado.php"; ?>
	    </div>
	</div>
</form>

</div>

		
<?php
	include HTML_ADMIN_PATH."/pie.php";
?>
