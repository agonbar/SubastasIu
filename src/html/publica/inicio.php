<?php
	include HTML_PUBLICA_PATH."/cabecera.php";
?>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("inicio.ultimas_subastas") ?></h2>
    </div>
<?php
    foreach ($listaSubastas as $subasta) {
?>    
    <div class="box_text_content">
    	<img width="100" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo $subasta->getRutaFotoSub() ?>" alt="<?php echo $subasta->getTitulo() ?>" title="<?php echo $subasta->getTitulo() ?>" class="box_icon">
        <div class="box_sub_inicio">
       		 <?php echo $subasta->getTitulo() ?>
        </div>
        <div class="box_sub_inicio">
        	<?php MultiIdioma::gettexto("subastasListadas.precio_inicial") ?>: <?php echo $subasta->getPrecioInicial() ?></br>
        </div>
        <div class="box_sub_inicio ult_campo">
       		<?php if ($subasta->getPujaGanadora()->getIdPuja() != null) { ?>
				<?php MultiIdioma::gettexto("subastasListadas.ultima_puja") ?>: <?php echo $subasta->getPujaGanadora()->getCantPujada() ?> &euro;
			<?php } else { ?>
				<?php MultiIdioma::gettexto("subastasListadas.ninguna_puja") ?>
			<?php } ?>
        </div>
    </div>
    <div class="box_text_content">
		<div class="linea"><hr/></div>
	</div> 
<?php
	}
?>
</div>
<!-- Fin de listado de subastas de la parte publca -->

<?php
	include HTML_PUBLICA_PATH."/pie.php";
?>