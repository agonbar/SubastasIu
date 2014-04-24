<?php
	include HTML_PRIVADA_PATH."/cabecera.php";
?>
<div id="contentBox">
    <ul>
        <li><a class="submenu" href="index.php" ><?php MultiIdioma::gettexto("menu.inicio"); ?></a></li>
        <li>-></li>
		<li><?php MultiIdioma::gettexto("menu.mis_componentes"); ?></li>
    </ul>
</div>

<div class="box_content_submenu">
  	<div class="box_text_ancho">
		<div id="contentBox">
		    <ul>
		        <li><a class="submenu" href="index.php?controlador=ListarComponentesControlador&accion=listarComponentes" ><?php MultiIdioma::gettexto("menu.componentes"); ?></a></li>
		        <li>|</li>
		        <li><?php MultiIdioma::gettexto("menu.mis_componentes"); ?></li>
		        <li>|</li>
		        <li><a class="submenu" href="index.php?controlador=AltaComponenteControlador&accion=mostrarFormulario"><?php MultiIdioma::gettexto("menu.alta_componente"); ?></a></li>
		    </ul>
		</div>
	</div>
</div>

<div class="box_content">
	<div class="box_title">
    	<div class="title_icon"><img src="./recursos/img/mini_icon3.gif" alt="" title=""></div>
        <h2><?php MultiIdioma::gettexto("menu.componentes"); ?></h2>
    </div>

<form action="index.php" >
	  <div class="box_text_content">
	  	<div class="box_text_ancho">
			<input type="text" name="nombre" value="<?php echo $busquedaComponentesBean->getNombre() ?>" style="width:736px"/>
			<input type="hidden" name="controlador" value="ListarComponentesControlador" />
			<input type="hidden" name="accion" value="buscarComponentes" />
			<input type="submit" value="Buscar" />
		</div>
	  </div>
	    <?php if ($paginadoBean->getNumElemTotal() == 0) { ?>
		<div class="box_text_content">
		  	<div class="box_text_ancho">
		  		<?php MultiIdioma::gettexto("compListadosCrearSub.ningun_componente"); ?>
		  	</div>
		</div>
		<?php } else { ?>
	  <div class="box_text_content">
	  	<div class="box_text_ancho">
	 	  <?php include HTML_PATH."/paginadoTop.php"; ?>
	    </div>
	  </div>
<?php
    foreach ($listaComponentes as $componente) {
?>	
	<div class="box_text_content">
		<img width="100" src="index.php?controlador=MostrarImagenControlador&accion=mostrar&path=<?php echo $componente->getFotoPrincipal()->getRuta() ?>" alt="<?php echo $componente->getNombre() ?>" title="<?php echo $componente->getNombre() ?>" class="box_icon">
	  	<div class="box_text_listar_comp">
			<a href="index.php?controlador=ConsultarComponenteControlador&accion=consultarComponente&idComponente=<?php echo $componente->getIdComponente() ?>" class="details" ><?php echo $componente->getNombre() ?></a><br/>
			<?php echo $componente->getUsuarioVendedor()->getUsuario() ?><br/><br/>
			<?php echo $componente->getDescripcionBreve(); ?><br/>
		</div>
		<div class="box_text_listar_comp ult_campo">
			<?php MultiIdioma::gettexto("componentesListados.precio"); ?>: <?php echo $componente->getPrecio() ?> &euro;<br/><br/>
			<div id="contentBox" class="right">
		   		<ul>
					<li><a href="index.php?controlador=ConsultarComponenteControlador&accion=consultarComponente&idComponente=<?php echo $componente->getIdComponente() ?>" class="details" >+ <?php MultiIdioma::gettexto("componentesListados.verDetalle"); ?></a></li>
					<li><a href="index.php?controlador=ModificarComponenteControlador&accion=mostrarFormulario&idComponente=<?php echo $componente->getIdComponente() ?>" class="details" >+ <?php MultiIdioma::gettexto("componentesListados.modificar"); ?></a></li>
					<li><a href="index.php?controlador=ConsultarSubastaControlador&accion=consultarSubasta&idSubasta=<?php echo $componente->getIdComponente() ?>" class="details" >+ <?php MultiIdioma::gettexto("componentesListados.eliminar"); ?></a></li>
				</ul>
			</div>
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
	<?php } ?>
</form>
</div>


<?php
	include HTML_PRIVADA_PATH."/pie.php";
?>