<?php
	/**
	 * Pagina mostrada al insertar un componente
	 * en el carrito
	 * @author Hector Riopedre
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
        	<?php MultiIdioma::gettexto("carrito.componente_insertado") ?>
		</div>
	</div>
	<div class="box_text_content">
		 <div class="box_text_ancho ult_campo">
        	<a class="right" href="./index.php?controlador=ListarComponentesControlador&accion=listarComponentes"><input type="button" value="<?php MultiIdioma::gettexto("comun.volver") ?>" /></a>
		</div>
	</div>
</div>

<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>