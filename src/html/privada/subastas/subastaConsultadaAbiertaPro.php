<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>
<!-- Automatizar esto: -->

<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
        <li><a class="submenu" href="index.php?controlador=ListarMisSubastasControlador&accion=listarSubastasPrivada" ><?php MultiIdioma::gettexto("menu.mis_subastas"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.detalle_subasta_abierta_propietario"); ?></li>
    </ul>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <!--<h2><?php MultiIdioma::gettexto("inicio.ultimas_subastas") ?></h2>-->
        <h2><?php echo $subastaBean->getTitulo() ?></h2>
    </div>

<form action="index.php" >
<input type="hidden" name="controlador" value="ModificarFinDeSubastaControlador" />
<input type="hidden" name="accion" value="modificarFinDeSubasta" />
<input type="hidden" name="idSubasta" value="<?php echo $subastaBean->getIdSubasta() ?>" />
	  <div class="box_text_content">
	  	<div class="box_text">
	  		<img width="200" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo $subastaBean->getRutaFotoSub() ?>" />
	    </div>
	  	<div class="box_text_registro">
			<?php echo $subastaBean->getUsuarioCreador()->getUsuario() ?><br />
			<?php MultiIdioma::gettexto("consultarSubasta.fecha_apertura") ?>: <?php echo $subastaBean->getFechaApertura() ?><br/>
			<?php MultiIdioma::gettexto("consultarSubasta.tiempo_restante") ?>:<?php echo $subastaBean->getTiempoRestante() ?><br/>
			<?php MultiIdioma::gettexto("consultarSubasta.fecha_cierre") ?>:<?php echo $subastaBean->getFechaCierre(); ?><br /><br />
				<script>
				 $(function() {
				    $( "#fechaCierre" ).datepicker({
				      showOn: "button",
				      buttonImage: "./recursos/img/calendar.gif",
				      buttonImageOnly: true
				    });
				    $("#fechaCierre").datepicker('option','dateFormat','dd/mm/yy');
				  });
				  $(function() {
				    $( "#horaCierre" ).timepicker({
				      showOn: "button",
				      buttonImage: "./recursos/img/calendar.gif",
				      buttonImageOnly: true
				    });
				  });
				</script>
				
				<?php MultiIdioma::gettexto("consultarSubasta.fecha_cierre") ?>: <input type="text" id="fechaCierre" name="fechaCierre" value="<?php echo Fecha::getFecha($subastaBean->getFechaCierre()); ?>" /><br/>
				<?php MultiIdioma::gettexto("consultarSubasta.hora_cierre") ?>: <input type="text" id="horaCierre" name="horaCierre" value="" />
				<input type="submit" value="Cambiar cierre" /><br/>
			
			<?php MultiIdioma::gettexto("consultarSubasta.descripcion") ?>: <?php echo $subastaBean->getDescripcion() ?>   
		
			<!--<?php MultiIdioma::gettexto("consultarSubasta.descripcion_breve") ?>: <?php echo $subastaBean->getDescripcionBreve() ?>-->
		</div>
</form>
	  </div>
	<?php include HTML_PRIVADA_SUBASTAS_PATH."/pujasListadas.php"; ?>
	<?php if (count($subastaBean->getListaPujas()) == 0) { ?>
	 <div class="box_text_content">
	  	<div class="box_text_ancho">
			<div class="right" ><a href="index.php?controlador=CancelarSubastaControlador&accion=cancelarSubasta&idSubasta=<?php echo $subastaBean->getIdSubasta() ?>" >
			<input type="button" value="Cancelar subasta" >
		</a></div>
		</div>
	</div>
	<?php } ?>
</div>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>