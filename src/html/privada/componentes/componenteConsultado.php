<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>
<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><a class="submenu" href="index.php?controlador=ListarComponentesControlador&accion=listarComponentes"><?php MultiIdioma::gettexto("menu.componentes"); ?></a></li>
    	<li>-></li>
    	<li><?php MultiIdioma::gettexto("menu.consultar_detalle_componente"); ?></li>
    </ul>
</div>

<form action="index.php" enctype="multipart/form-data" method="post"/>
				<input type="hidden" name="controlador" value="AnhadirAlCarritoControlador" />
				<input type="hidden" name="accion" value="addCarrito" />
				<input type="hidden" name="idComponente" value="<?php echo $compBean->getIdComponente() ?>" />
<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <!--<h2><?php MultiIdioma::gettexto("inicio.ultimas_subastas") ?></h2>-->
        <h2><?php echo $compBean->getNombre(); ?></h2>
    </div>
	<div class="box_text_content">
	  	<div class="box_text">	 
	  		<?php if (count($listaFotos) == 0) { ?>
	  			 <img width="200px" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=" />
	  		<?php } elseif (count($listaFotos) == 1) { 
	  			$foto = $listaFotos[0];
	  		?>		
				 <img width="200px" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo  $foto->getRuta() ?>" />
			<?php } else { ?>
	  		<div id="gallery">
			    <div id="panel">
			    	<?php foreach ($compBean->getListaFotos() as $foto) { ?> 
			    		<?php if ($foto->getIsPrincipal() == "1") { ?>
					        <img id="largeImage" width="200px" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo  $foto->getRuta() ?>" />
					        <!--<div id="description">First image description</div>-->
					    <?php } ?>
				    <?php } ?>
			    </div>
			    <div id="thumbs">
			    	<?php foreach ($compBean->getListaFotos() as $foto) { ?>
			  				<img width="100px" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo  $foto->getRuta() ?>" />
			    	<?php } ?>
			    </div>
			</div>
			<?php } ?>
	<script>
		$('#thumbs').delegate('img','click', function(){
		    $('#largeImage').attr('src',$(this).attr('src').replace('thumb','large'));
		    /*$('#description').html($(this).attr('alt'));*/
		});
	</script>
	    </div>
	  	<div class="box_text_det_sub">			
	  		<?php echo $compBean->getUsuarioVendedor()->getUsuario() ?><br/><br/>
			<?php MultiIdioma::gettexto("consultarComponente.unidades_disponibles") ?>: <?php echo $compBean->getUnidadesStock() ?><br/><br/>
			<?php echo $compBean->getDescripcion() ?><br/><br/>
		</div>
	</div>
	<div class="box_text_content">
        <div class="box_text_ancho ult_campo">
        	<?php MultiIdioma::gettexto("consultarComponente.cantidad"); ?>
   			<select name="numElementos">
   				<?php for ($i = 1; $i <= $compBean->getUnidadesStock(); $i++) { ?>
   					<option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
   				<?php } ?>
   			</select>
			<input type="submit" name="addCarrito" value="<?php MultiIdioma::gettexto("consultarComponente.carrito"); ?>"/>  
			<input type="button" value="<?php MultiIdioma::gettexto("comun.volver") ?>" onclick="javascript:history.back()" />    	 	
		</div>
	</div>
</div>

</form>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>