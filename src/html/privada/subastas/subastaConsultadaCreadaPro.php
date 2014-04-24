<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>
<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
        <li><a class="submenu" href="index.php?controlador=ListarSubastasControlador&accion=listarSubastasPrivada" ><?php MultiIdioma::gettexto("menu.mis_subastas"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.detalle_subasta_creada_propietario"); ?></li>
    </ul>
</div>

<h1><?php echo $subastaBean->getTitulo() ?></h1>
<h2><?php echo $subastaBean->getUsuarioCreador()->getUsuario() ?></h2>
<p>
Foto: <img width="200" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo $subastaBean->getRutaFotoSub() ?>" />
<?php MultiIdioma::gettexto("consultarSubasta.fecha_apertura") ?>: <?php echo $subastaBean->getFechaApertura() ?><br/>
<?php MultiIdioma::gettexto("consultarSubasta.tiempo_restante") ?>:<?php //echo $subastaBean->getTiempoRestante() ?><br/>
<?php MultiIdioma::gettexto("consultarSubasta.fecha_cierre") ?>: <?php echo $subastaBean->getFechaCierre() ?><br/>
<?php MultiIdioma::gettexto("consultarSubasta.descripcion_breve") ?>: <?php echo $subastaBean->getDescripcionBreve() ?>
<?php MultiIdioma::gettexto("consultarSubasta.descripcion") ?>: <?php echo $subastaBean->getDescripcion() ?>
</p>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>