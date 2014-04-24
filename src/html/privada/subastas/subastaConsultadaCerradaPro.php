<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>

<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
        <li><a class="submenu" href="index.php?controlador=ListarMisSubastasControlador&accion=listarSubastasPrivada" ><?php MultiIdioma::gettexto("menu.mis_subastas"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.detalle_subasta_cerrada_propietario"); ?></li>
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
<table>
	<tr>
		<th><?php MultiIdioma::gettexto("consultarSubasta.usuario") ?></th>
		<th><?php MultiIdioma::gettexto("consultarSubasta.fecha") ?></th>
		<th><?php MultiIdioma::gettexto("consultarSubasta.hora") ?></th>
		<th><?php MultiIdioma::gettexto("consultarSubasta.puja") ?></th>
	</tr>
<?php 
	foreach ($subastaBean->getListaPujas() as $puja) {
?>
	<tr>
		<td><?php echo $puja->getUsuarioPuja()->getUsuario() ?></td>
		<td><?php echo $puja->getFechaPuja() ?></td>
		<td>Por implementar</td>
		<td><?php echo $puja->getCantPujada() ?></td>
	</tr>
<?php
	}
?>
</table>
<?php
	include HTML_PATH."/paginado.php";
?>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>