<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>

<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.mensajes"); ?></li>
    </ul>
</div>
<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <!--<h2><?php MultiIdioma::gettexto("inicio.ultimas_subastas") ?></h2>-->
        <h2><?php echo $notificacionBean->getAsuntoNot() ?></h2>
    </div>
	<div class="box_text_content">
	  	<div class="box_text_det_sub">
			ID <?php echo $notificacionBean->getIdNotificacion() ?><br/><br />
			<?php MultiIdioma::gettexto("listadoNotificaciones.de") ?>: <?php echo $notificacionBean->getUsuarioOrigen()->getUsuario() ?><br/><br />
			<?php MultiIdioma::gettexto("listadoNotificaciones.asunto") ?>: <?php echo $notificacionBean->getAsuntoNot() ?><br/><br />
			<?php MultiIdioma::gettexto("listadoNotificaciones.fecha_hora_envio") ?>: <?php echo $notificacionBean->getFechaEnvioNot() ?><br/><br />
			<?php MultiIdioma::gettexto("listadoNotificaciones.mensaje") ?>: <?php echo $notificacionBean->getTextoNot() ?><br/>
		</div>
	</div>
	<div class="box_text_content ">
		<div class="box_text_ancho">
			<div class="right"><input type="button" value="<?php MultiIdioma::gettexto("comun.volver") ?>" onclick="javascript:history.back()" /></div>
		</div>
	  	
	</div>
</div>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>