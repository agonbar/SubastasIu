<?php
/**
 * Pagina mostrada al listar los informes.
 * @author Nuria Canle
 */

    include HTML_ADMIN_PATH."/cabecera.php";
?>
<p>

<form action="index.php" >
<?php MultiIdioma::gettexto("informes.fecha")?> <input type="text" name="fecha" value="<?php echo $busquedaInformesBean->getFecha() ?>" /> 
<?php MultiIdioma::gettexto("informes.nPedidos")?> <input type="text" name="numPedidos" value="<?php echo $busquedaInformesBean->getNumPedidos() ?>" /><br />
<?php MultiIdioma::gettexto("informes.nSubastas")?> <input type="text" name="numSubastas" value="<?php echo $busquedaInformesBean->getNumSubastas() ?>" />
<th><?php MultiIdioma::gettexto("informes.nPujas")?></th> <input type="text" name="numPujas" value="<?php echo $busquedaInformesBean->getNumPujas() ?>" /><br />
<th><?php MultiIdioma::gettexto("informes.ganancia")?></th> <input type="text" name="ganancia" value="<?php echo $busquedaInformesBean->getGanancia() ?>" /><br />
<?php MultiIdioma::gettexto("informes.fechaEntre")?> <input type="text" name="fechaIni" value="<?php echo $busquedaInformesBean->getFechaIni() ?>" />
 <?php MultiIdioma::gettexto("informes.y")?> <input type="text" name="fechaFin" value="<?php echo $busquedaInformesBean->getFechaFin() ?>" /> <br />
<input type="hidden" name="controlador" value="ListarInformesControlador" />
<input type="hidden" name="accion" value="buscarInformesAdmin" />
<input type="submit" value="Buscar" /><br/>
<?php
	include HTML_PATH."/paginadoTop.php";
?>
<table>
	<tr>
		<th><?php MultiIdioma::gettexto("informes.fecha")?></th>
		<th><?php MultiIdioma::gettexto("informes.nPedidos")?></th>
		<th><?php MultiIdioma::gettexto("informes.nSubastas")?></th>
		<th><?php MultiIdioma::gettexto("informes.nPujas")?></th>
		<th><?php MultiIdioma::gettexto("informes.ganancia")?></th>
	</tr>
<?php
    foreach ($listaInformes as $informe) {
?>
	<tr>
		<td><?php echo $informe->getFecha() ?></td>
		<td><?php echo $informe->getNumPedidos() ?></td>
		<td><?php echo $informe->getNumSubastas() ?></td>
		<td><?php echo $informe->getNumPujas() ?></td>
		<td><?php echo $informe->getGanancia() ?></td>
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