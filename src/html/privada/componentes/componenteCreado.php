<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.alta_componente") ?></h2>
    </div>
    <div class="box_text_content">
        <div class="box_text_registro">
        	<?php MultiIdioma::gettexto("altaComponente.componente_creada") ?>
		</div>
	</div>
	<div class="box_text_content">
        <div class="box_text_ancho ult_campo">
        	<a href="index.php?controlador=ListarMisComponentesControlador&accion=listarComponentes" ><input type="button" value="<?php MultiIdioma::gettexto("comun.volver") ?>" /></a>
		</div>
	</div>
</div>

<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>