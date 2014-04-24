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
        <h2><?php MultiIdioma::gettexto("menu.mensajes"); ?></h2>
    </div>

<form action="index.php" >
	<input type="hidden" name="controlador" value="ListarNotificacionesControlador" />
	<input type="hidden" name="accion" value="listarNotificacionesPrivada" />
	  <div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginadoTop.php"; ?>
	    </div>
	  </div>
	  <div class="box_text_content">
	    <div class="box_text_listar_not lista_head">
			ID
		</div>
		<div class="box_text_listar_not lista_head">
			<?php MultiIdioma::gettexto("listadoNotificaciones.asunto"); ?>
		</div>
		<div class="box_text_listar_not lista_head">
			<?php MultiIdioma::gettexto("listadoNotificaciones.de"); ?>
		</div>
		<div class="box_text_listar_not lista_head">
			<?php MultiIdioma::gettexto("listadoNotificaciones.fecha_hora_envio"); ?>
		</div>
		<div class="box_text_listar_not lista_head">
			<?php MultiIdioma::gettexto("listadoNotificaciones.estado"); ?>
		</div>
		<div class="box_text_listar_not">&nbsp;</div>
	</div>
<?php
    foreach ($listaNotificaciones as $notificacion) {
?>
	<div class="box_text_content">
		<div class="box_text_listar_not">
			<a href="index.php?controlador=ConsultarNotificacionesControlador&accion=consultarNotificacion&idNotificacion=<?php echo $notificacion->getIdNotificacion() ?>" class="details" ><?php echo $notificacion->getIdNotificacion() ?></a>
		</div>
		<div class="box_text_listar_not">
			<?php echo $notificacion->getAsuntoNot() ?>
		</div>
		<div class="box_text_listar_not">
			<?php echo $notificacion->getUsuarioOrigen()->getUsuario() ?>
		</div>
		<div class="box_text_listar_not">
			<?php echo $notificacion->getFechaEnvioNot() ?>
		</div>
		<div class="box_text_listar_not">
			<?php if ($notificacion->getIdEstadoNotificacion() == ESTADO_NOTIFICACION_NO_LEIDO) { ?>
				<?php MultiIdioma::gettexto("listadoNotificaciones.notificacion_no_leida") ?>
			<?php } else { ?>
				<?php MultiIdioma::gettexto("listadoNotificaciones.notificacion_leida") ?>
			<?php } ?>
		</div>
		<div class="box_text_listar_not">
			<div class="right">
				<a href="index.php?controlador=ConsultarNotificacionesControlador&accion=consultarNotificacion&idNotificacion=<?php echo $notificacion->getIdNotificacion() ?>" class="details" >+ <?php MultiIdioma::gettexto("listadoNotificaciones.leer_mensaje") ?></a>
			</div>
		</div>
	</div>
	<div class="box_text_content">
		<div class="linea"><hr/></div>
	</div>
<?php
	}
?>
    <div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginado.php"; ?>
	    </div>
	</div>
</form>
</div>

<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>