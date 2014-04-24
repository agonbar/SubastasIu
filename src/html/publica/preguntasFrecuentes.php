<?php
	include HTML_PUBLICA_PATH."/cabecera.php";
?>

<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php?controlador=InicioControlador&accion=mostrar"><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("preguntas_frecuentes.titulo") ?></li>
    </ul>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("preguntas_frecuentes.titulo") ?></h2>
    </div>
    <div class="box_text_content">
    	<!--<img src="./recursos/img/calendar.gif" alt="" title="" class="box_icon">-->
        <div class="box_text_registro">
		</div>
	</div>
</div>
<p></p>

<?php
	include HTML_PUBLICA_PATH."/pie.php";
?>