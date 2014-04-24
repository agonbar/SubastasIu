<?php 
  $usuarioBean = Session::get(USUARIO_CONECTADO_KEY);
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr"><head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="stylesheet" type="text/css" href="./recursos/css/style.css" media="screen">
	<title>SubastasIU</title>
	<link rel="stylesheet" href="./recursos/css/jquery-ui.css" />
	<link rel="stylesheet" href="./recursos/css/ventanasModales.css" />
	<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
	<!--<script src="./recursos/js/jquery-1.10.2.js"></script>-->
	<script src="./recursos/js/jquery-1.7.2.js"></script>
	<script src="./recursos/js/jquery-ui.js"></script>
	<script src="./recursos/js/jquery-ui-timepicker.js"></script>
	<script src="./recursos/js/jquery.galleriffic.js"></script>
	<!--<script src="./recursos/js/jquery.bpopup.js"></script>-->
	<script src="./recursos/js/ventanasModales.js"></script>
</head>

<body>
<div id="main_container">
	<div class="header">
    	<div id="logo"><a href="index.php"><img src="./recursos/img/logo.png" alt="SubastasIU" title="SubastasIU" width="162" height="54" border="0"></a></div>
    	<div class="right_header">
            <div class="top_menu_privada">
            	<a href="index.php?controlador=ConsultarUsuarioControlador&accion=consultarDatosPropios" class="texto" ><?php MultiIdioma::gettexto("inicio.bienvenido") ?>: <?php echo $usuarioBean->getUsuario() ?></a>
            	<a href="index.php?controlador=ConsultarCarritoControlador&accion=consultarCarrito" class="texto_carrito" ><?php MultiIdioma::gettexto("inicio.ver_carrito") ?></a>
                 <a href="index.php?controlador=CambiarIdiomaControlador&accion=cambiar&idioma=es_ES" class="banderas" >&nbsp;<img src="./recursos/img/es.png" alt="<?php MultiIdioma::gettexto("menu.idioma_espanol"); ?>" title="<?php MultiIdioma::gettexto("menu.idioma_espanol"); ?>" /></a>  
				<a href="index.php?controlador=CambiarIdiomaControlador&accion=cambiar&idioma=en_EN" class="banderas" >&nbsp;<img src="./recursos/img/gb.png" alt="<?php MultiIdioma::gettexto("menu.idioma_ingles"); ?>" title="<?php MultiIdioma::gettexto("menu.idioma_ingles"); ?>" /></a>
            	<a href="index.php?controlador=CambiarIdiomaControlador&accion=cambiar&idioma=gl_ES" class="banderas" >&nbsp;<img src="./recursos/img/bgallega.png" alt="<?php MultiIdioma::gettexto("menu.idioma_gallego"); ?>" title="<?php MultiIdioma::gettexto("menu.idioma_gallego"); ?>" /></a>
            </div>
			<?php include HTML_PRIVADA_PATH."/menu.php" ?>
        </div>
    </div>
	<!--<div id="middle_box">
		<div class="middle_box_content"><img src="./recursos/img/banner_content.jpg" alt="" title=""></div>
	</div>-->
	
	<div id="main_content">