<?php
	include HTML_PUBLICA_PATH."/cabecera.php";
?>

	<!--<link rel="stylesheet" type="text/css" href="/recursos/css/login.css" media="screen">-->
	<script type="text/javascript" src="./recursos/js/login.js"></script>
	<script type="text/javascript" src="./index.php?controlador=ParsearFicheroControlador&accion=mostrar&path=/js/funcionesValidar.js"></script>
	<script language="JavaScript" src="./recursos/js/md5.js" type="text/javascript"></script> 
	<script language="JavaScript">
	function mimd5()
	{
	document.forms["login"].elements["clave"].value = (hex_md5(document.forms["login"].elements["clave"].value));
	document.forms["login"].submit();
	}
	</script> 

<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php?controlador=InicioControlador&accion=mostrar"><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.identificate"); ?></li>
    </ul>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.identificate"); ?></h2>
    </div>
 	<div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text">


<p><?php MultiIdioma::gettexto("login.texto_bienvenida"); ?></p>
<?php if(isset($loginFacEx)) {?><p class="error">Los datos de acceso son incorrectos</p><?php } ?>
		</div>
	</div>
	<form method="post" id="login" name="login" action="index.php" onsubmit="if(validarLogin(this)){ mimd5();return true;} else {return false;}" >
	<div class="box_text_content">	
		 <div class="box_text">
			<div id="login">
				<div style="float:right"><label><?php MultiIdioma::gettexto("login.usuario"); ?>:</label><input class="widetext first" type="text" onFocus="restablecer(this)" id="usuario" name="usuario" /><?php if(isset($ERRORES_FORM["usuario"])) {?><br/>Usuario incorrecto<?php } ?></div><br/>
				<div style="float:right"><label><?php MultiIdioma::gettexto("login.clave"); ?>:</label><input class="widetext" type="password" onFocus="restablecer(this)" id="clave" name="clave" /><?php if(isset($ERRORES_FORM["clave"])) {?><br/>Clave incorrecta<?php } ?></div><br/>
				<input type="hidden" name="controlador" value="LoginControlador" />
				<input type="hidden" name="accion" value="autenticar" />
			</div>
		</div>
	</div>
	<div class="box_text_content">	
		 <div class="box_text">
		 	<input class="right button"type="submit" value="<?php MultiIdioma::gettexto("login.entrar"); ?>" />
		 
		 	<br /><br />
			<ul>
				<li><b>Usuarios de pruebas</b></li>
				<li>-Usuario privado:<br />Usuario: usuario1<br />Clave: iu</li>
				<li>-Usuario admin:<br />Usuario: root<br />Clave: iu</li>
			</ul>
		 </div>
	</div>
	</form>
</div>	

																																																																			
<?php
	
	include HTML_PUBLICA_PATH."/pie.php";
?>