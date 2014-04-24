<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>
<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
        <li><a class="submenu" href="index.php?controlador=ListarSubastasControlador&accion=listarSubastasPrivada" ><?php MultiIdioma::gettexto("menu.mis_subastas"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.detalle_subasta_abierta"); ?></li>
    </ul>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <!--<h2><?php MultiIdioma::gettexto("inicio.ultimas_subastas") ?></h2>-->
        <h2><?php echo $subastaBean->getTitulo() ?></h2>
    </div>
	<div class="box_text_content">
	  	<div class="box_text">
	  		<img width="200" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo $subastaBean->getRutaFotoSub() ?>" />
	    </div>
	  	<div class="box_text_det_sub">
			<?php echo $subastaBean->getUsuarioCreador()->getUsuario() ?><br/>
			<?php MultiIdioma::gettexto("consultarSubasta.fecha_apertura") ?>: <?php echo $subastaBean->getFechaApertura() ?><br/>
			<?php MultiIdioma::gettexto("consultarSubasta.tiempo_restante") ?>:<?php echo $subastaBean->getTiempoRestante() ?><br/>
			<?php MultiIdioma::gettexto("consultarSubasta.fecha_cierre") ?>: <?php echo $subastaBean->getFechaCierre() ?><br/>
			<?php MultiIdioma::gettexto("consultarSubasta.descripcion_breve") ?>: <?php echo $subastaBean->getDescripcionBreve() ?>
			<?php MultiIdioma::gettexto("consultarSubasta.descripcion") ?>: <?php echo $subastaBean->getDescripcion() ?>
		</div>
	</div>
	<div class="box_text_content ">
		<div class="box_text">&nbsp;</div>
	  	<div class="ult_campo box_text_det_sub">
	  		<form action="index.php">
	  			<input type="hidden" name="controlador" value="PujarControlador" />
	  			<input type="hidden" name="accion" value="pujar" />
	  			<input type="hidden" name="idSubasta" value="<?php echo $subastaBean->getIdSubasta() ?>" />
  			  	<?php if ($existenPujas) { ?>
	  				<?php MultiIdioma::gettexto("consultarSubasta.ultima_puja") ?>: <?php echo $pujaGanadoraBean->getCantPujada(); ?> &euro;
	  			<?php } else { ?>
	  			  	<?php MultiIdioma::gettexto("consultarSubasta.precio_inicial") ?> <?php echo $subastaBean->getPrecioInicial() ?> &euro;
	  			<?php } ?>
	  			&nbsp;&nbsp;<input type="text" name="cantPujada" value="" size="2"/> &euro; <input type="submit" value="<?php MultiIdioma::gettexto("consultarSubasta.pujar") ?>" />
	  		</form>
	  	</div>
	</div>
<form action="index.php" >
	<?php include HTML_PRIVADA_SUBASTAS_PATH."/pujasListadas.php"; ?>
</form>
</div>
<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>