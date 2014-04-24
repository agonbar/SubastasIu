<?php
	include HTML_ADMIN_PATH."/cabecera.php";
?>
<p>

<form action="index.php" >
<?php MultiIdioma::gettexto("subastas.idSubastas") ?> <input type="text" name="idSubasta" value="<?php echo $busquedaSubastasBean->getIdSubasta() ?>" /> 
<?php MultiIdioma::gettexto("subastas.titulo") ?> <input type="text" name="titulo" value="<?php echo $busquedaSubastasBean->getNombreSubasta() ?>" /><br />
<?php MultiIdioma::gettexto("subastas.estado") ?> <input type="text" name="estado" value="<?php echo $busquedaSubastasBean->getNombreEstSub() ?>" />
<?php MultiIdioma::gettexto("subastas.componente") ?> <input type="text" name="nombreComp" value="<?php echo $busquedaSubastasBean->getNombreComp() ?>" /><br />
<?php MultiIdioma::gettexto("subastas.vendedor") ?> <input type="text" name="nombreUsuario" value="<?php echo $busquedaSubastasBean->getNombreUsuario() ?>" /><br />
<?php MultiIdioma::gettexto("subastas.fechaCreacion") ?> <input type="text" name="fechaCreacionIni" value="<?php echo $busquedaSubastasBean->getFechaCreacionIni() ?>" />
 <?php MultiIdioma::gettexto("subastas.y") ?> <input type="text" name="fechaCreacionFin" value="<?php echo $busquedaSubastasBean->getFechaCreacionFin() ?>" /> <br />
<?php MultiIdioma::gettexto("subastas.fechaCierre") ?> <input type="text" name="fechaCierreIni" value="<?php echo $busquedaSubastasBean->getFechaCierreIni() ?>" />
 <?php MultiIdioma::gettexto("subastas.y") ?> <input type="text" name="fechaCierreFin" value="<?php echo $busquedaSubastasBean->getFechaCierreFin() ?>" /> <br />
<?php MultiIdioma::gettexto("subastas.fechaApertura") ?> <input type="text" name="fechaAperturaIni" value="<?php echo $busquedaSubastasBean->getFechaAperturaIni() ?>" />
 <?php MultiIdioma::gettexto("subastas.y") ?> <input type="text" name="fechaAperturaFin" value="<?php echo $busquedaSubastasBean->getFechaAperturaFin() ?>" /> <br />
<input type="hidden" name="controlador" value="ListarSubastasControlador" />
<input type="hidden" name="accion" value="buscarSubastasPrivada" />
<input type="submit" value="Buscar" /><br/>
<?php
	include HTML_PATH."/paginadoTop.php";
?>
<table>
	<tr>
		<th><?php MultiIdioma::gettexto("subastas.idSubastas") ?></th>
		<th><?php MultiIdioma::gettexto("subastas.titulo") ?></th>
		<th><?php MultiIdioma::gettexto("subastas.estado") ?></th>
		<th><?php MultiIdioma::gettexto("subastas.componente") ?></th>
		<th><?php MultiIdioma::gettexto("subastas.vendedor") ?></th>
		<th><?php MultiIdioma::gettexto("subastas.fechaCreacion") ?></th>
		<th><?php MultiIdioma::gettexto("subastas.fechaCierre") ?></th>
		<th><?php MultiIdioma::gettexto("subastas.fechaApertura") ?></th>
	</tr>
<?php
    foreach ($listaSubastas as $subasta) {
?>
	<tr>
		<td><?php echo $subasta->getIdSubasta() ?></td>
		<td><?php echo $subasta->getTitulo() ?></td>
		<td><?php echo $subasta->getEstadoSubasta()->getNombreEstSub() ?></td>
		<td><?php echo $subasta->getCompSub()->getNombre() ?></td>
		<td><?php echo $subasta->getUsuarioCreador()->getNombre() ?>
		<td><?php echo $subasta->getFechaCreacion() ?>
		<td><?php echo $subasta->getFechaCierre() ?>
		<td><?php echo $subasta->getFechaApertura() ?>
	</tr>
<?php
	}
?>
</table>
<?php
	include HTML_PATH."/paginado.php";
?>
</form>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>

