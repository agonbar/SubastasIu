<?php
	/**
	 * Pagina de error cuando existe algun problema eliminando
	 * un componente
	 * @author Adrian Gonzalez
	 */
	include HTML_PRIVADA_PATH."/cabecera.php";
?>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.componentes") ?></h2>
    </div>
    <div class="box_text_content">
        <div class="box_text_registro">
        	<?php MultiIdioma::gettexto("componentes.errorBaja") ?>
		</div>
	</div>
	<div class="box_text_content">
		 <div class="box_text_ancho ult_campo">
        	<input type="button" value="<?php MultiIdioma::gettexto("comun.volver")?>" onclick="javascript:history.back()" />
		</div>
	</div>
</div>

<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>