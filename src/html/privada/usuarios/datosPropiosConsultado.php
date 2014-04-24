<?php 
	/**
	 * HTML de consultar datos propios
	 * @author Miguel Callon
	 */
	 include HTML_PRIVADA_PATH."/cabecera.php";
?>

<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.datos_propios"); ?></li>
    </ul>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.datos_propios"); ?></h2>
    </div>
	<div class="box_text_content">
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("datosPropiosConsultado.datos_personales") ?>:</h3>
        </div>
        <div class="box_text_datos_per">	
	   		<?php MultiIdioma::gettexto("datosPropiosConsultado.nombre") ?> :
	   	</div>
	   	<div class="box_text_datos_per">
	   		<?php echo $usuarioBean->getNombre(); ?>
	    </div>
	</div>
	<div class="box_text_cont_sin_marg">
        <div class="box_text_datos_per">
	    	<?php MultiIdioma::gettexto("datosPropiosConsultado.apellidos") ?> : 
	    </div>	
	  	<div class="box_text_datos_per">
	  		<?php echo $usuarioBean->getApellidos(); ?>
	  	</div>
	</div>
	<div class="box_text_cont_sin_marg">
	   <div class="box_text_datos_per">
	   		<?php MultiIdioma::gettexto("datosPropiosConsultado.fechaNacimiento") ?> :
	   </div>
	   <div class="box_text_datos_per">
	  		<?php echo $usuarioBean->getFechaNacimiento(); ?>
	   </div>
	</div>
	<div class="box_text_cont_sin_marg">
		<div class="box_text_datos_per">
	   		DNI : 
	   	</div>
	   	<div class="box_text_datos_per">
	   		<?php echo $usuarioBean->getDni(); ?>
	   	</div>
	</div>
	<div class="box_text_cont_sin_marg">
		<div class="box_text_datos_per">
	   		<?php MultiIdioma::gettexto("datosPropiosConsultado.telefono") ?> :
	   </div>
	   <div class="box_text_datos_per">
	   		<?php echo $usuarioBean->getTelefono(); ?>
	   </div>
	</div>
	<div class="box_text_cont_sin_marg">
		<div class="box_text_datos_per">
	  		<?php MultiIdioma::gettexto("datosPropiosConsultado.email") ?> :
	  	</div>
	  	<div class="box_text_datos_per">
	  		<?php echo $usuarioBean->getEmail(); ?>
	  	</div>
	</div>
	<div class="box_text_cont_sin_marg">
	  	<div class="box_text_datos_per">
	  		<?php MultiIdioma::gettexto("datosPropiosConsultado.direccion") ?> :
	  	</div>
	  	<div class="box_text_datos_per">
	  	    <?php echo $usuarioBean->getDireccion(); ?>
	    </div>
	</div>
	<div class="box_text_cont_sin_marg">
	    <div class="box_text_datos_per">
	    	<?php MultiIdioma::gettexto("datosPropiosConsultado.cp") ?> : 
	    </div>
	    <div class="box_text_datos_per">
	    	<?php echo $usuarioBean->getCp(); ?>
	    </div>
	    <div class="box_text_datos_per">&nbsp;</div>
	    <div class="box_text_datos_per">
	 		<div class="right"><input type="submit" value="<?php MultiIdioma::gettexto("comun.modificar") ?>" /></div>
	 	</div>
    </div>
<script language="JavaScript" src="./recursos/js/md5.js" type="text/javascript"></script> 
<script>
function mimd5()
	{
	document.forms["login"].elements["claveNueva"].value = (hex_md5(document.forms["login"].elements["claveNueva"].value));
	document.forms["login"].elements["claveActual"].value = (hex_md5(document.forms["login"].elements["claveActual"].value));
	document.forms["login"].elements["repetirClave"].value = (hex_md5(document.forms["login"].elements["repetirClave"].value));
	document.forms["login"].submit();
	}
</script> 
<form name="login" id="login" action="index.php" onsubmit="mimd5()" >
	<input type="hidden" name="controlador" value="ModificarDatosControlador" /> 
	<input type="hidden" name="accion" value="modificarContrasena" /> 
    <div class="box_text_content">
        <div class="box_text_ancho">
        	<h3><?php MultiIdioma::gettexto("datosPropiosConsultado.datos_validacion") ?>:</h3>
        </div>
        <div class="box_text_datos_per">	
	   		<?php MultiIdioma::gettexto("datosPropiosConsultado.clave_actual") ?> :
	   	</div>
	   	<div class="box_text_datos_per">
	   		<input type="password" name="claveActual">
	    </div>
	</div>
	<div class="box_text_cont_sin_marg">
	  	<div class="box_text_datos_per">
	  		<?php MultiIdioma::gettexto("datosPropiosConsultado.clave_nueva") ?> :
	  	</div>
	  	<div class="box_text_datos_per">
	  	    <input type="password" name="claveNueva">
	    </div>
	</div>
	<div class="box_text_cont_sin_marg">
	  	<div class="box_text_datos_per">
	  		<?php MultiIdioma::gettexto("datosPropiosConsultado.repetir_clave") ?> :
	  	</div>
	  	<div class="box_text_datos_per">
	  	    <input type="password" name="repetirClave">
	    </div>
	 	<div class="box_text_datos_per">
	 		<div class="right"><input type="submit" value="Guardar" /></div>
	 	</div>
	</div>
</form>
	<div class="box_text_content">
    	<div class="box_text_ancho ult_campo">
       		<div class="right"><input type="button" value="<?php MultiIdioma::gettexto("comun.volver") ?>" onclick="javascript:history.back()" /></div>
        </div>
    </div>
</form>
</div>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>