<?php MultiIdioma::gettexto("paginado.numero_resultados_busqueda") ?>: <?php echo $paginadoBean->getNumElemTotal() ?>
<div class="right" >
<?php MultiIdioma::gettexto("paginado.ordenar_por") ?>:
<script>
$(function() {
	$('#orden').change(
	    function(){$(this).closest('form').trigger('submit');
	});
});
</script>
<select id="orden" name="orden">
<?php
	foreach ($paginadoBean->getCamposOrden() as $campo => $nombre) {
?>
	<option value="<?php echo $campo ?>" 
		<?php if($paginadoBean->getCampoOrdenSelec()==$campo) { ?>selected<?php } ?>
	><?php MultiIdioma::gettexto($nombre) ?></option>
<?php
	}
?>
</select>
</div>
