<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>

<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><a class="submenu" href="index.php?controlador=ListarSubastasControlador&accion=listarSubastasPrivada" ><?php MultiIdioma::gettexto("menu.subastas"); ?></a></li>
		<li>-></li>
		<li><?php MultiIdioma::gettexto("consultarSubasta.detalle_subasta_cerrada"); ?></li>
    </ul>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <!--<h2><?php MultiIdioma::gettexto("inicio.ultimas_subastas") ?></h2>-->
        <h2><?php echo $subastaBean->getTitulo() ?></h2>
    </div>

<form action="index.php" >
	<div class="box_text_content">
	  	<div class="box_text">
	  		<img width="200" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo $subastaBean->getRutaFotoSub() ?>" />
	    </div>
	  	<div class="box_text_registro">
			<?php echo $subastaBean->getUsuarioCreador()->getUsuario() ?><br />
			<?php MultiIdioma::gettexto("consultarSubasta.fecha_apertura") ?>: <?php echo $subastaBean->getFechaApertura() ?><br/>
			<?php MultiIdioma::gettexto("consultarSubasta.fecha_cierre") ?>: <?php echo $subastaBean->getFechaCierre() ?><br/>
			<?php MultiIdioma::gettexto("consultarSubasta.descripcion_breve") ?>: <?php echo $subastaBean->getDescripcionBreve() ?>
			<?php MultiIdioma::gettexto("consultarSubasta.descripcion") ?>: <?php echo $subastaBean->getDescripcion() ?>
		</div>
	</div>
<?php include HTML_PRIVADA_SUBASTAS_PATH."/pujasListadas.php"; ?>
</form>
</div>

<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>