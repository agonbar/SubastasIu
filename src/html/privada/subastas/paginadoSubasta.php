<?php MultiIdioma::gettexto("paginado.paginado") ?>:
<?php
// Solo muestro 5 numeros en pantalla en el paginado
$numPag = 1;
for ($i = $paginadoBean->getNumPag(),$i-=2;$numPag <= 5 && $numPag <= $paginadoBean->getNumPagTotal();$i++) {
	if($i >= 1) {
		if ($paginadoBean->getNumPag() != $i){
	?>
		<a href="<?php echo $_SERVER['PHP_SELF'] ?>?idSubasta=<?php echo $_REQUEST["idSubasta"]; ?>&controlador=<?php echo $_REQUEST["controlador"] ?>&accion=<?php echo $_REQUEST["accion"] ?>&pag=<?php echo $i ?>&max=<?php echo $paginadoBean->getNumElemPag() ?>"><?php echo $i ?></a>
<?php
		} else {
?>
		<b><?php echo $paginadoBean->getNumPag() ?></b>	
<?php		
		}
		$numPag++;
	}
} 
?>

<div style="float:right">
<form action="index.php">
	<input type="hidden" name="controlador" value="<?php echo $_REQUEST["controlador"] ?>" />
	<input type="hidden" name="accion" value="<?php echo $_REQUEST["accion"] ?>" />
	<input type="hidden" name="idSubasta" value="<? echo $_REQUEST["idSubasta"] ?>" />
<script>
$(function() {
	$('#max').change(
	    function(){$(this).closest('form').trigger('submit');
	});
});
</script>
<?php MultiIdioma::gettexto("paginado.elementos_por_pagina") ?>:
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
</form>
</div>

