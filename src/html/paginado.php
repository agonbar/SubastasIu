<div id="paginadoBox">
    <ul>
		<li><?php MultiIdioma::gettexto("paginado.paginado") ?>:</li>

<?php
// Solo muestro 5 numeros en pantalla en el paginado
$numPag = 1;
for ($i = $paginadoBean->getNumPag(),$i-=2;$numPag <= 5 && $numPag <= $paginadoBean->getNumPagTotal();$i++) {
	if($i >= 1) {
		if ($paginadoBean->getNumPag() != $i){
	?>
		<li><a class="submenu" href="<?php echo $_SERVER['PHP_SELF'] ?>?controlador=<?php echo $_REQUEST["controlador"] ?>&accion=<?php echo $_REQUEST["accion"] ?>&pag=<?php echo $i ?>&max=<?php echo $paginadoBean->getNumElemPag() ?>"><?php echo $i ?></a></li>
<?php
		} else {
?>
		<li><b><?php echo $paginadoBean->getNumPag() ?></b></li>	
<?php		
		}
		$numPag++;
	}
} 
?>
	</ul>
</div>

<div style="float:right">
<?php MultiIdioma::gettexto("paginado.elementos_por_pagina") ?>:
<script>
$(function() {
	$('#max').change(
	    function(){$(this).closest('form').trigger('submit');
	});
});
</script>
<select id="max" name="max">
	<option value="10" <?php if ($paginadoBean->getNumElemPag() == 10) { ?>selected<?php } ?>
	>10</option>
	<option value="20" <?php if ($paginadoBean->getNumElemPag() == 20) { ?>selected<?php } ?>
	>20</option>
	<option value="30" <?php if ($paginadoBean->getNumElemPag() == 30) { ?>selected<?php } ?>
	>30</option>
	<option value="40" <?php if ($paginadoBean->getNumElemPag() == 40) { ?>selected<?php } ?>>
	40</option>
</select>
</div>

