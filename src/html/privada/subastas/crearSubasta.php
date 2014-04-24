

<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>

<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
        <li><a class="submenu" href="index.php?controlador=ListarMisSubastasControlador&accion=listarSubastasPrivada" ><?php MultiIdioma::gettexto("menu.mis_subastas"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.crear_subasta"); ?></li>
    </ul>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("crearSubasta.crearSubasta") ?></h2>
    </div>

<form action="index.php" enctype="multipart/form-data" method="post"/>
<input type="hidden" name="controlador" value="CrearSubastaControlador" />
<input type="hidden" name="accion" value="crearSubasta" />
<input id="idCompSub" type="hidden" name="idCompSub" value="<?php if (isset($_REQUEST["idCompSub"])) { echo $_REQUEST["idCompSub"]; } ?>" />
	<div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("crearSubasta.datos_subasta") ?>:</h3>
        </div>
    </div>
    <?php if (isset($ERRORES_FORM)) { ?>
	<div class="box_text_content">	
    	<div class="box_text_ancho error">
    		<?php MultiIdioma::gettexto("error.hay_errores") ?>:<br /><br />
    		<?php if (isset($ERRORES_FORM["titulo"])) { ?>-<?php MultiIdioma::gettexto("error.titulo") ?><? } ?><br />
    		<?php if (isset($ERRORES_FORM["descripcionBreve"])) { ?>-<?php MultiIdioma::gettexto("error.descripcionBreve") ?><? } ?><br />
    		<?php if (isset($ERRORES_FORM["descripcion"])) { ?>-<?php MultiIdioma::gettexto("error.descripcion") ?><? } ?><br />
    		<?php if (isset($ERRORES_FORM["fechaApertura"])) { ?>-<?php MultiIdioma::gettexto("error.fechaApertura") ?><? } ?><br />
    		<?php if (isset($ERRORES_FORM["horaApertura"])) { ?>-<?php MultiIdioma::gettexto("error.horaApertura") ?><? } ?><br />
    		<?php if (isset($ERRORES_FORM["fechaCierre"])) { ?>-<?php MultiIdioma::gettexto("error.fechaCierre") ?><? } ?><br />
    		<?php if (isset($ERRORES_FORM["horaCierre"])) { ?>-<?php MultiIdioma::gettexto("error.horaCierre") ?><? } ?><br />
    		<?php if (isset($ERRORES_FORM["precioInicial"])) { ?>-<?php MultiIdioma::gettexto("error.precioInicial") ?><? } ?><br />
        </div>
   </div>
   <?php } ?>
		
	<div class="box_text_content">	
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_ancho ult_campo">
			<?php MultiIdioma::gettexto("crearSubasta.nombre") ?>:<input class="input_registro" type="text" name="titulo" value="<?php if (isset($_REQUEST["titulo"])) { echo $_REQUEST["titulo"]; } ?>"><br />
			<?php MultiIdioma::gettexto("crearSubasta.descripcion_breve") ?>:<input class="input_registro" type="text" name="descripcionBreve" value="<?php if (isset($_REQUEST["descripcionBreve"])) { echo $_REQUEST["descripcionBreve"]; } ?>"><br />
			<?php MultiIdioma::gettexto("crearSubasta.descripcion_detallada") ?>:<textarea class="input_registro" name="descripcion"><?php if (isset($_REQUEST["descripcion"])) { echo $_REQUEST["descripcion"]; } ?></textarea><br />
			<!-- MAX_FILE_SIZE debe preceder el campo de entrada de archivo -->
			<script>
			 $(function() {
			    $( "#fechaApertura" ).datepicker({
			      showOn: "button",
			      buttonImage: "./recursos/img/calendar.gif",
			      buttonImageOnly: true,
			    });
			    $( "#fechaApertura" ).datepicker($.datepicker.regional['es']);
			    $("#fechaApertura").datepicker('option','dateFormat','dd/mm/yy');
			  });
			 $(function() {
			    $( "#fechaCierre" ).datepicker({
			      showOn: "button",
			      buttonImage: "./recursos/img/calendar.gif",
			      buttonImageOnly: true
			    });
			     $( "#fechaCierre" ).datepicker($.datepicker.regional['es']);
			    $("#fechaCierre").datepicker('option','dateFormat','dd/mm/yy');
			  });
			  $(function() {
			    $( "#horaApertura" ).timepicker({
			      showOn: "button",
			      buttonImage: "./recursos/img/calendar.gif",
			      buttonImageOnly: true
			    });
			  });
			 $(function() {
			    $( "#horaCierre" ).timepicker({
			      showOn: "button",
			      buttonImage: "./recursos/img/calendar.gif",
			      buttonImageOnly: true
			    });
			  });    
			</script>
		</div>
	</div>
	<div class="box_text_content">
		<div class="box_text_crear_subasta ult_campo">
		<?php MultiIdioma::gettexto("crearSubasta.fecha_apertura") ?>:	<input type="text" id="fechaApertura" name="fechaApertura" value="<?php if (isset($_REQUEST["fechaApertura"])) { echo $_REQUEST["fechaApertura"]; } ?>"><br />
		<?php MultiIdioma::gettexto("crearSubasta.hora_apertura") ?>:	<input type="text" id="horaApertura" name="horaApertura" value="<?php if (isset($_REQUEST["horaApertura"])) { echo $_REQUEST["horaApertura"]; } ?>"><br /><br />
		<?php MultiIdioma::gettexto("crearSubasta.fecha_cierre") ?>: <input  type="text" id="fechaCierre" name="fechaCierre" value="<?php if (isset($_REQUEST["fechaCierre"])) { echo $_REQUEST["fechaCierre"]; } ?>"><br />
		<?php MultiIdioma::gettexto("crearSubasta.hora_cierre") ?>: <input  type="text" id="horaCierre" name="horaCierre" value="<?php if (isset($_REQUEST["horaCierre"])) { echo $_REQUEST["horaCierre"]; } ?>"><br /><br /> 
		<?php MultiIdioma::gettexto("crearSubasta.precio_inicial") ?>: <input type="text" name="precioInicial" value="<?php if (isset($_REQUEST["precioInicial"])) { echo $_REQUEST["precioInicial"]; } ?>">&nbsp;&euro;&nbsp;&nbsp;<br />
		</div>
	</div>
	<div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("crearSubasta.foto_subasta") ?>:</h3>
        	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE ?>" />
        <?php if (isset($ERRORES_FORM["upload"])) {
   				 if ($ERRORES_FORM["upload"] == ERROR_FICHERO_EXCEDE_TAMANO_PHPINI) { ?>
       			<span class="error" ><?php MultiIdioma::gettexto("error.foto.demasiado_grande") ?></span>
       		<?php } else if ($ERRORES_FORM["upload"] == ERROR_FICHERO_EXCEDE_TAMANO_FORM) { ?>
       			<span class="error" ><?php MultiIdioma::gettexto("error.foto.fichero_excede_tamano") ?></span>
       		<?php } else if ($ERRORES_FORM["upload"] == ERROR_FICHERO_PARCIALMENTE_UPLOAD) { ?>
       			<span class="error" ><?php MultiIdioma::gettexto("error.foto.fichero_parcialmente_upload") ?></span>
       		<?php } else if ($ERRORES_FORM["upload"] == ERROR_ARCHIVO_NO_SUBIDO) { ?>
       			<span class="error" ><?php MultiIdioma::gettexto("error.foto.error_archivo_no_subido") ?></span>
       		<?php } else if ($ERRORES_FORM["upload"] == ERROR_FALTA_DIR_TEMPORAL) { ?>
       			<span class="error" ><?php MultiIdioma::gettexto("error.foto.error_falta_dir_temporal") ?></span>
       		<?php } else if ($ERRORES_FORM["upload"] == ERROR_PROBLEMA_PERMISOS) { ?>
       			<span class="error" ><?php MultiIdioma::gettexto("error.foto.error_problema_permisos") ?></span>
       		<?php } 
       		}
       	?>
       		
			<?php MultiIdioma::gettexto("crearSubasta.foto") ?>: <input type="file" name="userfile" />
		</div>
	</div>
	<div class="box_text_content">
    	<div class="box_text_ancho">
			<h3><?php MultiIdioma::gettexto("crearSubasta.datos_componente") ?>:</h3>
		</div>
	</div>
	<?php if (isset($ERRORES_FORM["idCompSub"]) && $ERRORES_FORM["idCompSub"] == true) { ?>
	<div class="box_text_content">
		<div class="box_text_crear_subasta">
       			<span class="error" ><?php MultiIdioma::gettexto("error.idCompSub") ?></span>
		</div>
	</div>
	<?php } ?>
	<div class="box_text_content">
       <div class="box_text_crear_subasta ult_campo">
			<a href="index.php?controlador=ListarCompCrearSubControlador&accion=listarComponentes" id="clsVentanaIFrame" rel="Selecciona un componente"><input id="ventanaEmergente" type="button" value="Buscar componente" ></a><input class="input_crear_sub" disabled="true" type="text" id="nombre" name="nombre" value="<?php if (isset($_REQUEST["nombre"])) { echo $_REQUEST["nombre"]; } ?>"><br />
		</div>
	</div>
	<div class="box_text_content">
    	<div class="box_text_ancho ult_campo">
       		<div class="right"><input type="submit" value="<?php MultiIdioma::gettexto("crearSubasta.crear") ?>" /></div>
        </div>
    </div>
</form>
</div>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>