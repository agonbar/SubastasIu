<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>


<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.subastas"); ?></li>
    </ul>
</div>

<div class="box_content_submenu">
  	<div class="box_text_ancho">
		<div id="contentBox">
		    <ul>
		        <li><?php MultiIdioma::gettexto("menu.subastas"); ?></li>
		        <li>|</li>
		        <li><a class="submenu" href="index.php?controlador=ListarMisSubastasControlador&accion=listarSubastasPrivada" ><?php MultiIdioma::gettexto("menu.mis_subastas"); ?></a></li>
		        <li>|</li>
		        <li><a class="submenu" href="index.php?controlador=CrearSubastaControlador&accion=mostrarFormulario"><?php MultiIdioma::gettexto("menu.crear_subasta"); ?></a></li>
		    </ul>
		</div>
	</div>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <!--<h2><?php MultiIdioma::gettexto("inicio.ultimas_subastas") ?></h2>-->
        <h2><?php MultiIdioma::gettexto("subastasListadas.subastas") ?></h2>
    </div>

<form action="index.php" >
	  <div class="box_text_content">
	  	<div class="box_text_ancho">
			<input type="text" name="nombre" value="<?php echo $busquedaSubastasBean->getNombreSubasta() ?>" style="width:736px"/>
			<input type="hidden" name="controlador" value="ListarSubastasControlador" />
			<input type="hidden" name="accion" value="buscarSubastasPrivada" />
			<input type="submit" value="<?php MultiIdioma::gettexto("subastasListadas.buscar") ?>" />
		</div>
	  </div>
	  <div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginadoTop.php"; ?>
	    </div>
	  </div>
<?php
    foreach ($listaSubastas as $subasta) {
?>
	<div class="box_text_content">
		<img width="100" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo $subasta->getRutaFotoSub() ?>" alt="<?php echo $subasta->getTitulo() ?>" title="<?php echo $subasta->getTitulo() ?>" class="box_icon">
	  	<div class="box_text_listar_sub">
			<a href="index.php?controlador=ConsultarSubastaControlador&accion=consultarSubasta&idSubasta=<?php echo $subasta->getIdSubasta() ?>" class="details" ><?php echo $subasta->getTitulo() ?></a><br /><br />
			<?php echo $subasta->getUsuarioCreador()->getUsuario() ?><br />
			<?php echo $subasta->getDescripcionBreve() ?><br/>
		</div>
		<div class="box_text_listar_sub">
			<?php if ($subasta->getIdEstadoSub() != ESTADO_SUBASTA_EN_PROCESO) { ?>
				<?php MultiIdioma::gettexto("subastasListadas.subasta_cerrada") ?>
			<?php } else { ?>
				<?php MultiIdioma::gettexto("subastasListadas.tiempo_restante") ?>: <?php echo $subasta->getTiempoRestante() ?><br/>
			<?php } ?>
		</div>
		<div class="box_text_listar_sub ult_campo">
			<?php MultiIdioma::gettexto("subastasListadas.precio_inicial") ?>: <?php echo $subasta->getPrecioInicial() ?> &euro;<br/>
		<?php if ($subasta->getPujaGanadora()->getIdPuja() != null) { ?>
			<?php MultiIdioma::gettexto("subastasListadas.ultima_puja") ?>: <?php echo $subasta->getPujaGanadora()->getCantPujada() ?> &euro;
		<?php } else { ?>
			<?php MultiIdioma::gettexto("subastasListadas.ninguna_puja") ?>
		<?php } ?><br/><br/>
			<div class="right"><a href="index.php?controlador=ConsultarSubastaControlador&accion=consultarSubasta&idSubasta=<?php echo $subasta->getIdSubasta() ?>" class="details" >+ <?php MultiIdioma::gettexto("subastasListadas.verDetalle") ?></a></div>
		</div>
	</div>
	<div class="box_text_content">
		<div class="linea"><hr/></div>
	</div>
<?php
	}
?>
    <div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginado.php"; ?>
	    </div>
	</div>
</form>
</div>

<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>

