<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr"><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="stylesheet" type="text/css" href="./recursos/css/style.css" media="screen">
	<title>SubastasIU</title>
	<script src="./recursos/js/jquery-1.7.2.js"></script>
</head>

<body>
<!--<script type="text/javascript">
$(document).ready(function(){
	alert($(".first"));
    $(".first").focus();
    alert("2");
});
</script>-->	
<div id="main_container">
	<div class="header">
    	<div id="logo"><a href="index.php"><img src="./recursos/img/logo.png" alt="SubastasIU" title="SubastasIU" width="162" height="54" border="0"></a></div>
    	<div class="right_header">
            <div class="top_menu">
            	<a href="index.php?controlador=LoginControlador&accion=mostrarFormulario" class="login" ><?php MultiIdioma::gettexto("inicio.identificate") ?></a>
            	<a href="index.php?controlador=RegistrarUsuarioControlador&accion=mostrarFormulario" class="sign_up" ><?php MultiIdioma::gettexto("inicio.registrate") ?></a>
                <a href="index.php?controlador=CambiarIdiomaControlador&accion=cambiar&idioma=es_ES" class="banderas" >&nbsp;<img src="./recursos/img/es.png" alt="<?php MultiIdioma::gettexto("menu.idioma_espanol"); ?>" title="<?php MultiIdioma::gettexto("menu.idioma_espanol"); ?>" /></a>  
				<a href="index.php?controlador=CambiarIdiomaControlador&accion=cambiar&idioma=en_EN" class="banderas" >&nbsp;<img src="./recursos/img/gb.png" alt="<?php MultiIdioma::gettexto("menu.idioma_ingles"); ?>" title="<?php MultiIdioma::gettexto("menu.idioma_ingles"); ?>" /></a>
				<a href="index.php?controlador=CambiarIdiomaControlador&accion=cambiar&idioma=gl_ES" class="banderas" >&nbsp;<img src="./recursos/img/bgallega.png" alt="<?php MultiIdioma::gettexto("menu.idioma_gallego"); ?>" title="<?php MultiIdioma::gettexto("menu.idioma_gallego"); ?>" /></a>
            </div>
			<?php include HTML_PUBLICA_PATH."/menu.php" ?>;
        </div>
    </div>
	<div id="middle_box">
		<div class="middle_box_content"><img src="./recursos/img/banner_content_<?php echo Session::get(LOCALE_KEY); ?>.jpg" alt="" title=""></div>
	</div>
	
	<div id="main_content">