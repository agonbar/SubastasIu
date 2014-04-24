<?php
	include HTML_PUBLICA_PATH."/cabecera.php";
?>
	<script language="JavaScript" src="./recursos/js/md5.js" type="text/javascript"></script> 
	<script language="JavaScript">
	function mimd5()
	{
	document.forms["registro"].elements["clave"].value = (hex_md5(document.forms["registro"].elements["clave"].value));
	document.forms["registro"].elements["repetirClave"].value = (hex_md5(document.forms["registro"].elements["repetirClave"].value));
	document.forms["registro"].submit();
	}
	</script> 

<!--<link rel="stylesheet" type="text/css" href="/recursos/css/registrarUsuario.css" media="screen">-->
<script type="text/javascript" src="/recursos/js/registro.js"></script>
<script type="text/javascript" src="/recursos/js/funcionesValidar.js"></script>
<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php?controlador=InicioControlador&accion=mostrar"><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.registro"); ?></li>
    </ul>
</div>


<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.registro"); ?></h2>
    </div>

<form name="registro" id="registro" action="index.php" onsubmit="return validarRegistro(this)">
<input type="hidden" name="controlador" value="RegistrarUsuarioControlador" />
<input type="hidden" name="accion" value="registrarUsuario" />
 	<div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_registro">
<div class="right"><label><?php MultiIdioma::gettexto("registro.nombre") ?>:</label> <input type="text" name="nombre" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["nombre"])) { echo $_REQUEST["nombre"]; } ?>" /><?php if(isset($ERRORES_FORM["nombre"])) {?>Nombre incorrecto<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.apellidos") ?>:</label> <input type="text" name="apellidos" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["apellidos"])) { echo $_REQUEST["apellidos"]; } ?>" /><?php if(isset($ERRORES_FORM["apellidos"])) {?>Apellidos incorrectos<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.fecha_nacimiento") ?>:</label><input type="text" name="diaNacimiento" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["diaNacimiento"])) { echo $_REQUEST["diaNacimiento"]; } ?>" size="1" maxlength="2" />/<input type="text" name="mesNacimiento" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["mesNacimiento"])) { echo $_REQUEST["mesNacimiento"]; } ?>" size="1" maxlength="2" />/<input type="text" name="anhoNacimiento" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["anhoNacimiento"])) { echo $_REQUEST["anhoNacimiento"]; } ?>" size="1" maxlength="4" /><?php if(isset($ERRORES_FORM["fechaNacimiento"])) {?>Fecha nacimiento incorrecta<?php } ?></div><br/>
<div class="right"><label>DNI:</label> <input type="text" name="dni" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["dni"])) { echo $_REQUEST["dni"]; } ?>" /><?php if(isset($ERRORES_FORM["dni"])) {?>DNI incorrecto<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.telefono") ?>:</label> <input type="text" name="telefono" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["telefono"])) { echo $_REQUEST["telefono"]; } ?>" /><?php if(isset($ERRORES_FORM["telefono"])) {?>Telefono incorrecto<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.email") ?>:</label> <input type="text" name="email" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["email"])) { echo $_REQUEST["email"]; } ?>" /><?php if(isset($ERRORES_FORM["email"])) {?>Email incorrecto<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.direccion") ?>:</label> <input type="text" name="direccion" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["direccion"])) { echo $_REQUEST["direccion"]; } ?>" /><?php if(isset($ERRORES_FORM["direccion"])) {?>Direccion incorrecta<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.localidad") ?>:</label> <input type="text" name="localidad" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["localidad"])) { echo $_REQUEST["localidad"]; } ?>" /><?php if(isset($ERRORES_FORM["localidad"])) {?>Localidad incorrecta<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.provincia") ?>:</label> <input type="text" name="provincia" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["provincia"])) { echo $_REQUEST["provincia"]; } ?>" /><?php if(isset($ERRORES_FORM["provincia"])) {?>Provincia incorrecta<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.codigoPostal") ?>:</label> <input type="text" name="codigoPostal" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["codigoPostal"])) { echo $_REQUEST["codigoPostal"]; } ?>" /><?php if(isset($ERRORES_FORM["cp"])) {?>Codigo postal incorrecto<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.cuentaPayPal") ?>:</label> <input type="text" name="cuentaPayPal" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["cuentaPayPal"])) { echo $_REQUEST["cuentaPayPal"]; } ?>" /><?php if(isset($ERRORES_FORM["cuentaPayPal"])) {?>Cuenta PayPal incorrecta<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.usuario") ?>:</label> <input type="text" name="usuario" onFocus="restablecer(this)" value="<?php if (isset($_REQUEST["usuario"])) { echo $_REQUEST["usuario"]; } ?>" /><?php if(isset($ERRORES_FORM["usuario"])) {?>Usuario incorrecto<?php } ?></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.clave") ?>:</label> <input type="password" name="clave" onFocus="restablecer(this)" value="" /></div><br/>
<div class="right"><label><?php MultiIdioma::gettexto("registro.repetir_clave") ?>:</label> <input type="password" name="repetirClave" onFocus="restablecer(this)" value="" /></div><br/>
		</div>	
	</div>
	<div class="box_text_content">	
		 <div class="box_text_registro">
		 	<input onclick="mimd5()" class="right button"type="submit" value="<?php MultiIdioma::gettexto("registro.enviar"); ?>" />
		 </div>
	</div>
</form>

</div>
<?php
	include HTML_PUBLICA_PATH."/pie.php";
?>?>